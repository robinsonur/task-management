<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecordType extends Model {

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function records(): HasMany {

        return $this->hasMany(Record::class);

    }

}
