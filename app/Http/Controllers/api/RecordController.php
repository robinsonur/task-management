<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Record;
use App\Http\Resources\RecordCollection;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Resources\RecordResource;
use App\Http\Requests\UpdateRecordRequest;

class RecordController extends Controller {

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $this->authorize('viewAny');

        $records = Record::paginate();

        return new RecordCollection($records);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordRequest $request) {

        $this->authorize('create');

        $data = $request->validated();

        $record = Record::create($data);

        $response = [
            'message' => 'Record created successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $status = 201;

        if (!$record) {

            $message = 'An unexpected error occurred while trying to create the record!';

            $status = 400;

        }

        return response()->json($response, $status);

    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record) {

        $this->authorize('view');

        return new RecordResource($record);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordRequest $request, Record $record) {

        $this->authorize('update');

        $data = $request->validated();

        $record->update($data);

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
    public function destroy(Record $record) {

        $this->authorize('delete');

        $data = $record->toArray();

        $response = [
            'message' => 'Record deleted successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $status = 200;

        if (!$record) {

            $message = 'An unexpected error occurred while trying to delete the record!';

            $status = 400;

        } else
            $record->delete()
        ;

        return response()->json($response, $status);


    }

}
