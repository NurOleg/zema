<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\App\Resume\StoreResumeRequest;
use App\Http\Requests\App\Resume\UpdateResumeRequest;
use App\Http\Requests\App\Vacancy\ListVacancyRequest;
use App\Http\Requests\App\Vacancy\StoreVacancyRequest;
use App\Http\Requests\App\Vacancy\UpdateVacancyRequest;
use App\Models\Resume;
use App\Models\Vacancy;
use App\Services\App\ResumeService;
use App\Services\App\VacancyService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class VacancyController extends BaseAppController
{
    /**
     * @var VacancyService
     */
    private VacancyService $vacancyService;

    /**
     * VacancyController constructor.
     * @param VacancyService $vacancyService
     */
    public function __construct(VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    /**
     * @param ListVacancyRequest $request
     * @return JsonResponse
     */
    public function index(ListVacancyRequest $request): JsonResponse
    {
        $vacancies = $this->vacancyService->index($request);

        return $this->successResponse($vacancies);
    }

    /**
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $relations = $this->vacancyService->getRelations();

        return $this->successResponse($relations);
    }

    /**
     * @param StoreVacancyRequest $request
     * @return JsonResponse
     */
    public function store(StoreVacancyRequest $request): JsonResponse
    {
        $resume = $this->vacancyService->store($request);

        return $this->successResponse($resume, 'Вакансия успешно создана.', Response::HTTP_CREATED);
    }

    /**
     * @param Vacancy $vacancy
     * @return JsonResponse
     */
    public function show(Vacancy $vacancy): JsonResponse
    {
        $vacancy = $this->vacancyService->show($vacancy);

        return $this->successResponse($vacancy);
    }

    /**
     * @param Vacancy $vacancy
     * @return JsonResponse
     */
    public function edit(Vacancy $vacancy): JsonResponse
    {
        $vacancy = $this->vacancyService->show($vacancy);
        $relations = $this->vacancyService->getRelations();

        return $this->successResponse(array_merge($vacancy, $relations));
    }

    /**
     * @param UpdateVacancyRequest $request
     * @param Vacancy $vacancy
     * @return JsonResponse
     */
    public function update(UpdateVacancyRequest $request, Vacancy $vacancy): JsonResponse
    {
        $resume = $this->vacancyService->update($request, $vacancy);

        return $this->successResponse($resume, 'Вакансия успешно обновлена.');
    }

    /**
     * @param Vacancy $vacancy
     * @return JsonResponse
     */
    public function destroy(Vacancy $vacancy): JsonResponse
    {
        $result = $this->vacancyService->delete($vacancy);

        return $this->successResponse($result, 'Вакансия успешно удалена.');
    }
}
