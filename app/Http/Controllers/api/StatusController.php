<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Http\Resources\StatusCollection;
use App\Http\Requests\StoreStatusRequest;
use App\Http\Resources\StatusResource;
use App\Http\Requests\UpdateStatusRequest;

class StatusController extends Controller {

    /**
     * Display a listing of the resource.
     */
    public function index() {

        $statuses = Status::paginate();

        return new StatusCollection($statuses);

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
    public function store(StoreStatusRequest $request) {

        //

    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status) {

        return new StatusResource($status);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status) {

        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatusRequest $request, Status $status) {

        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status) {

        //

    }

}
