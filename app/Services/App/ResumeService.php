<?php


namespace App\Services\App;


use App\Http\Requests\App\Resume\StoreResumeRequest;
use App\Http\Requests\App\Resume\UpdateResumeRequest;
use App\Models\Resume;

final class ResumeService
{
    /**
     * @param Resume $resume
     * @return array
     */
    public function delete(Resume $resume): array
    {
        $resume->delete();

        return [];
    }

    /**
     * @param StoreResumeRequest $request
     * @return array
     */
    public function store(StoreResumeRequest $request): array
    {
        $resume = Resume::create($request->validated());

        $resume->load('user');

        return ['resume' => $resume];
    }

    /**
     * @param UpdateResumeRequest $request
     * @param Resume $resume
     * @return Resume[]
     */
    public function update(UpdateResumeRequest $request, Resume $resume): array
    {
        $resume->update($request->validated());

        return ['resume' => $resume];
    }
}
