@props(['accomodation' => null, 'tripId', 'minDate', 'maxDate'])

<form action="{{ $accomodation ? route('accomodation.update', $accomodation) : route('accomodation.store') }}" method="POST">
    @csrf
    @if($accomodation)
        @method('PUT')
    @endif

    <input type="hidden" name="trip_id" value="{{ $tripId }}" />

    <input type="hidden" name="addressLine" />
    <input type="hidden" name="city" />
    <input type="hidden" name="administrative_area" />
    <input type="hidden" name="postal_code" />
    <input type="hidden" name="region_code" />
    <input type="hidden" name="latitude" />
    <input type="hidden" name="longitude" />

    <div class="grid md:grid-cols-2 gap-6">
        <div class="space-y-3 col-span-2">
            <x-input-label for="location">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-green-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                Location
            </x-input-label>
            <div class="border px-3 py-1 bg-gray-100 w-full border-slate-200 rounded-xl h-11 g-autocomplete"></div>
        </div>
        <div class="space-y-3 col-span-2">
            <x-input-label for="name">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 text-violet-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.52 7h-10.52a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h10.52a1 1 0 0 0 .78 -.375l3.7 -4.625l-3.7 -4.625a1 1 0 0 0 -.78 -.375" /></svg>
                Name
            </x-input-label>
            <x-text-input name="name" id="name" value="{{ old('name', $accomodation?->name) }}" required></x-text-input>
            <x-input-error :messages="$errors->get('name')" />
        </div>
        <div class="space-y-3">
            <x-input-label for="date_from">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-teal-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M16 3v4" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                Check-in
            </x-input-label>
            <x-text-input name="date_from" id="date_from" type="datetime-local" min="{{ $minDate }}" max="{{ $maxDate }}" required value="{{ old('date_from', $accomodation?->date_from) }}"></x-text-input>
            <x-input-error :messages="$errors->get('date_from')" />
        </div>
        <div class="space-y-3">
            <x-input-label for="date_to">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-cyan-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M16 3v4" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                Check-out
            </x-input-label>
            <x-text-input name="date_to" id="date_to" type="datetime-local" required min="{{ $minDate }}" max="{{ $maxDate }}" value="{{ old('date_to', $accomodation?->date_to) }}"></x-text-input>
            <x-input-error :messages="$errors->get('date_to')" />
        </div>
        <div class="space-y-3">
            <x-input-label for="accomodation_type_id">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 text-sky-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20.136 11.136l-8.136 -8.136l-9 9h2v7a2 2 0 0 0 2 2h7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2c.467 0 .896 .16 1.236 .428" /><path d="M19 22v.01" /><path d="M19 19a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483" /></svg>
                Type
            </x-input-label>
            <x-select-input id="accomodation_type_id" name="accomodation_type_id"></x-select-input>
            <x-input-error :messages="$errors->get('accomodation_type_id')" />
        </div>
        <div class="space-y-3">
            <x-input-label for="price">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-amber-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17.2 7a6 7 0 1 0 0 10" /><path d="M13 10h-8m0 4h8" /></svg>
                Price
            </x-input-label>
            <x-text-input name="price" id="price" type="number" step="0.1" required value="{{ old('price', $accomodation?->price) }}"></x-text-input>
            <x-input-error :messages="$errors->get('price')" />
        </div>
        <div class="space-y-3">
            <x-input-label for="people">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 text-rose-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                People
            </x-input-label>
            <x-text-input name="people" id="people" type="number" step="1" required value="{{ old('people', $accomodation?->people) }}"></x-text-input>
            <x-input-error :messages="$errors->get('people')" />
        </div>
    </div>
    <div class="flex justify-end gap-4 mt-4">
        <button type="submit" class="btn btn-secondary flex-1 justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
            Save accomodation
        </button>
        <button type="button" class="btn btn-std">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
            Reset
        </button>
    </div>
</form>
