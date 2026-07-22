<x-layouts::app :title="__('Records')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="xl" level="1">Good {{ $partOfDay }}, {{ auth()->user()->name }}</flux:heading>
        <flux:text class="mt-2 mb-6 text-base">Here is what's new in your records today,
            {{ now()->format('l, F j, Y') }}
        </flux:text>

        <flux:separator variant="subtle" />
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            @forelse ($records as $record)
                <flux:callout icon="pencil-square" color="lime" inline>
                    <flux:callout.heading>{{ $record->name }}</flux:callout.heading>
                    <flux:badge icon="clock" size="lg">{{ $record->date_time->translatedFormat('d F Y l H:i') }}
                    </flux:badge>

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
    </div>
</x-layouts::app>