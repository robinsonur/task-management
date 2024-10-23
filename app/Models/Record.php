<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model {

    use HasFactory, SoftDeletes;

    // protected $primaryKey = ['record_type_id', 'name'];

    // public $incrementing = false;

    // protected $keyType = 'string';

    protected $fillable = [
        'record_type_id',
        'name'
    ];

    public function recordType(): BelongsTo {

        return $this->belongsTo(RecordType::class);

    }

}
