<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslationRequest;
use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /**
     * The service instance for translations.
     *
     * @var TranslationService
     */
    private $service;

    /**
     * Constructor for injecting TranslationService.
     *
     * @param TranslationService $service
     */
    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    /**
     * Show a specific translation by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $translation = $this->service->getTranslationById($id);
        return response()->json($translation, 200);
    }

    /**
     * Store a new translation.
     *
     * @param TranslationRequest $request
     * @return JsonResponse
     */
    public function store(TranslationRequest $request): JsonResponse
    {
        $translation = $this->service->createTranslation($request->validated());
        return response()->json($translation, 201);
    }

    /**
     * Search for translations based on query parameters.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->input('query', '');
        $locale = $request->input('locale');
        $tags = $request->input('tags');

        $translations = $this->service->searchTranslations($query, $locale, $tags);
        return response()->json($translations, 200);
    }

    /**
     * Update an existing translation by ID.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $translation = $this->service->updateTranslation($id, $request->all());
        return response()->json($translation, 200);
    }

    /**
     * Export all translations.
     *
     * @return JsonResponse
     */
    public function export(): JsonResponse
    {
        $translations = $this->service->exportTranslations();
        return response()->json($translations, 200);
    }
}
