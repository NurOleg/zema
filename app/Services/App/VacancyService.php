<?php


namespace App\Services\App;


use App\Http\Requests\App\Resume\StoreResumeRequest;
use App\Http\Requests\App\Resume\UpdateResumeRequest;
use App\Http\Requests\App\Vacancy\ListVacancyRequest;
use App\Http\Requests\App\Vacancy\StoreVacancyRequest;
use App\Http\Requests\App\Vacancy\UpdateVacancyRequest;
use App\Models\Category;
use App\Models\EmploymentType;
use App\Models\Experience;
use App\Models\Resume;
use App\Models\Vacancy;

final class VacancyService
{

    /**
     * @param ListVacancyRequest $listVacancyRequest
     * @return array
     */
    public function index(ListVacancyRequest $listVacancyRequest): array
    {
        $vacancyQuery = Vacancy::query();

        if ($listVacancyRequest->filled('salary')) {
            $salaryWanted = $listVacancyRequest->get('salary');
            $vacancyQuery->whereRaw('? between salary_from and salary_to', $salaryWanted)
                ->orWhere('salary_from', '=<', $salaryWanted)
                ->orWhere('salary_to', '>=', $salaryWanted);
        }

        if ($listVacancyRequest->filled('category_id')) {
            $vacancyQuery->where('category_id', $listVacancyRequest->get('category_id'));
        }

        if ($listVacancyRequest->filled('employment_type_id')) {
            $vacancyQuery->where('employment_type_id', $listVacancyRequest->get('employment_type_id'));
        }

        if ($listVacancyRequest->filled('experience_id')) {
            $vacancyQuery->where('experience_id', $listVacancyRequest->get('experience_id'));
        }

        if ($listVacancyRequest->filled('city_id')) {
            $vacancyQuery->where('city_id', $listVacancyRequest->get('city_id'));
        }

        $vacancies = $vacancyQuery->get();

        return ['vacancies' => $vacancies];
    }

    /**
     * @param Vacancy $vacancy
     * @return array
     */
    public function delete(Vacancy $vacancy): array
    {
        $vacancy->delete();

        return [];
    }

    /**
     * @param StoreVacancyRequest $request
     * @return array
     */
    public function store(StoreVacancyRequest $request): array
    {
        $vacancy = Vacancy::create($request->validated());

        return ['vacancy' => $vacancy];
    }

    /**
     * @param UpdateVacancyRequest $request
     * @param Vacancy $vacancy
     * @return Vacancy[]
     */
    public function update(UpdateVacancyRequest $request, Vacancy $vacancy): array
    {
        $vacancy->update($request->validated());

        return ['vacancy' => $vacancy];
    }

    /**
     * @param Vacancy $vacancy
     * @return Vacancy[]
     */
    public function show(Vacancy $vacancy): array
    {
        $vacancy->load(['user', 'category', 'city', 'experience', 'employment_type']);

        return ['vacancy' => $vacancy];
    }

    /**
     * @return array
     */
    public function getRelations(): array
    {
        return [
            'experiences'      => Experience::all(),
            'employment_types' => EmploymentType::all(),
            'categories'       => Category::all()
        ];
    }
}
