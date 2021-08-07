<?php


namespace App\Services\App;


use App\Models\User;
use App\Http\Requests\App\User\UpdateUserRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class UserService
{
    /**
     * @var ImageService
     */
    protected ImageService $imageService;

    /**
     * UserService constructor.
     * @param ImageService $imageService
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param User $user
     * @return User[]
     */
    public function show(User $user): array
    {
        $user->load(['current_city', 'birth_city']);

        return ['user' => $user];
    }

    /**
     * @param UpdateUserRequest $request
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function update(UpdateUserRequest $request, User $user): array
    {
        $avatar = [];
        $avatarUploaded = $this->imageService->makeFromBase64($request->get('avatar'));

        if ($avatarUploaded !== null) {

            $avatarPath = '/user/avatars/' . $user->id . '/' . $avatarUploaded->getClientOriginalName();

            if (!Storage::disk('public')->put($avatarPath, $avatarUploaded->getContent())) {
                throw new \Exception('Не удалось загрузить фото.');
            }

            $avatar['avatar'] = $avatarPath;
        }

        $user->update(array_merge($request->validated(), $avatar));

        $user->load(['current_city', 'birth_city']);

        return ['user' => $user];
    }

}
