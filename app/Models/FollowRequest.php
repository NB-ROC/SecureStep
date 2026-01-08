<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class FollowRequest extends Model
{
    protected $fillable = ['requester_id', 'requested_id', 'status'];

    public function requester(): BelongsTo {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function requested(): BelongsTo {
        return $this->belongsTo(User::class, 'requested_id');
    }
}
