<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $records = auth()->user()
            ->records()
            ->search($request->string('search')->trim()->toString())
            ->status($request->enum('status', RecordStatus::class))
            ->latest('date_time')
            ->paginate(15)
            ->withQueryString();

        return view('records.index', compact('records'));
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
