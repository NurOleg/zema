<?php

namespace App\Services\App;


use App\Http\Requests\App\Auth\GetTokenRequest;
use App\Http\Requests\App\Auth\RegisterRequest;
use App\Http\Requests\App\Auth\VerifyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class AuthService
{
    private SmsService $smsServive;

    public function __construct(SmsService $smsService)
    {
        $this->smsServive = $smsService;
    }

    /**
     * @param RegisterRequest $request
     * @return string
     * @throws \Exception
     */
    public function register(RegisterRequest $request): string
    {
        $data = $request->all();

        if ($request->get('password') !== $request->get('confirm_password')) {
            throw new \Exception('Пароли не совпадают.');
        }

        if (User::wherePhone($request->get('phone'))
            ->orWhere('email', $request->get('email'))
            ->exists()) {
            throw new \Exception('Пользователь с таким номером телефона или e-mail уже зарегестрирован.');
        }

        $data['password'] = bcrypt($request->get('password'));
        $data['verified'] = false;

        $user = User::create($data);
        $code = rand(1000, 9999);

        cache()->put($request->get('phone') . ':code', $code);

        return $this->smsServive->sendCode($request->get('phone'), $code);

        //return $user->createToken($request->get('email'))->plainTextToken;
    }

    /**
     * @param VerifyRequest $request
     * @return array
     * @throws \Exception
     */
    public function verify(VerifyRequest $request): array
    {
        if (cache()->get($request->get('phone') . ':code') !== (int)$request->get('code')) {
            throw new \Exception('Введенный код неверен.');
        }

        $user = User::wherePhone($request->get('phone'))->first();

        $user->verified = true;
        $user->save();

        return ['token' => $user->createToken($request->get('phone'))->plainTextToken];
    }

    /**
     * @param GetTokenRequest $request
     * @return array
     * @throws \Exception
     */
    public function getToken(GetTokenRequest $request): array
    {
        $user = User::wherePhone($request->get('phone'))->first();

        if ($user === null || !Hash::check($request->get('password'), $user->password)) {
            throw new \Exception('Вы ещё не зарегестрированы либо ввели неправильные телефон/пароль.');
        }

        return ['token' => $user->createToken($request->get('phone'))->plainTextToken];
    }
}
