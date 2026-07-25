<x-layouts::app :title="__('Records')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="xl" level="1">Edit record: {{ $record->name }}</flux:heading>
        <flux:text class="mt-2 mb-6 text-base">Here you can edit a record.
        </flux:text>

        <flux:separator variant="subtle" />


        <form method="POST" action="{{ route('records.update', $record) }}" class="flex flex-col gap-6"
            enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <!-- Name -->
            <flux:input name="name" :label="__('Name')" value="{{ old('name', $record->name) }}" type="text" autofocus
                autocomplete="name" :placeholder="__('Dental appointment')" />

            <!-- Description -->
            <flux:textarea label="Description" name="description" placeholder="Professional teeth cleaning">
                {{ old('description', $record->description) }}
            </flux:textarea>

            <!-- Date & time-->
            <flux:field>
                <flux:label>Date & Time</flux:label>

                <flux:input type="datetime-local" name="date_time" value="{{ old('date_time', $record->date_time) }}"
                    class="flux-input" />

                <flux:error name="date_time" />
            </flux:field>

            <flux:radio.group name="status" label="Status" variant="segmented">
                @foreach(\App\Enums\RecordStatus::cases() as $status)
                    <flux:radio value="{{ $status->value }}" label="{{ $status->label() }}"
                        :checked="old('status', $record->status->value ?? \App\Enums\RecordStatus::Planned->value) === $status->value" />
                @endforeach
            </flux:radio.group>

            <flux:field>
                <flux:label>Images</flux:label>

                <flux:input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp"
                    class="flux-input" />

                <flux:error name="images" />
            </flux:field>

            <flux:field>
                <flux:label>Files</flux:label>

                <flux:input type="file" name="files[]" multiple class="flux-input" />

                <flux:error name="files" />
            </flux:field>


            <div class="items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full">
                    {{ __('Update record') }}
                </flux:button>
            </div>
        </form>

    </div>

</x-layouts::app>