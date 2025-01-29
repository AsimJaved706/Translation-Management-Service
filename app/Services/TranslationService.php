<?php

namespace App\Services;

use App\Repositories\TranslationRepository;

class TranslationService {
    private $repository;

    public function __construct(TranslationRepository $repository) {
        $this->repository = $repository;
    }

    public function createTranslation(array $data): Translation {
        return $this->repository->create($data);
    }

    public function searchTranslations(string $query, string $locale = null, array $tags = null) {
        return $this->repository->search($query, $locale, $tags);
    }
}