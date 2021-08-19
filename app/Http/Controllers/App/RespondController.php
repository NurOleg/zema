<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\App\Respond\ListRespondRequest;
use App\Http\Requests\App\Respond\StoreRespondRequest;
use App\Http\Requests\App\Respond\UpdateRespondRequest;
use App\Models\Respond;
use App\Services\App\RespondService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RespondController extends BaseAppController
{
    /**
     * @var RespondService
     */
    protected RespondService $respondService;

    /**
     * RespondController constructor.
     * @param RespondService $respondService
     */
    public function __construct(RespondService $respondService)
    {
        $this->respondService = $respondService;
    }

    /**
     * @param ListRespondRequest $request
     * @return JsonResponse
     */
    public function index(ListRespondRequest $request): JsonResponse
    {
        $responds = $this->respondService->index($request);

        return $this->successResponse($responds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @param StoreRespondRequest $request
     * @return JsonResponse
     */
    public function store(StoreRespondRequest $request): JsonResponse
    {
        $respond = $this->respondService->store($request);

        return $this->successResponse($respond, 'Ваш отклик успешно отправлен.', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param UpdateRespondRequest $request
     * @param Respond $respond
     * @return JsonResponse
     */
    public function update(UpdateRespondRequest $request, Respond $respond): JsonResponse
    {
        $respond = $this->respondService->update($request, $respond);

        return $this->successResponse($respond, 'Ваш отклик успешно обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
