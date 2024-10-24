<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ModelView extends Model {

    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    protected $hidden = [
        'record_type_id',
        'record_id'
    ];

    protected $recordTypeName;

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

        $attributes['record_type_id'] = self::getRecordTypeId();

        return Record::create($attributes);

    }

    public function delete() {

        return $this->record->delete();

    }

    // Custom functions

    public static function getRecordTypeName(): string {

        return (new static())->recordTypeName;

    }

    public static function getRecordTypeId(): int {

        $recordTypeName = self::getRecordTypeName();

        return \Cache::rememberForever( "{$recordTypeName}_record_type_id", fn() =>
            RecordType::where('name', $recordTypeName)->first()->id
        );

    }

    public static function findByName(string $name = '') {

        $recordTypeName = self::getRecordTypeName();

        return \DB::table($recordTypeName)
            ->where('name', $name)
            ->first()
        ;

    }

}
