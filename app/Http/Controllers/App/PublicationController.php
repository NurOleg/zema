<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\App\Publication\ListPublicationRequest;
use App\Http\Requests\App\Publication\StorePublicationRequest;
use App\Http\Requests\App\Publication\UpdatePublicationRequest;
use App\Models\Publication;
use App\Services\App\PublicationService;
use Illuminate\Http\JsonResponse;

class PublicationController extends BaseAppController
{
    /**
     * @var PublicationService
     */
    protected PublicationService $publicationService;

    /**
     * PublicationController constructor.
     * @param PublicationService $publicationService
     */
    public function __construct(PublicationService $publicationService)
    {
        $this->publicationService = $publicationService;
    }

    /**
     * @param ListPublicationRequest $request
     * @return JsonResponse
     */
    public function index(ListPublicationRequest $request): JsonResponse
    {
        $publications = $this->publicationService->index($request);

        return $this->successResponse($publications);
    }

    /**
     * @param StorePublicationRequest $request
     * @return JsonResponse
     */
    public function store(StorePublicationRequest $request): JsonResponse
    {
        $publication = $this->publicationService->store($request);

        return $this->successResponse($publication, 'Публикация успешно добавлена.');
    }

    /**
     * @param Publication $publication
     * @return JsonResponse
     */
    public function show(Publication $publication): JsonResponse
    {
        $publication = $this->publicationService->show($publication);

        return $this->successResponse($publication);
    }

    /**
     * @param UpdatePublicationRequest $request
     * @param Publication $publication
     * @return JsonResponse
     */
    public function update(UpdatePublicationRequest $request, Publication $publication): JsonResponse
    {
        $publication = $this->publicationService->update($request, $publication);

        return $this->successResponse($publication, 'Публикация успешно обновлена');
    }

    /**
     * @param Publication $publication
     * @return JsonResponse
     */
    public function destroy(Publication $publication): JsonResponse
    {
        $result = $this->publicationService->delete($publication);

        return $this->successResponse($result, 'Публикация удалена.');
    }
}
