<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Status;
use App\Http\Resources\StatusCollection;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Resources\StatusResource;
use App\Http\Requests\UpdateStatusRequest;

class StatusController extends Controller {

    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $this->authorize('viewAny', [Status::class]);

        $statuses = Status::paginate();

        return new StatusCollection($statuses);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatusRequest $request) {

        $this->authorize('create', [Status::class]);

        $data = $request->validated();

        $statusInstance = Status::create($data);

        $response = [
            'message' => 'Status created successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $status = 201;

        if (!$statusInstance) {

            $message = 'An unexpected error occurred while trying to create the status!';

            $status = 400;

        }

        return response()->json($response, $status);

    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status) {

        $this->authorize('view', [$status]);

        return new StatusResource($status);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $statusInstance) {

        $this->authorize('update', [$statusInstance]);

        $data = $request->validated();

        $statusInstance->update($data);

        $response = [
            'message' => 'Status updated successfully!',
            'data' => $data
        ];

        $status = 200;

        return response()->json($response, $status);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $statusInstance) {

        $this->authorize('delete', [$statusInstance]);

        $data = $statusInstance->toArray();

        $response = [
            'message' => 'Record type deleted successfully!',
            'data' => $data
        ];

        ['message' => &$message] = $response;

        $status = 200;

        if (!$statusInstance) {

            $message = 'An unexpected error occurred while trying to delete the record type!';

            $status = 400;

        } else
            $statusInstance->delete()
        ;

        return response()->json($response, $status);

    }

}
