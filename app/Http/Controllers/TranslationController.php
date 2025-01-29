<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslationRequest;
use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /**
     * The service instance for handling translations.
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
        $translation = Translation::findOrFail($id);
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
        $query = Translation::query();

        if ($request->has('locale')) {
            $query->where('locale', $request->locale);
        }

        if ($request->has('key')) {
            $query->where('key', 'like', '%' . $request->key . '%');
        }

        if ($request->has('content')) {
            $query->where('content', 'like', '%' . $request->content . '%');
        }

        if ($request->has('tags')) {
            $query->whereJsonContains('tags', $request->tags);
        }

        $translations = $query->get();
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
        $translation = Translation::findOrFail($id);
        $translation->update($request->all());
        return response()->json($translation, 200);
    }

    /**
     * Export all translations.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function export(Request $request): JsonResponse
    {
        $translations = Translation::all()->mapWithKeys(function ($item) {
            return [$item->key => $item->content];
        });

        return response()->json($translations, 200);
    }
}
