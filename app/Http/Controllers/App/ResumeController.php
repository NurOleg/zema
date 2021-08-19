<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\App\Resume\StoreResumeRequest;
use App\Http\Requests\App\Resume\UpdateResumeRequest;
use App\Models\Resume;
use App\Services\App\ResumeService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class ResumeController extends BaseAppController
{
    /**
     * @var ResumeService
     */
    private ResumeService $resumeService;

    /**
     * ResumeController constructor.
     * @param ResumeService $resumeService
     */
    public function __construct(ResumeService $resumeService)
    {
        $this->resumeService = $resumeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param StoreResumeRequest $request
     * @return JsonResponse
     */
    public function store(StoreResumeRequest $request): JsonResponse
    {
        $resume = $this->resumeService->store($request);

        return $this->successResponse($resume, 'Резюме успешно создано.', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Resume $resume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @param UpdateResumeRequest $request
     * @param Resume $resume
     * @return JsonResponse
     */
    public function update(UpdateResumeRequest $request, Resume $resume): JsonResponse
    {
        $resume = $this->resumeService->update($request, $resume);

        return $this->successResponse($resume, 'Резюме успешно обновлено.');
    }

    /**
     * @param Resume $resume
     * @return JsonResponse
     */
    public function destroy(Resume $resume): JsonResponse
    {
        $result = $this->resumeService->delete($resume);

        return $this->successResponse($result, 'Резюме успешно удалено.');
    }
}
