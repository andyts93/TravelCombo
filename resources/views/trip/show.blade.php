<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl blur-lg opacity-40"></div>
                <div class="relative p-3 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white w-8 h-8"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M5.75 15a8.015 8.015 0 1 0 9.25 -13" /><path d="M11 17v4" /><path d="M7 21h8" /></svg>
                </div>
            </div>
            <div>
                <h1 class="text-slate-900">Trip planner</h1>
                <p class="text-slate-500 text-sm mt-0.5">Find your perfect journey combination</p>
            </div>
        </div>
    </x-slot>

    <x-card class="mb-6">
        <x-slot:header>
            <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white size-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M19 7a2 2 0 1 0 0 -4a2 2 0 0 0 0 4z" /><path d="M11 19h5.5a3.5 3.5 0 0 0 0 -7h-8a3.5 3.5 0 0 1 0 -7h4.5" /></svg>
            </div>
            <div>
                <h4 class="leading-none">Distance</h4>
                <p class="text-slate-500 text-sm mt-0.5">Compare distances from airport to accomodation</p>
            </div>
        </x-slot:header>
        <table class="w-full text-sm">
            <thead>
                <x-table.tr-head>
                    <th></th>
                    @foreach($trip->accomodations as $m)
                        <x-table.th-head>{{ $m->name }}</x-table.th-head>
                    @endforeach
                </x-table.tr-head>
            </thead>
            <tbody>
                @foreach($trip->outboundFlights->groupBy('airport_to_id') as $m)
                    <x-table.tr-body>
                        <x-table.td-body>{{ $m->first()->airportTo->shortName }}</x-table.td-body>
                        @foreach($matrix->where('flight.id', $m->first()->id) as $m)
                            <x-table.td-body data-best="{{ $m->best_distance ? 'true' : 'false' }}">
                                <p>{{ ceil($m->distance / 1000) }} Km</p>
                                <p>{{ intdiv($m->duration / 60, 60) }}:{{ $m->duration / 60 % 60 }}h</p>
                            </x-table.td-body>
                        @endforeach
                    </x-table.tr-body>
                @endforeach
            </tbody>
        </table>
        <x-alert type="success" title="Suggestion">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg>
            </x-slot:icon>
            <p>Consider to choose a flight to
                <span class="font-semibold">{{ $matrix->where('best_distance', true)->first()->flight->airportTo->shortName }}</span>
                and stay at <span class="font-semibold">{{ $matrix->where('best_distance', true)->first()->accomodation->name }}</span>
                saving ~{{ ($matrix->max('duration') - $matrix->where('best_distance', true)->first()->duration) / 60 % 60 }}m
            </p>
        </x-alert>
    </x-card>

    <x-card class="mb-6">
        <x-slot:header>
            <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white size-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" /><path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" /><path d="M5 15v1m0 -8v1" /></svg>
            </div>
            <div>
                <h4 class="leading-none">Price</h4>
                <p class="text-slate-500 text-sm mt-0.5">Compare combined prices</p>
            </div>
        </x-slot:header>
        <table class="w-full text-sm">
            <thead>
            <x-table.tr-head>
                <th></th>
                @foreach($trip->accomodations as $m)
                    <x-table.th-head>{{ $m->name }}</x-table.th-head>
                @endforeach
            </x-table.tr-head>
            </thead>
            <tbody>
            @foreach($trip->outboundFlights->groupBy('airport_to_id') as $m)
                <x-table.tr-body>
                    <x-table.td-body>{{ $m->first()->airportTo->shortName }}</x-table.td-body>
                    @foreach($matrix->where('flight.id', $m->first()->id) as $m)
                        <x-table.td-body data-best="{{ $m->best_price ? 'true' : 'false' }}">
                            <p>@money($m->price)</p>
                        </x-table.td-body>
                    @endforeach
                </x-table.tr-body>
            @endforeach
            </tbody>
        </table>
        <x-alert type="success" title="Suggestion">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg>
            </x-slot:icon>
            <p>Consider to choose a flight to
                <span class="font-semibold">{{ $matrix->where('best_price', true)->first()->flight->airportTo->shortName }}</span>
                and stay at
                <span class="font-semibold">{{ $matrix->where('best_price', true)->first()->accomodation->name }}</span>
                saving ~@money($matrix->avg('price') - $matrix->where('best_price', true)->first()->price)
            </p>
        </x-alert>
    </x-card>

    <x-card>
        <x-slot:header>
            <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white size-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>
            </div>
            <div>
                <h4 class="leading-none">Times</h4>
                <p class="text-slate-500 text-sm mt-0.5">Compare combined prices</p>
            </div>
        </x-slot:header>

        <table class="w-full text-sm">
            <thead>
                <x-table.tr-head>
                    <x-table.th-head>Flight</x-table.th-head>
                    <x-table.th-head>Hours</x-table.th-head>
                    <x-table.th-head>Inbound</x-table.th-head>
                </x-table.tr-head>
            </thead>
            <tbody>
                @foreach($trip->outboundFlights as $flight)
                    <x-table.tr-body>
                        <x-table.td-body>
                            <p>{{ $flight->airportFrom->iata_code }} - {{ $flight->airportTo->iata_code }}</p>
                            <p>{{ $flight->linkedFlight->airportFrom->iata_code }} - {{ $flight->linkedFlight->airportTo->iata_code }}</p>
                        </x-table.td-body>
                        <x-table.td-body>
                            <p>{{ $flight->date_from->format('H:i') }} - {{ $flight->date_to->format('H:i') }}</p>
                            <p>{{ $flight->linkedFlight->date_from->format('H:i') }} - {{ $flight->linkedFlight->date_to->format('H:i') }}</p>
                        </x-table.td-body>
                        @foreach($matrix->where('flight.id', $flight->id) as $m)
                            <x-table.td-body>
                                <p>{{ $m->check_in_gap }}</p>
                                <p>{{ $m->check_out_gap }}</p>
                            </x-table.td-body>
                        @endforeach
                        <x-table.td-body>
                        </x-table.td-body>
                    </x-table.tr-body>
                @endforeach
            </tbody>
        </table>
    </x-card>
</x-app-layout>
