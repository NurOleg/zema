<?php


namespace App\Services\App;


use Illuminate\Support\Facades\Http;

class SmsService
{
    /**
     * @param string $phone
     * @param string $code
     * @return string
     * @throws \Exception
     */
    public function sendCode(string $phone, string $code): string
    {
        $jsonResponse = Http::get('http://api.sms-prosto.ru', [
            'method'      => 'push_msg',
            'format'      => 'json',
            'key'         => 'dAc60940aa289fe6b64c0f40c60b1d918ea77ee57a33c4c0',
            'text'        => 'Ваш проверочный код: ' . $code,
            'phone'       => $phone,
            'sender_name' => 'Сайт Зема.рф',
            'priority'    => 1
        ]);

        $response = json_decode($jsonResponse);

        if ($response->response->msg->text !== 'OK' && $response->response->msg->err_code !== '0') {
            throw new \Exception($response->response->msg->err_code . ':' . $response->response->msg->text);
        }

        return 'На указанный номер отправлено SMS с кодом подтверджения.';
    }
}
