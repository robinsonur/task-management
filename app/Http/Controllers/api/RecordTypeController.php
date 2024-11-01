<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\RecordType;
use App\Http\Resources\RecordTypeCollection;
use App\Http\Requests\StoreRecordTypeRequest;
use App\Http\Resources\RecordTypeResource;
use App\Http\Requests\UpdateRecordTypeRequest;

class RecordTypeController extends Controller {

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $this->authorize('viewAny', [RecordType::class]);

        $recordTypes = RecordType::paginate();

        return new RecordTypeCollection($recordTypes);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordTypeRequest $request) {

        $this->authorize('create', [RecordType::class]);

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

        $this->authorize('view', [$recordType]);

        return new RecordTypeResource($recordType);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordTypeRequest $request, RecordType $recordType) {

        $this->authorize('update', [$recordType]);

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

        $this->authorize('delete', [$recordType]);

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
