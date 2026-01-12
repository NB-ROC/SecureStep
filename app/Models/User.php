<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Users die IK volg (ik -> zij).
     * Pivot: follows(user_id, following_id)
     */
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_id')
            ->withTimestamps();
    }

    /**
     * Users die MIJ volgen (zij -> ik).
     * Pivot: follows(user_id, following_id)
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'user_id')
            ->withTimestamps();
    }

    public function outgoingFollowRequests()
    {
        return $this->hasMany(\App\Models\FollowRequest::class, 'requester_id');
    }

    public function incomingFollowRequests()
    {
        return $this->hasMany(\App\Models\FollowRequest::class, 'requested_id');
    }
}
