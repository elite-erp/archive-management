<?php

use App\Models\Document;

function fetchDocuments($search, $id = null, $field = null)
{
    return Document::when($id, function ($query) use ($id, $field) {
        $query->where($field, $id);
    })->where(function ($query) use ($search) {
        $query->where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
    })->with('category')->latest()->paginate(10)->withQueryString();
}
