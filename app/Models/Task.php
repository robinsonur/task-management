<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model {

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'status_id'
    ];

    public function status(): HasOne {

        return $this->hasOne(Status::class, 'id', 'status_id');

    }

}
