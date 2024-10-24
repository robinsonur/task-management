<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class User extends Authenticatable {

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {

        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed'
        ];

    }

    public function tasks(): HasManyThrough {

        return $this->hasManyThrough(
            Task::class,
            UserTask::class,
            'user_id',
            'id',
            NULL,
            'task_id'
        );

    }

}
