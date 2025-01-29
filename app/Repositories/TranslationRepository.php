<?php

namespace App\Repositories;

use App\Models\Translation;

class TranslationRepository
{
    public function find(int $id): Translation
    {
        return Translation::findOrFail($id);
    }

    public function create(array $data): Translation
    {
        return Translation::create($data);
    }

    public function search(string $query, string $locale = null, array $tags = null)
    {
        return Translation::when($locale, fn($q) => $q->where('locale', $locale))
            ->when($tags, fn($q) => $q->whereJsonContains('tags', $tags))
            ->where('key', 'like', "%$query%")
            ->orWhere('content', 'like', "%$query%")
            ->get();
    }

    public function update(int $id, array $data): Translation
    {
        $translation = Translation::findOrFail($id);
        $translation->update($data);
        return $translation;
    }

    public function export()
    {
        return Translation::all()->mapWithKeys(function ($item) {
            return [$item->key => $item->content];
        });
    }
}
