<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $fillable = ['title','description','category'] ;

    public function attachments(){
        return $this->belongsToMany(\App\Models\Attachment::class,'attachment_document') ;
    }

}
