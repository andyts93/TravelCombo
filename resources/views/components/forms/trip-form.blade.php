@props(['trip' => null, 'countries' => []])

<form class="pt-6" action="{{ $trip ? route('trip.update', $trip) : route('trip.store') }}" method="POST">
    @csrf
    @if($trip)
        @method('PUT')
    @endif

    <input type="hidden" name="user_timezone" />

    <div class="flex gap-6">
        <div class="space-y-3 mb-6 w-full">
            <x-input-label for="name">Trip name</x-input-label>
            <x-text-input id="name" name="name" value="{{ old('name', $trip?->name) }}" required></x-text-input>
            <x-input-error :messages="$errors->get('name')" />
        </div>
        <div class="space-y-3 mb-6 w-full">
            <x-input-label for="country_id">Country</x-input-label>
            <x-select-input name="country_id" id="country_id" required>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" @if(old('country_id') === $country->id) selected @endif>{{ $country->name }}</option>
                @endforeach
            </x-select-input>
            <x-input-error :messages="$errors->get('country_id')" />
        </div>
    </div>
    <div class="flex gap-6">
        <div class="space-y-3 mb-6 w-full">
            <x-input-label for="date_from">From</x-input-label>
            <x-text-input type="date" id="date_from" name="date_from" required value="{{ old('date_from') }}"></x-text-input>
            <x-input-error :messages="$errors->get('date_from')" />
        </div>
        <div class="space-y-3 mb-6 w-full">
            <x-input-label for="date_to">To</x-input-label>
            <x-text-input type="date" id="date_to" name="date_to" required value="{{ old('date_to') }}"></x-text-input>
            <x-input-error :messages="$errors->get('date_to')" />
        </div>
    </div>
    <div class="space-y-3 mb-6">
        <x-input-label for="name">Description</x-input-label>
        <x-textarea-input id="description" name="description" rows="3" class="resize-none">{{ old('description', $trip?->description) }}</x-textarea-input>
    </div>
    <div class="flex justify-end">
        <button type="primary" class="btn btn-primary">Save</button>
    </div>
</form>
