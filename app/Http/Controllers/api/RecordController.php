<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Http\Resources\RecordCollection;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Resources\RecordResource;
use App\Http\Requests\UpdateRecordRequest;

class RecordController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $records = Record::paginate();

        return new RecordCollection($records);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {

        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordRequest $request) {

        //

    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record) {

        return new RecordResource($record);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record) {

        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordRequest $request, Record $record) {

        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record) {

        //

    }

}
