<x-layouts::app :title="__('Records')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">

        {{-- Header --}}
        <div>
            <flux:heading size="xl" level="1">
                Good {{ $partOfDay }}, {{ auth()->user()->name }}
            </flux:heading>

            <flux:text class="mt-2 text-base">
                Here is what's new in your records today,
                {{ now()->format('l, F j, Y') }}
            </flux:text>
        </div>

        {{-- Toolbar --}}
        <div class="flex flex-wrap items-center justify-between gap-4">

            <div class="flex flex-wrap items-center gap-3">

                <flux:button href="{{ route('records.create') }}" variant="primary" color="lime" icon="plus-circle">
                    Add new record
                </flux:button>

                <form method="GET">
                    @if($selectedStatus)
                        <input type="hidden" name="status" value="{{ $selectedStatus->value }}">
                    @endif

                    <flux:input name="search" value="{{ request('search') }}" placeholder="Search records..." clearable
                        oninput="
                            clearTimeout(window.searchTimer);
                            window.searchTimer = setTimeout(() => this.form.submit(), 400);
                        " />
                </form>

            </div>

            @if(request()->filled('search'))
                <flux:button href="{{ route('records.index', ['status' => $selectedStatus?->value]) }}" variant="ghost"
                    color="zinc">
                    ✕ Clear search
                </flux:button>
            @endif

        </div>

        {{-- Status filter --}}
        <div class="flex flex-wrap items-center gap-2">

            <span class="text-sm font-medium text-zinc-500">
                Status:
            </span>

            {{-- All --}}
            <a href="{{ route('records.index', request()->except('status', 'page')) }}">
                <flux:badge color="zinc" variant="{{ $selectedStatus == '' ? 'solid' : '' }}">
                    All <span class="ml-1 font-bold">{{ $totalRecords }}</span>
                </flux:badge>
            </a>

            @foreach($statuses as $status)
                        <a href="{{ route(
                    'records.index',
                    array_merge(
                        request()->except('page'),
                        ['status' => $status->value]
                    )
                ) }}">
                            <flux:badge color="{{ $status->color() }}" variant="{{ $selectedStatus === $status ? 'solid' : '' }}"
                                size="{{ $selectedStatus === $status ? 'lg' : '' }}">
                                {{ $status->label() }}
                                <span class="ml-1 font-bold">
                                    {{ $statusCounts[$status->value] ?? 0 }}
                                </span>
                            </flux:badge>
                        </a>
            @endforeach

        </div>

        <flux:separator variant="subtle" />

        {{-- Records --}}
        <div class="grid gap-4">

            @forelse ($records as $record)
                <flux:callout color="{{ $record->status->color() }}" inline>
                    <div class="flex items-center justify-between">
                        <div>
                            <flux:badge color="{{ $record->status->color() }}">{{ $record->status->label() }}
                            </flux:badge>

                            <flux:callout.heading class="mt-6">{{ $record->name }}</flux:callout.heading>
                            <span class="text-xs font-extrabold">{{ $record->date_time->translatedFormat('d F Y l H:i')
                                                                                                        }}</span>
                            <flux:callout.text>
                                {{ Str::words($record->description, 5) }}
                            </flux:callout.text>
                        </div>
                    </div>
                </flux:callout>
            @empty
                <div>
                    <flux:heading>🙃 Oops</flux:heading>
                    <flux:text class="mt-2">You currently have no records.
                        <a class="font-medium text-lime-600 hover:text-lime-900 transition-colors"
                            href="{{ route('records.create') }}" variant="primary" wire:click>
                            Create one.
                        </a>
                    </flux:text>
                </div>
            @endforelse

        </div>

        {{ $records->links('pagination.custom-tailwind') }}

    </div>
</x-layouts::app>