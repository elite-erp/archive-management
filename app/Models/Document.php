<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $fillable = ['title', 'description', 'category_id', 'created_by', 'updated_by'];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
