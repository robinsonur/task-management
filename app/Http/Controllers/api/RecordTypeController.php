<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RecordType;
use App\Http\Resources\RecordTypeCollection;
use App\Http\Requests\StoreRecordTypeRequest;
use App\Http\Resources\RecordTypeResource;
use App\Http\Requests\UpdateRecordTypeRequest;

class RecordTypeController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $recordTypes = RecordType::paginate();

        return new RecordTypeCollection($recordTypes);

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
    public function store(StoreRecordTypeRequest $request) {

        $data = $request->validated();

        $recordType = RecordType::create($data);

        $response = [
            'message' => 'Record type created successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $status = 201;

        if (!$recordType) {

            $message = 'An unexpected error occurred while trying to create the record type!';

            $status = 400;

        }

        return response()->json($response, $status);

    }

    /**
     * Display the specified resource.
     */
    public function show(RecordType $recordType) {

        return new RecordTypeResource($recordType);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RecordType $recordType) {

        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordTypeRequest $request, RecordType $recordType) {

        $data = $request->validated();

        $recordType->update($data);

        $response = [
            'message' => 'Record type updated successfully!',
            'data' => $data
        ];

        $status = 200;

        return response()->json($response, $status);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecordType $recordType) {

        $data = $recordType->toArray();

        $response = [
            'message' => 'Record type deleted successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $status = 200;

        if (!$recordType) {

            $message = 'An unexpected error occurred while trying to delete the record type!';

            $status = 400;

        } else
            $recordType->delete()
        ;

        return response()->json($response, $status);

    }

}
