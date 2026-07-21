<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\Record;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordRequest $request, Record $record): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record): void
    {
        //
    }
}
