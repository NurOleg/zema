<?php


namespace App\Services\App;


use App\Http\Requests\App\Publication\ListPublicationRequest;
use App\Http\Requests\App\Publication\StorePublicationRequest;
use App\Http\Requests\App\Publication\UpdatePublicationRequest;
use App\Models\Friend;
use App\Models\Publication;

final class PublicationService
{
    /**
     * @param ListPublicationRequest $request
     * @return array
     */
    public function index(ListPublicationRequest $request): array
    {
        $publicationsQuery = Publication::query();

        if ($request->filled('user_id')) {
            $publicationsQuery->where('user_id', $request->get('user_id'));
        }

        if ($request->filled('friends_for')) {
            $friendIds = Friend::where(['user_id' => $request->get('friends_for')])->get('friend_id')->toArray();
            $publicationsQuery->whereIn('user_id', $friendIds);
        }

        $publications = $publicationsQuery->get();
        $publications->load(['user']);

        return ['publications' => $publications];
    }

    /**
     * @param StorePublicationRequest $request
     * @return array
     */
    public function store(StorePublicationRequest $request): array
    {
        $publication = Publication::create($request->validated());

        return ['publication' => $publication];
    }

    /**
     * @param UpdatePublicationRequest $request
     * @param Publication $publication
     * @return Publication[]
     */
    public function update(UpdatePublicationRequest $request, Publication $publication): array
    {
        $publication->update($request->validated());

        return ['publication' => $publication];
    }

    /**
     * @param Publication $publication
     * @return array
     */
    public function delete(Publication $publication): array
    {
        $publication->delete();

        return [];
    }

    /**
     * @param Publication $publication
     * @return Publication[]
     */
    public function show(Publication $publication): array
    {
        $publication->load(['user']);

        return ['publication' => $publication];
    }
}
