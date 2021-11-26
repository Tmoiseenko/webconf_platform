<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messageslike extends Model
{
    use HasFactory;

    public function message() {
        return $this->belongsTo('App\Models\Message');
    }

    public function toggle() {
        $this->type_id === 'like' ? $this->type_id = 'dislike' : $this->type_id = 'like';
        $this->save();
    }
}
