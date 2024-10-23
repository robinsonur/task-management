<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Status extends Model {

    use HasFactory, SoftDeletes;

    public static $recordTypeId;

    protected $fillable = ['name'];

    protected $hidden = [
        'record_type_id',
        'record_id'
    ];

    public function __construct(array $attributes = []) {

        parent::__construct($attributes);

        if (!isset(static::$recordTypeId))
            static::$recordTypeId = $this->getRecordTypeId()
        ;

    }

    // Relations

    public function recordType(): HasOneThrough {

        return $this->hasOneThrough(
            RecordType::class,
            Record::class,
            'id',
            'id',
            NULL,
            'record_type_id'
        );

    }

    public function record(): HasOne {

        return $this->hasOne(Record::class, 'id', 'record_id');

    }

    // Functions

    public static function create(array $attributes = []) {

        if (!isset(static::$recordTypeId))
            static::$recordTypeId = (new self())->getRecordTypeId()
        ;

        $attributes['record_type_id'] = static::$recordTypeId;

        return Record::create($attributes);

    }

    public function delete() {

        return $this->record->delete();

    }

    // Custom functions

    public function getRecordTypeId(): int {

        if (!isset(static::$recordTypeId))
            static::$recordTypeId = \Cache::rememberForever('statuses_record_type_id', function() {
                return RecordType::where('name', 'Statuses')->first()->id;
            })
        ;

        return static::$recordTypeId;

    }

    public function findByName(string $name = ''): Status {

        return Status::where('name', $name)->first();

    }

}
