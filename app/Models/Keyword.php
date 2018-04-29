<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $fillable = ['text', 'is_manual'];

    public function setTextAttribute($value)
    {
        $this->attributes['text'] = mb_substr($value, 0, 63);
    }

    public function getTFAttribute()
    {
        return $this->in_post_total/$this->post_total;
    }

    public function getIDFAttribute()
    {
        return log($this->document_total/($this->in_document_total+1));
    }

    public function getTFIDFAttribute()
    {
        return $this->tf*$this->idf;
    }
}
