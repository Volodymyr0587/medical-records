<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div>
            <flux:heading size="xl" level="1">
                <div class="flex items-center gap-x-2">
                    <flux:icon :name="$partOfDay->icon()" />
                    <span>Good {{ $partOfDay->label() }}, {{ auth()->user()->name }}</span>
                </div>
            </flux:heading>

            <flux:text class="mt-2 text-base">
                Here are your statistics for today,
                {{ now()->format('l, F j, Y') }}
            </flux:text>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($statuses as $status)
                <a href="{{ route('records.index', ['status' => $status->value]) }}" wire:navigate>
                    <flux:callout color="{{ $status->color() }}" inline class="transition hover:scale-[1.02]">
                        <div class="flex items-center justify-between">
                            <div>
                                <flux:badge color="{{ $status->color() }}">
                                    {{ $status->label() }}
                                </flux:badge>

                                <flux:callout.heading class="mt-4 text-4xl">
                                    {{ $statusCounts->get($status->value, 0) }}
                                </flux:callout.heading>

                                <flux:callout.text>
                                    {{ __('Records') }}
                                </flux:callout.text>
                            </div>
                        </div>
                    </flux:callout>
                </a>
            @endforeach
        </div>

    </div>
</x-layouts::app>