<?php


namespace App\Services\App;


use App\Http\Requests\App\Respond\ListRespondRequest;
use App\Http\Requests\App\Respond\StoreRespondRequest;
use App\Http\Requests\App\Respond\UpdateRespondRequest;
use App\Models\Respond;
use App\Models\Vacancy;

final class RespondService
{
    /**
     * @param ListRespondRequest $request
     * @return array
     */
    public function index(ListRespondRequest $request): array
    {
        $respondQuery = Vacancy::query();

        if ($request->filled('vacancy_id')) {
            $respondQuery->where('vacancy_id', $request->get('vacancy_id'));
        }

        if ($request->filled('resume_id')) {
            $respondQuery->where('resume_id', $request->get('resume_id'));
        }

        $responds = $respondQuery->get();

        return compact('responds');
    }

    /**
     * @param StoreRespondRequest $request
     * @return array
     */
    public function store(StoreRespondRequest $request): array
    {
        $respond = Respond::create($request->validated());

        return compact('respond');
    }

    /**
     * @param UpdateRespondRequest $request
     * @param Respond $respond
     * @return array
     */
    public function update(UpdateRespondRequest $request, Respond $respond): array
    {
        $respond->update($request->validated());

        return compact($respond);
    }
}
