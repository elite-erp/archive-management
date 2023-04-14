<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory ,SoftDeletes;

    protected $table = 'documents';

    protected $fillable = ['title', 'description', 'category_id', 'created_by', 'updated_by'];

    protected $dates = ['deleted_at'];
    protected $appends = ['photo'];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function getPhotoAttribute() {
        return $this->attachments()->select('path')->first()->path;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
