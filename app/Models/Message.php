<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    public function reply() {
        return $this->belongsTo('App\Models\Message', 'message_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function reactions() {
        return $this->hasMany('App\Models\Messageslike');
    }

    public function isReactedByUser($userId) {
        $reaction = $this->reactions()->where('user_id', $userId)->first();

        return $reaction;
    }
}
