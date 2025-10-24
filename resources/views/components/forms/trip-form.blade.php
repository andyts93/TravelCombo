@props(['trip' => null])

<form class="pt-6" action="{{ $trip ? route('trip.update', $trip) : route('trip.store') }}" method="POST">
    @csrf
    @if($trip)
        @method('PUT')
    @endif

    <input type="hidden" name="user_timezone" />

    <div class="space-y-3 mb-6">
        <x-input-label for="name">Trip name</x-input-label>
        <x-text-input id="name" name="name" value="{{ old('name', $trip?->name) }}" required></x-text-input>
        <x-input-error :messages="$errors->get('name')" />
    </div>
    <div class="space-y-3 mb-6">
        <x-input-label for="name">Description</x-input-label>
        <x-textarea-input id="description" name="description" rows="3" class="resize-none">{{ old('description', $trip?->description) }}</x-textarea-input>
    </div>
    <div class="flex justify-end">
        <button type="primary" class="btn btn-primary">Save</button>
    </div>
</form>
