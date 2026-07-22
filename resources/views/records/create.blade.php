<x-layouts::app :title="__('Records')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="xl" level="1">Create new record.</flux:heading>
        <flux:text class="mt-2 mb-6 text-base">Here is what's new in your records today,
            {{ now()->format('l, F j, Y') }}
        </flux:text>

        <flux:separator variant="subtle" />


        <form method="POST" action="{{ route('records.store') }}" class="flex flex-col gap-6">
            @csrf
            <!-- Name -->
            <flux:input name="name" :label="__('Name')" :value="old('name')" type="text" autofocus autocomplete="name"
                :placeholder="__('Dental appointment')" />

            <!-- Description -->
            <flux:textarea label="Description" name="description" :value="old('description')"
                placeholder="Professional teeth cleaning" />

            <!-- Date & time-->
            <flux:field>
                <flux:label>Date & Time</flux:label>

                <flux:input type="datetime-local" name="date_time" value="{{ old('date_time') }}" class="flux-input" />

                <flux:error name="date_time" />
            </flux:field>

            <flux:radio.group name="status" label="Status" variant="segmented">
                @foreach(\App\Enums\RecordStatus::cases() as $status)
                    <flux:radio value="{{ $status->value }}" label="{{ $status->label() }}"
                        :checked="old('status', $record->status->value ?? \App\Enums\RecordStatus::Planned->value) === $status->value" />
                @endforeach
            </flux:radio.group>


            <div class="items-center justify-end">
                <flux:button type="submit" variant="primary" class="w-full" data-test="register-user-button">
                    {{ __('Create record') }}
                </flux:button>
            </div>
        </form>

    </div>

</x-layouts::app>