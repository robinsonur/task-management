<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTask extends Model {

    use SoftDeletes;

    public $primaryKey = false;

    public $incrementing = true;

    protected $fillable = [
        'task_id',
        'user_id'
    ];

}
