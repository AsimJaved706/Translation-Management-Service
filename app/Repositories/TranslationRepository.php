<?php

namespace App\Repositories;

use App\Models\Translation;

class TranslationRepository {
    public function create(array $data): Translation {
        return Translation::create($data);
    }

    public function search(string $query, string $locale = null, array $tags = null) {
        return Translation::when($locale, fn($q) => $q->where('locale', $locale))
            ->when($tags, fn($q) => $q->whereJsonContains('tags', $tags))
            ->where('key', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->get();
    }
}