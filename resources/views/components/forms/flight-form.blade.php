@props(['flight' => null, 'tripId', 'minDate', 'maxDate'])

<form action="{{ $flight ? route('flight.update', $flight) : route('flight.store') }}" method="POST" x-data="flightForm()" id="flight-form">
    @csrf
    @if($flight)
        @method('PUT')
    @endif

    @if(session('airport-error'))
        <x-alert type="error" class="mb-2">{{ session('airport-error') }}</x-alert>
    @endif

    <input type="hidden" name="trip_id" value="{{ $tripId }}" />
    <input type="hidden" name="trip_type" x-model="type" />

    <div role="tablist" class="h-9 w-fit items-center justify-center rounded-xl flex bg-white/80 backdrop-blur-sm p-1.5 shadow-sm border-0 mb-4">
        <button type="button" class="inline-flex h-[calc(100%-1px)] flex-1 items-center justify-center rounded-xl border border-transparent px-2 py-1 text-sm font-medium whitespace-nowrap" @click="type = 'round-trip'" :class="type === 'round-trip' ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white' : ''">Round-trip</button>
        <button type="button" class="inline-flex h-[calc(100%-1px)] flex-1 items-center justify-center rounded-xl border border-transparent px-2 py-1 text-sm font-medium whitespace-nowrap" @click="type = 'one-way'" :class="type === 'one-way' ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white' : ''">One way</button>
    </div>

    <button type="button" @click="extract">Paste from extractor</button>

    <div class="grid md:grid-cols-2 gap-6">
        <fieldset class="col-span-2 grid md:grid-cols-2 gap-6 border px-2 pt-2 pb-4 rounded-lg">
            <legend class="px-2 mx-auto font-medium text-slate-700">Outbound</legend>
            <div class="space-y-3">
                <x-input-label for="airport_from_id">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-purple-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                    Origin
                </x-input-label>
                <x-select-input name="airport_from_id" id="airport_from_id" required>
{{--                    @if(old('airport_from_id', $flight?->airport_from_id))--}}
{{--                        <option value="{{ old('airport_from_id', $flight?->airport_from_id) }}">--}}
{{--                            {{ $flight?->airportFrom?->short_name ?? 'Selected' }}--}}
{{--                        </option>--}}
{{--                    @endif--}}
                </x-select-input>
                <x-input-error :messages="$errors->get('airport_from_id')" />
            </div>
            <div class="space-y-3">
                <x-input-label for="airport_to_id">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-pink-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                    Destination
                </x-input-label>
                <x-select-input name="airport_to_id" id="airport_to_id" required>
                    @if(old('airport_to_id', $flight?->airport_from_id))
                        <option value="{{ old('airport_to_id', $flight?->airport_from_id) }}">Selected</option>
                    @endif
                </x-select-input>
                <x-input-error :messages="$errors->get('airport_to_id')" />
            </div>
            <div class="space-y-3">
                <x-input-label for="date_from">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-teal-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M16 3v4" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                    Departure
                </x-input-label>
                <x-text-input name="date_from" id="date_from" type="datetime-local" min="{{ $minDate }}" max="{{ $maxDate }}" value="{{ old('date_from', $flight?->date_from) }}"></x-text-input>
                <x-input-error :messages="$errors->get('date_from')" />
            </div>
            <div class="space-y-3">
                <x-input-label for="date_to">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-cyan-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M16 3v4" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                    Arrival
                </x-input-label>
                <x-text-input name="date_to" id="date_to" type="datetime-local" min="{{ $minDate }}" max="{{ $maxDate }}" value="{{ old('date_to', $flight?->date_to) }}"></x-text-input>
                <x-input-error :messages="$errors->get('date_to')" />
            </div>
        </fieldset>
        <fieldset class="col-span-2 grid md:grid-cols-2 gap-6 border px-2 pt-2 pb-4 rounded-lg" x-show="type === 'round-trip'" x-transition x-cloak>
            <legend class="px-2 mx-auto font-medium text-slate-700">Inbound</legend>
            <div class="space-y-3">
                <x-input-label for="airport_from_id_return">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-purple-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                    Origin
                </x-input-label>
                <x-select-input name="airport_from_id_return" id="airport_from_id_return" required>
                    @if(old('airport_from_id_return', $flight?->airport_from_id))
                        <option value="{{ old('airport_from_id_return', $flight?->airport_from_id) }}">Selected</option>
                    @endif
                </x-select-input>
                <x-input-error :messages="$errors->get('airport_from_id_return')" />
            </div>
            <div class="space-y-3">
                <x-input-label for="airport_to_id_return">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-pink-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
                    Destination
                </x-input-label>
                <x-select-input name="airport_to_id_return" id="airport_to_id_return" required>
                    @if(old('airport_to_id_return', $flight?->airport_from_id))
                        <option value="{{ old('airport_to_id_return', $flight?->airport_from_id) }}">Selected</option>
                    @endif
                </x-select-input>
                <x-input-error :messages="$errors->get('airport_to_id_return')" />
            </div>
            <div class="space-y-3">
                <x-input-label for="date_from_return">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-teal-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M16 3v4" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                    Departure
                </x-input-label>
                <x-text-input name="date_from_return" id="date_from_return" min="{{ $minDate }}" max="{{ $maxDate }}" type="datetime-local" value="{{ old('date_from_return', $flight?->date_from) }}"></x-text-input>
                <x-input-error :messages="$errors->get('date_from_return')" />
            </div>
            <div class="space-y-3">
                <x-input-label for="date_to_return">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-cyan-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M16 3v4" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                    Arrival
                </x-input-label>
                <x-text-input name="date_to_return" id="date_to_return" min="{{ $minDate }}" max="{{ $maxDate }}" type="datetime-local" value="{{ old('date_to', $flight?->date_to) }}"></x-text-input>
                <x-input-error :messages="$errors->get('date_to_return')" />
            </div>
        </fieldset>
        <div class="space-y-3">
            <x-input-label for="price">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-amber-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17.2 7a6 7 0 1 0 0 10" /><path d="M13 10h-8m0 4h8" /></svg>
                Price
            </x-input-label>
            <x-text-input name="price" id="price" type="number" step="0.1" required value="{{ old('price', $flight?->price) }}"></x-text-input>
            <x-input-error :messages="$errors->get('price')" />
        </div>
        <div class="space-y-3">
            <x-input-label for="people">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 text-rose-500"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                People
            </x-input-label>
            <x-text-input name="people" id="people" type="number" step="1" required value="{{ old('people', $flight?->people) }}"></x-text-input>
            <x-input-error :messages="$errors->get('people')" />
        </div>
    </div>
    <div class="flex justify-end gap-4 mt-4">
        <button type="submit" class="btn btn-primary flex-1 justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
            Save flight
        </button>
        <button type="button" class="btn btn-std">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 14l-4 -4l4 -4" /><path d="M5 10h11a4 4 0 1 1 0 8h-1" /></svg>
            Reset
        </button>
    </div>
</form>
