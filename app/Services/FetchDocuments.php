<?php

use App\Models\Document;

function fetchDocuments($search, $id = null, $field = null)
{
    $query = Document::query();
    if ($id != null) {
        $query = $query->where($field, $id);
    }

    return $query->where(function ($query) use ($search) {
        $query->where('title', 'like', "%{$search}%");
    })->with('category')->latest()->paginate(10);
}
