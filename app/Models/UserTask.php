<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTask extends Model {

    use HasFactory, SoftDeletes;

    public $primaryKey = false;

    public $incrementing = false;

    protected $fillable = [
        'task_id',
        'user_id'
    ];

}
