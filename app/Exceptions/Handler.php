<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse|Response|SymfonyResponse
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception && $request->wantsJson()) {

            $data = [
                'status'  => 'error',
                'message' => null,
                'data'    => null
            ];

            if ($exception instanceof ValidationException) {
                return response()->json(
                    array_merge($data, [
                        'message' => 'Validation incorrect',
                        'errors'  => $exception->validator->getMessageBag()
                    ]), 422);
            }

            if ($exception instanceof ModelNotFoundException) {
                return response()->json(
                    array_merge($data, [
                        'message' => 'Данные не найдены или были удалены.'
                    ]), Response::HTTP_NOT_FOUND);
            }

            return response()->json(
                array_merge($data, [
                    'message' => $exception->getMessage()
                ]), $this->isHttpException($exception) ? $exception->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return parent::render($request, $exception);
    }
}
