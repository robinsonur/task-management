<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelView extends Model {

    use HasFactory, SoftDeletes;

    // Attributes

    public $incrementing = true;

    protected $fillable = ['name'];

    protected $hidden = [
        'record_type_id',
        'record_id'
    ];

    // Relations

    public function record() {

        $recordTypeId = $this->getRecordTypeId();

        $record = \App\Models\Record::withTrashed(true)
            ->where('record_type_id', $recordTypeId)
            ->where('name', $this->name)
            ->first()
        ;

        return $record;

    }

    // Custom attributes

    protected string $recordTypeName;

    // Functions

    public static function create(array $attributes = []) {

        $attributes['record_type_id'] = self::getRecordTypeId();

        $name = $attributes['name'] ?? NULL;

        $record = self::findByName($name);

        if (!$record || !$record->trashed())
            return Record::create($attributes)
        ;

        $record->restore();

        return $record;

    }

    public function delete() {

        $recordTypeId = $this->getRecordTypeId();

        $records = \DB::table('records')
            ->where('record_type_id', $recordTypeId)
            ->where('name', $this->name)
        ;

        $records->update(['deleted_at' => date('Y-m-d H:i:s')]);

        return true;

    }

    // Custom functions

    public static function getRecordTypeName(): string {

        return (new static())->recordTypeName;

    }

    public static function getModel(): string {

        return (new static())->model;

    }

    public static function getRecordTypeId(): int {

        $recordTypeName = self::getRecordTypeName();

        return \Cache::rememberForever( "{$recordTypeName}_record_type_id", fn() =>
            RecordType::withTrashed()->where('name', $recordTypeName)->first()->id
        );

    }

    public static function findByName(string $name = '', bool $includeTrashed = true) {

        $model = get_called_class();

        return $model::withTrashed($includeTrashed)
            ->where('name', $name)
            ->first()
        ;

    }

}
