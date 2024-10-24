<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ModelView extends Model {

    use HasFactory, SoftDeletes;

    // Attributes

    protected $fillable = ['name'];

    protected $hidden = [
        'record_type_id',
        'record_id'
    ];

    // Custom attributes

    protected $recordTypeName;

    // Relations

    public function recordType(): HasOne {

        return $this->hasOne(RecordType::class, 'id', 'record_type_id');

    }

    public function record(): HasOne {

        return $this->hasOne(Record::class, 'id', 'record_id');

    }

    // Functions

    public static function create(array $attributes = []) {

        $attributes['record_type_id'] = self::getRecordTypeId();

        $name = $attributes['name'] ?? NULL;

        $record = self::findByName($name);

        if (!$record)
            return Record::create($attributes)
        ;

        $record->restore();

        return $record;

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

    public static function findByName(string $name = '', bool $includeTrashed = true) {

        $recordTypeId = self::getRecordTypeId();

        return Record::withTrashed($includeTrashed)
            ->where('record_type_id', $recordTypeId)
            ->where('name', $name)
            ->first()
        ;

    }

}
