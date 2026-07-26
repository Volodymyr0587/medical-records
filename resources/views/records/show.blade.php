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
        {{-- Description --}}
        <div class="">
            {{ $record->description }}
        </div>

        {{-- Images --}}
        @if ($record->getMedia('images')->isNotEmpty())
            <div class="grid grid-cols-4 gap-3">
                @foreach ($record->getMedia('images') as $media)
                    <div class="relative group">
                        @can('update', $record)
                            <a href="{{ $media->getUrl() }}" target="_blank">
                                <img src="{{ $media->getUrl('thumb') }}" alt="{{ $media->name }}"
                                    class="rounded-lg object-cover w-full h-32">
                            </a>
                            <form method="POST" action="{{ route('records.media.destroy', [$record, $media]) }}">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 text-xs">
                                    &times;
                                </button>
                            </form>
                        @endcan
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Docs --}}
        @if ($record->getMedia('files')->isNotEmpty())
            <ul class="divide-y">
                @foreach ($record->getMedia('files') as $media)
                    <li class="flex items-center justify-between py-2">
                        <a href="{{ route('records.media.show', [$record, $media]) }}" target="_blank"
                            class="text-blue-600 hover:underline">
                            <flux:badge color="{{ $record->status->color() }}" variant="solid" size="sm">
                                {{ $media->human_readable_size }}
                            </flux:badge>

                            {{ $media->file_name }}
                        </a>

                        @can('update', $record)
                            <div class="flex items-center gap-2">
                                <flux:button href="{{ route('records.media.download', [$record, $media]) }}" variant="ghost"
                                    size="xs" icon="arrow-down-tray">
                                    Download
                                </flux:button>

                                <form method="POST" action="{{ route('records.media.destroy', [$record, $media]) }}">
                                    @csrf
                                    @method('DELETE')

                                    <flux:button variant="danger" type="submit" size="xs" icon="trash"
                                        onclick="return confirm('Are you sure you want to delete this media?')">
                                        Delete
                                    </flux:button>
                                </form>
                            </div>
                        @endcan
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-layouts::app>