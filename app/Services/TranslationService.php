<?php

namespace App\Services;

use App\Models\Translation;
use App\Repositories\TranslationRepository;

class TranslationService
{
    /**
     * The repository instance for translations.
     *
     * @var TranslationRepository
     */
    private $repository;

    /**
     * Constructor for injecting the TranslationRepository.
     *
     * @param TranslationRepository $repository
     */
    public function __construct(TranslationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new translation.
     *
     * @param array $data
     * @return Translation
     */
    public function createTranslation(array $data): Translation
    {
        return $this->repository->create($data);
    }

    /**
     * Search for translations.
     *
     * @param string $query
     * @param string|null $locale
     * @param array|null $tags
     * @return mixed
     */
    public function searchTranslations(string $query, string $locale = null, array $tags = null)
    {
        return $this->repository->search($query, $locale, $tags);
    }

    /**
     * Retrieve a specific translation by ID.
     *
     * @param int $id
     * @return Translation
     */
    public function getTranslationById(int $id): Translation
    {
        return $this->repository->find($id);
    }

    /**
     * Update an existing translation.
     *
     * @param int $id
     * @param array $data
     * @return Translation
     */
    public function updateTranslation(int $id, array $data): Translation
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Export all translations.
     *
     * @return mixed
     */
    public function exportTranslations()
    {
        return $this->repository->export();
    }
}
