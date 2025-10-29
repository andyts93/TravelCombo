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

{{--    <x-card class="mb-6">--}}
{{--        <x-slot:header>--}}
{{--            <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white size-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 19a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M19 7a2 2 0 1 0 0 -4a2 2 0 0 0 0 4z" /><path d="M11 19h5.5a3.5 3.5 0 0 0 0 -7h-8a3.5 3.5 0 0 1 0 -7h4.5" /></svg>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <h4 class="leading-none">Distance</h4>--}}
{{--                <p class="text-slate-500 text-sm mt-0.5">Compare distances from airport to accomodation</p>--}}
{{--            </div>--}}
{{--        </x-slot:header>--}}
{{--        <table class="w-full text-sm">--}}
{{--            <thead>--}}
{{--                <x-table.tr-head>--}}
{{--                    <th></th>--}}
{{--                    @foreach($trip->accomodations as $m)--}}
{{--                        <x-table.th-head>{{ $m->name }}</x-table.th-head>--}}
{{--                    @endforeach--}}
{{--                </x-table.tr-head>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--                @foreach($trip->outboundFlights->groupBy('airport_to_id') as $m)--}}
{{--                    <x-table.tr-body>--}}
{{--                        <x-table.td-body>{{ $m->first()->airportTo->shortName }}</x-table.td-body>--}}
{{--                        @foreach($matrix->where('flight.id', $m->first()->id) as $m)--}}
{{--                            <x-table.td-body data-best="{{ $m->best_distance ? 'true' : 'false' }}">--}}
{{--                                <p>{{ ceil($m->distance / 1000) }} Km</p>--}}
{{--                                <p>{{ intdiv($m->duration / 60, 60) }}:{{ $m->duration / 60 % 60 }}h</p>--}}
{{--                            </x-table.td-body>--}}
{{--                        @endforeach--}}
{{--                    </x-table.tr-body>--}}
{{--                @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--        <x-alert type="success" title="Suggestion">--}}
{{--            <x-slot:icon>--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg>--}}
{{--            </x-slot:icon>--}}
{{--            <p>Consider to choose a flight to--}}
{{--                <span class="font-semibold">{{ $matrix->where('best_distance', true)->first()->flight->airportTo->shortName }}</span>--}}
{{--                and stay at <span class="font-semibold">{{ $matrix->where('best_distance', true)->first()->accomodation->name }}</span>--}}
{{--                saving ~{{ ($matrix->max('duration') - $matrix->where('best_distance', true)->first()->duration) / 60 % 60 }}m--}}
{{--            </p>--}}
{{--        </x-alert>--}}
{{--    </x-card>--}}

{{--    <x-card class="mb-6">--}}
{{--        <x-slot:header>--}}
{{--            <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white size-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0" /><path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4" /><path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" /><path d="M5 15v1m0 -8v1" /></svg>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <h4 class="leading-none">Price</h4>--}}
{{--                <p class="text-slate-500 text-sm mt-0.5">Compare combined prices</p>--}}
{{--            </div>--}}
{{--        </x-slot:header>--}}
{{--        <table class="w-full text-sm">--}}
{{--            <thead>--}}
{{--            <x-table.tr-head>--}}
{{--                <th></th>--}}
{{--                @foreach($trip->accomodations as $m)--}}
{{--                    <x-table.th-head>{{ $m->name }}</x-table.th-head>--}}
{{--                @endforeach--}}
{{--            </x-table.tr-head>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($trip->outboundFlights->groupBy('airport_to_id') as $m)--}}
{{--                <x-table.tr-body>--}}
{{--                    <x-table.td-body>{{ $m->first()->airportTo->shortName }}</x-table.td-body>--}}
{{--                    @foreach($matrix->where('flight.id', $m->first()->id) as $m)--}}
{{--                        <x-table.td-body data-best="{{ $m->best_price ? 'true' : 'false' }}">--}}
{{--                            <p>@money($m->price)</p>--}}
{{--                        </x-table.td-body>--}}
{{--                    @endforeach--}}
{{--                </x-table.tr-body>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--        <x-alert type="success" title="Suggestion">--}}
{{--            <x-slot:icon>--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12h1m8 -9v1m8 8h1m-15.4 -6.4l.7 .7m12.1 -.7l-.7 .7" /><path d="M9 16a5 5 0 1 1 6 0a3.5 3.5 0 0 0 -1 3a2 2 0 0 1 -4 0a3.5 3.5 0 0 0 -1 -3" /><path d="M9.7 17l4.6 0" /></svg>--}}
{{--            </x-slot:icon>--}}
{{--            <p>Consider to choose a flight to--}}
{{--                <span class="font-semibold">{{ $matrix->where('best_price', true)->first()->flight->airportTo->shortName }}</span>--}}
{{--                and stay at--}}
{{--                <span class="font-semibold">{{ $matrix->where('best_price', true)->first()->accomodation->name }}</span>--}}
{{--                saving ~@money($matrix->avg('price') - $matrix->where('best_price', true)->first()->price)--}}
{{--            </p>--}}
{{--        </x-alert>--}}
{{--    </x-card>--}}

{{--    <x-card class="mb-6">--}}
{{--        <x-slot:header>--}}
{{--            <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white size-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 7v5l3 3" /></svg>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <h4 class="leading-none">Times</h4>--}}
{{--                <p class="text-slate-500 text-sm mt-0.5">Compare combined prices</p>--}}
{{--            </div>--}}
{{--        </x-slot:header>--}}

{{--        <table class="w-full text-sm">--}}
{{--            <thead>--}}
{{--                <x-table.tr-head>--}}
{{--                    <x-table.th-head>Flight</x-table.th-head>--}}
{{--                    <x-table.th-head>Hours</x-table.th-head>--}}
{{--                    @foreach($trip->accomodations as $m)--}}
{{--                        <x-table.th-head>{{ $m->name }}</x-table.th-head>--}}
{{--                    @endforeach--}}
{{--                </x-table.tr-head>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--                @foreach($trip->outboundFlights as $flight)--}}
{{--                    <x-table.tr-body>--}}
{{--                        <x-table.td-body>--}}
{{--                            <p>{{ $flight->airportFrom->iata_code }} - {{ $flight->airportTo->iata_code }}</p>--}}
{{--                            <p>{{ $flight->linkedFlight->airportFrom->iata_code }} - {{ $flight->linkedFlight->airportTo->iata_code }}</p>--}}
{{--                        </x-table.td-body>--}}
{{--                        <x-table.td-body>--}}
{{--                            <p>{{ $flight->date_from->format('H:i') }} - {{ $flight->date_to->format('H:i') }}</p>--}}
{{--                            <p>{{ $flight->linkedFlight->date_from->format('H:i') }} - {{ $flight->linkedFlight->date_to->format('H:i') }}</p>--}}
{{--                        </x-table.td-body>--}}
{{--                        @foreach($matrix->where('flight.id', $flight->id) as $m)--}}
{{--                            <x-table.td-body>--}}
{{--                                <p>{{ hour_format($m->duration / 60) }}h</p>--}}
{{--                                <p>{{ $m->check_in_gap - $m->duration / 60 / 60 }} check-in</p>--}}
{{--                                <p>{{ $m->check_out_gap }} check-out</p>--}}
{{--                                <p>{{ ceil(max(0, $m->check_in_gap - $m->duration / 60 / 60) + max(0, $m->check_out_gap)) }}h</p>--}}
{{--                            </x-table.td-body>--}}
{{--                        @endforeach--}}
{{--                        <x-table.td-body>--}}
{{--                        </x-table.td-body>--}}
{{--                    </x-table.tr-body>--}}
{{--                @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </x-card>--}}

    <div x-data="{ selected: null }">
{{--        <div class="grid grid-cols-3 gap-6 mb-6">--}}
{{--            <a href="#{{$matrix->sortBy('price')->first()->id}}" @click="selected = @js($matrix->sortBy('price')->first()->id)">--}}
{{--                <div class="flex flex-col gap-6 borer-0 shadow-lg shadow-green-100/50 rounded-3xl bg-gradient-to-br from-green-50 to-emerald-100 overflow-hidden relative">--}}
{{--                    <div class="px-6 py-6 relative">--}}
{{--                        <div class="flex items-center justify-between">--}}
{{--                            <div>--}}
{{--                                <p class="text-slate-600 text-sm mb-1">Cheapest</p>--}}
{{--                                <p class="text-3xl text-slate-900">@money($matrix->sortBy('price')->first()->price)</p>--}}
{{--                            </div>--}}
{{--                            <div class="p-3 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl">--}}
{{--                                <x-icons.basket-dollar class="size-6 text-white"></x-icons.basket-dollar>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <a href="#{{$matrix->sortBy('homelessness')->first()->id}}" @click="selected = @js($matrix->sortBy('homelessness')->first()->id)">--}}
{{--                <div class="flex flex-col gap-6 borer-0 shadow-lg shadow-blue-100/50 rounded-3xl bg-gradient-to-br from-blue-50 to-cyan-100 overflow-hidden relative">--}}
{{--                    <div class="px-6 py-6 relative">--}}
{{--                        <div class="flex items-center justify-between">--}}
{{--                            <div>--}}
{{--                                <p class="text-slate-600 text-sm mb-1">Homelessness</p>--}}
{{--                                <p class="text-3xl text-slate-900">{{ hour_format($matrix->sortBy('homelessness')->first()->homelessness) }}</p>--}}
{{--                            </div>--}}
{{--                            <div class="p-3 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl">--}}
{{--                                <x-icons.home-off class="size-6 text-white"></x-icons.home-off>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}

        @foreach ($matrix as $city)
            <x-card class="mb-6">
                <x-slot:header>
                    <div class="relative shadow-2xl shadow-purple-200/50 overflow-hidden rounded-3xl">
                        @if($city->image)
                            <img src="{{ $city->image['urls']['raw'] }}&w=1280&h=250&fm=webp&dpr=2&q=80&fit=crop&crop=entropy" />
                            <div class="absolute top-1 right-4 z-[2]">
                                <p class="text-right text-xs text-white/60">&copy; Photo by <a href="{{ $city->image['user']['links']['html'] }}">{{ \Illuminate\Support\Str::title($city->image['user']['name']) }}</a> on <a href="{{ $city->image['links']['html'] }}">Unsplash</a></p>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/40 to-transparent"></div>
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-900/30 to-pink-900/30"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="flex items-end justify-between">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <div class="p-2.5 bg-white/20 backdrop-blur-md rounded-xl border border-white/30">
                                            <x-icons.map-pin class="size-5 text-white"></x-icons.map-pin>
                                        </div>
                                        <span class="text-white/90 text-sm">Destination</span>
                                    </div>
                                    <h1 class="text-white text-5xl mb-2">{{ $city->city }}</h1>
                                    <p class="text-white/80 text-lg">Explore {{ $city->combinations->count() }} travel combinations</p>
                                </div>
                                <div class="hidden md:flex gap-4">
                                    <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl px-6 py-4">
                                        <p class="text-white/70 text-sm mb-1">Flights</p>
                                        <p class="text-white text-2xl">{{ $city->combinations->groupBy('flight.id')->count() }}</p>
                                    </div>
                                    <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-2xl px-6 py-4">
                                        <p class="text-white/70 text-sm mb-1">Accomodations</p>
                                        <p class="text-white text-2xl">{{ $city->combinations->groupBy('accomodation.id')->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot:header>
                @if($city->weather)
                    <div class="grid grid-cols-5 gap-4">
                        <x-stat-card color="green-brown">
                            <div>
                                <p class="text-slate-900 text-xl">{{ $city->weather['elevation'] }}m</p>
                                <p class="text-slate-600 text-sm mt-1">Elevation</p>
                            </div>
                            <x-slot:icon>
                                <x-icons.mountain class="size-5"></x-icons.mountain>
                            </x-slot:icon>
                        </x-stat-card>
                        <x-stat-card color="orange-red">
                            <div>
                                <p class="text-slate-900 text-xl">{{ round($city->weather['avg']['temperature_2m_min']) }} - {{ round($city->weather['avg']['temperature_2m_max']) }} °C</p>
                                <p class="text-slate-600 text-sm mt-1">Temperature</p>
                            </div>
                            <x-slot:icon>
                                <x-icons.temperature class="size-5"></x-icons.temperature>
                            </x-slot:icon>
                        </x-stat-card>
                        <x-stat-card color="cyan-blue">
                            <div>
                                <p class="text-slate-900 text-xl">{{ round($city->weather['avg']['precipitation_sum'], 2) }} mm</p>
                                <p class="text-slate-600 text-sm mt-1">Precipitations</p>
                            </div>
                            <x-slot:icon>
                                <x-icons.droplet class="size-5"></x-icons.droplet>
                            </x-slot:icon>
                        </x-stat-card>
                        <x-stat-card color="blue-indigo">
                            <div>
                                <p class="text-slate-900 text-xl">{{ round($city->weather['avg']['wind_speed_10m_max']) }} Km/h</p>
                                <p class="text-slate-600 text-sm mt-1">Wind speed</p>
                            </div>
                            <x-slot:icon>
                                <x-icons.wind class="size-5"></x-icons.wind>
                            </x-slot:icon>
                        </x-stat-card>
                        <x-stat-card color="amber-red">
                            <div>
                                <p class="text-slate-900 text-xl">{{ round($city->weather['avg']['sunshine_duration'] / 60 / 60) }} h</p>
                                <p class="text-slate-600 text-sm mt-1">Sunshine duration</p>
                            </div>
                            <x-slot:icon>
                                <x-icons.sun class="size-5"></x-icons.sun>
                            </x-slot:icon>
                        </x-stat-card>
                    </div>
                @endif
            </x-card>

            @if(count($city->holidays) > 0)
                <x-card class="mb-6">
                    <x-slot:header>
                        <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">
                            <x-icons.confetti class="size-6 text-white"></x-icons.confetti>
                        </div>
                        <div>
                            <h4 class="leading-none">Upcoming holidays</h4>
                            <p class="text-slate-500 text-sm mt-0.5">There upcoming holidays during your trip!</p>
                        </div>
                    </x-slot:header>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($city->holidays as $holiday)
                            <div class="overflow-hidden rounded-2xl p-4 border-2 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 bg-gradient-to-br from-violet-50 to-purple-50 border-violet-200/50">
                                <div class="space-y-2">
                                    <p class="text-slate-900 font-medium">{{ $holiday['name'] }}</p>
                                    <div class="flex gap-2 items-center">
                                        <x-icons.calendar class="size-4 text-violet-600"></x-icons.calendar>
                                        <span class="text-slate-600 text-sm">{{ \Carbon\Carbon::parse($holiday['date'])->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            @endif

            <x-card>
                <x-slot:header>
                    <div class="p-2 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl">
                        <x-icons.sparkles class="size-6 text-white"></x-icons.sparkles>
                    </div>
                    <div>
                        <h4 class="leading-none">Flight & Accommodation Comparison</h4>
                        <p class="text-slate-500 text-sm mt-0.5">All combinations with timing, distance, and cost analysis</p>
                    </div>
                </x-slot:header>
                <table class="w-full text-sm">
                    <thead>
                    <x-table.tr-head>
                        <x-table.th-head>Flight details</x-table.th-head>
                        <x-table.th-head>Accomodation</x-table.th-head>
                        <x-table.th-head class="text-center"><p>Distance</p><p class="text-xs text-slate-500">from airport</p></x-table.th-head>
                        <x-table.th-head class="text-center"><p>Distance</p><p class="text-xs text-slate-500">from centre</p></x-table.th-head>
                        <x-table.th-head class="text-center">Check-in gap</x-table.th-head>
                        <x-table.th-head class="text-center">Check-out gap</x-table.th-head>
                        <x-table.th-head><p>Nearby</p><p class="text-xs text-slate-500">500m</p></x-table.th-head>
                        <x-table.th-head>Total cost</x-table.th-head>
                    </x-table.tr-head>
                    </thead>
                    <tbody>
                    @foreach($city->combinations as $m)
                        <x-table.tr-body id="{{ $m->id }}" x-bind:class="selected === '{{ $m->id }}' ? 'bg-gradient-to-br from-green-50 to-emerald-100 animate-[pulse_2s_ease-in-out_0s_2]' : ''">
                            <x-table.td-body>
                                <p>{{ $m->flight->airportFrom->iata_code }} - {{ $m->flight->airportTo->iata_code }}</p>
                                <p class="text-xs text-slate-600 flex items-center gap-1">
                                    <x-icons.clock class="size-3"></x-icons.clock>
                                    {{ $m->flight->date_from->format('H:i') }} → {{ $m->flight->date_to->format('H:i') }}
                                </p>
                                <p class="mt-2">{{ $m->flight->linkedFlight->airportFrom->iata_code }} - {{ $m->flight->linkedFlight->airportTo->iata_code }}</p>
                                <p class="text-xs text-slate-600 flex items-center gap-1">
                                    <x-icons.clock class="size-3"></x-icons.clock>
                                    {{ $m->flight->linkedFlight->date_from->format('H:i') }} → {{ $m->flight->linkedFlight->date_to->format('H:i') }}
                                </p>
                            </x-table.td-body>
                            <x-table.td-body>
                                <p class="font-medium">{{ $m->accomodation->name }}</p>
                                <p class="text-xs text-slate-600">{{ $m->accomodation->city }}</p>
                                <p class="text-xs text-slate-600 flex items-center gap-1 mb-1">
                                    <x-icons.calendar class="size-3"></x-icons.calendar>
                                    In: {{ $m->accomodation->date_from->format('H:i') }} | Out: {{ $m->accomodation->date_to->format('H:i') }}
                                </p>
                                <p class="flex items-center gap-0.5 text-slate-600">Rating: <x-rating rating="{{ $m->accomodation->rating }}" class="text-slate-500"></x-rating></p>
                            </x-table.td-body>
                            <x-table.td-body class="text-center">
                                <p class="font-medium">{{ ceil($m->distance / 1000) }} Km</p>
                                <p class="text-xs text-slate-600 flex items-center justify-center gap-1 mb-1">
                                    <x-icons.car class="size-3"></x-icons.car>
                                    {{ hour_format($m->duration / 60, 'G\h i\m') }}
                                </p>
                                @if($m->distance <= 5 * 1000)
                                    <x-badge class="border-green-200 text-green-700">Close!</x-badge>
                                @elseif($m->distance <= 20 * 1000)
                                    <x-badge class="border-amber-200 text-amber-700">Medium</x-badge>
                                @else
                                    <x-badge class="border-red-200 text-red-700">Far</x-badge>
                                @endif
                            </x-table.td-body>
                            <x-table.td-body class="text-center">
                                @if(isset($m->center_distance))
                                    <p class="font-medium">{{ ceil($m->center_distance / 1000) }} Km</p>
                                    <p class="text-xs text-slate-600 flex items-center justify-center gap-1 mb-1">
                                        <x-icons.walk class="size-3"></x-icons.walk>
                                        {{ hour_format($m->center_duration / 60, 'G\h i\m') }}
                                    </p>
                                    @if($m->center_distance <= 5 * 1000)
                                        <x-badge class="border-green-200 text-green-700">Close!</x-badge>
                                    @elseif($m->center_distance <= 20 * 1000)
                                        <x-badge class="border-amber-200 text-amber-700">Medium</x-badge>
                                    @else
                                        <x-badge class="border-red-200 text-red-700">Far</x-badge>
                                    @endif
                                @endif
                            </x-table.td-body>
                            <x-table.td-body class="text-center">
                                <p class="mb-1">{{ hour_format(max(0, $m->check_in_gap), 'G\h i\m') }}</p>
                                @if($m->check_in_gap <= 0)
                                    <x-badge class="border-green-200 text-green-700">No wait!</x-badge>
                                @elseif($m->check_in_gap <= 1 * 60)
                                    <x-badge class="border-purple-200 text-purple-700">Short wait</x-badge>
                                @elseif($m->check_in_gap <= 2 * 60)
                                    <x-badge class="border-amber-200 text-amber-700">Medium wait</x-badge>
                                @else
                                    <x-badge class="border-red-200 text-red-700">Long wait</x-badge>
                                @endif
                            </x-table.td-body>
                            <x-table.td-body class="text-center">
                                <p class="mb-1">{{ hour_format(max(0, $m->check_out_gap), 'G\h i\m') }}</p>
                                @if($m->check_out_gap <= 0)
                                    <x-badge class="border-green-200 text-green-700">No wait!</x-badge>
                                @elseif($m->check_out_gap <= 1 * 60)
                                    <x-badge class="border-purple-200 text-purple-700">Short wait</x-badge>
                                @elseif($m->check_out_gap <= 2 * 60)
                                    <x-badge class="border-amber-200 text-amber-700">Medium wait</x-badge>
                                @else
                                    <x-badge class="border-red-200 text-red-700">Long wait</x-badge>
                                @endif
                            </x-table.td-body>
                            <x-table.td-body>
                                <ul>
                                    @foreach($m->nearby as $key => $value)
                                        <li class="flex items-center gap-1">
                                            @switch($key)
                                                @case('museum')
                                                <x-icons.palette class="size-4"></x-icons.palette> {{ $value->count() }}
                                                @break
                                                @case('supermarket')
                                                <x-icons.carrot class="size-4"></x-icons.carrot> {{ $value->count() }}
                                                @break
                                                @case('gift')
                                                <x-icons.gift class="size-4"></x-icons.gift> {{ $value->count() }}
                                                @break
                                                @case('station')
                                                <x-icons.bus-stop class="size-4"></x-icons.bus-stop> {{ $value->count() }}
                                                @break
                                            @endswitch
                                        </li>
                                    @endforeach
                                </ul>
                            </x-table.td-body>
{{--                            <x-table.td-body>--}}
{{--                                @if($m->weather)--}}
{{--                                    <ul>--}}
{{--                                        <li class="flex items-center gap-1">--}}
{{--                                            <x-icons.temperature class="size-4 text-purple-500"></x-icons.temperature>--}}
{{--                                            {{ ceil($m->weather['avg']['temperature_2m_mean']) }} °C--}}
{{--                                        </li>--}}
{{--                                        <li class="flex items-center gap-1">--}}
{{--                                            <x-icons.droplet class="size-4 text-sky-500"></x-icons.droplet>--}}
{{--                                            {{ ceil($m->weather['avg']['precipitation_sum']) }} mm--}}
{{--                                        </li>--}}
{{--                                        <li class="flex items-center gap-1">--}}
{{--                                            <x-icons.wind class="size-4 text-cyan-400"></x-icons.wind>--}}
{{--                                            {{ ceil($m->weather['avg']['wind_speed_10m_max']) }} Km/h--}}
{{--                                        </li>--}}
{{--                                        <li class="flex items-center gap-1">--}}
{{--                                            <x-icons.sun class="size-4 text-amber-500"></x-icons.sun>--}}
{{--                                            {{ round($m->weather['avg']['sunshine_duration'] / 60 / 60) }} h--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                @else--}}
{{--                                    <p class="text-center">-</p>--}}
{{--                                @endif--}}
{{--                            </x-table.td-body>--}}
                            <x-table.td-body>
                                @money($m->price)
                            </x-table.td-body>
                        </x-table.tr-body>
                    @endforeach
                    </tbody>
                </table>
            </x-card>
        @endforeach

    </div>
</x-app-layout>
