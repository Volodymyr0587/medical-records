<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\RecordStatus;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use App\Models\Record;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
            ->paginate(10)
            ->withQueryString();

        $partOfDay = $this->getPartOfDay();

        return view('records.index', ['records' => $records, 'partOfDay' => $partOfDay]);
    }

    private function getPartOfDay(): string
    {
        $time = now()->hour;

        return match (true) {
            $time >= 5 && $time < 12 => 'morning',
            $time >= 12 && $time < 17 => 'afternoon',
            $time >= 17 && $time < 21 => 'evening',
            default => 'night',
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('records.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordRequest $request): RedirectResponse
    {
        auth()->user()
            ->records()
            ->create($request->validated());

        flash()
            ->option('position', 'bottom-right')
            ->option('timeout', 5000)
            ->success('Record created successfully.');

        return redirect()
            ->route('records.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record): View
    {
        Gate::authorize('update', $record);

        return view('records.show', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record): View
    {
        Gate::authorize('update', $record);

        return view('records.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordRequest $request, Record $record): RedirectResponse
    {
        Gate::authorize('update', $record);

        $record->update($request->validated());

        flash()
            ->option('position', 'bottom-right')
            ->option('timeout', 5000)
            ->success('Record updated successfully.');

        return redirect()
            ->route('records.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record): RedirectResponse
    {
        Gate::authorize('update', $record);

        $record->delete();

        flash()
            ->option('position', 'bottom-right')
            ->option('timeout', 5000)
            ->success('Record deleted successfully.');

        return redirect()
            ->route('records.index');
    }
}
