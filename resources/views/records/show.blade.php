<x-layouts::app :title="$record->name">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        {{-- Header --}}
        <div>
            <flux:heading size="xl" level="1">
                {{ $record->name }}
            </flux:heading>
            <flux:text class="my-2 text-xl text-amber-600">
                Date & time <span class="font-bold">{{ $record->date_time->format('l, F j, Y H:i:s') }}</span>
            </flux:text>
            <flux:text class="mt-1 text-base">
                Created at {{ $record->created_at->format('l, F j, Y') }}
            </flux:text>
            <flux:text class="mt-1 text-base">
                Last update {{ $record->updated_at->format('H:i:s l, F j, Y') }}
            </flux:text>
        </div>
        {{-- Toolbar --}}
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-3">
                <flux:button href="{{ route('records.edit', $record) }}" variant="primary" color="lime" icon="pencil">
                    Edit
                </flux:button>
                <form action="{{ route('records.destroy', $record) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <flux:button type="submit" variant="primary" color="rose" icon="trash"
                        onclick="return confirm('Are you sure you want to delete this record?')">
                        Delete
                    </flux:button>
                </form>
            </div>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-sm font-medium text-zinc-500">
                Status:
            </span>
            <flux:badge color="{{ $record->status->color() }}" variant="solid" size="lg">
                {{ $record->status->label() }}
            </flux:badge>
        </div>
        <flux:separator variant="subtle" />
        {{-- Records --}}
        <div class="">
            {{ $record->description }}
        </div>
    </div>
</x-layouts::app>