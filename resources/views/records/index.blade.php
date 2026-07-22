<x-layouts::app :title="__('Records')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="xl" level="1">Good {{ $partOfDay }}, {{ auth()->user()->name }}</flux:heading>
        <div>
            <flux:text class="mt-2 mb-6 text-base">Here is what's new in your records today,
                {{ now()->format('l, F j, Y') }}
            </flux:text>
            <flux:button href="{{ route('records.create') }}" variant="primary" color="lime" icon="plus-circle">
                Add new record
            </flux:button>
        </div>


        <flux:separator variant="subtle" />
        <div class="grid auto-rows-min gap-4 md:grid-cols-1">
            @forelse ($records as $record)
                <flux:callout color="{{ $record->status->color() }}" inline>
                    <div class="flex items-center justify-between">
                        <div>
                            <flux:badge color="{{ $record->status->color() }}">{{ $record->status->label() }}</flux:badge>
                            <flux:callout.heading class="mt-6">{{ $record->name }}</flux:callout.heading>
                            <span
                                class="text-xs font-extrabold">{{ $record->date_time->translatedFormat('d F Y l H:i') }}</span>
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
        {{ $records->links() }}
    </div>
</x-layouts::app>