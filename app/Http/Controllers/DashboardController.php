<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\PartOfDay;
use App\Enums\RecordStatus;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $statusCounts = auth()->user()
            ->records()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $totalRecords = auth()->user()->records()->count();

        $partOfDay = PartOfDay::fromDateTime();

        return view('dashboard', [
            'partOfDay' => $partOfDay,
            'statuses' => RecordStatus::cases(),
            'statusCounts' => $statusCounts,
            'totalRecords' => $totalRecords,
        ]);
    }
}
