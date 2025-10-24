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

    <x-card class="shadow-violet-100/50 mb-4">
        <x-forms.trip-form :trip="$trip"></x-forms.trip-form>
    </x-card>

{{--    <div class="grid grid-cols-2 gap-6">--}}
        <x-card>
            <x-slot:header>
                <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white w-6 h-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14.5 6.5l3 -2.9a2.05 2.05 0 0 1 2.9 2.9l-2.9 3l2.5 7.5l-2.5 2.55l-3.5 -6.55l-3 3v3l-2 2l-1.5 -4.5l-4.5 -1.5l2 -2h3l3 -3l-6.5 -3.5l2.5 -2.5l7.5 2.5z" /></svg>
                </div>
                <div>
                    <h4 class="leading-none">Flight</h4>
                    <p class="text-slate-500 text-sm mt-0.5">Configure your flight parameters</p>
                </div>
            </x-slot:header>

            <table class="w-full text-sm">
                <thead>
                    <x-table.tr-head>
                        <x-table.th-head>From</x-table.th-head>
                        <x-table.th-head>To</x-table.th-head>
                        <x-table.th-head>Departure</x-table.th-head>
                        <x-table.th-head>Arrival</x-table.th-head>
                        <x-table.th-head>Duration</x-table.th-head>
                        <x-table.th-head>Price</x-table.th-head>
                    </x-table.tr-head>
                </thead>
                <tbody>
                    @foreach($trip->flights as $flight)
                        <x-table.tr-body>
                            <x-table.td-body>{{ $flight->airportFrom->iata_code }} - {{ $flight->airportFrom->municipality }}</x-table.td-body>
                            <x-table.td-body>{{ $flight->airportTo->iata_code }} - {{ $flight->airportTo->municipality }}</x-table.td-body>
                            <x-table.td-body>{{ $flight->date_from->format('d/m/y H:i') }}</x-table.td-body>
                            <x-table.td-body>{{ $flight->date_to->format('d/m/y H:i') }}</x-table.td-body>
                            <x-table.td-body>{{ $flight->duration }}h</x-table.td-body>
                            <x-table.td-body>@money($flight->price)</x-table.td-body>
                        </x-table.tr-body>
                    @endforeach
                </tbody>
            </table>
        </x-card>
{{--    </div>--}}

    <div class="grid grid-cols-2 gap-6">
        <x-card class="shadow-purple-100/50">
            <x-slot:header>
                <div class="p-2 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white w-6 h-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14.5 6.5l3 -2.9a2.05 2.05 0 0 1 2.9 2.9l-2.9 3l2.5 7.5l-2.5 2.55l-3.5 -6.55l-3 3v3l-2 2l-1.5 -4.5l-4.5 -1.5l2 -2h3l3 -3l-6.5 -3.5l2.5 -2.5l7.5 2.5z" /></svg>
                </div>
                <div>
                    <h4 class="leading-none">Flight</h4>
                    <p class="text-slate-500 text-sm mt-0.5">Configure your flight parameters</p>
                </div>
            </x-slot:header>

            <x-forms.flight-form :tripId="$trip->id"></x-forms.flight-form>
        </x-card>

        <x-card class="shadow-teal-100/50">
            <x-slot:header>
                <div class="p-2 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white size-6"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 17v-3h-20" /><path d="M2 8v9" /><path d="M12 14h10v-2a3 3 0 0 0 -3 -3h-7v5z" /></svg>
                </div>
                <div>
                    <h4 class="leading-none">Accomodation</h4>
                    <p class="text-slate-500 text-sm mt-0.5">Configure your accomodation parameters</p>
                </div>
            </x-slot:header>

            <x-forms.accomodation-form :tripId="$trip->id"></x-forms.accomodation-form>
        </x-card>
    </div>
    @push('scripts')
        @vite(['resources/js/trip.js', 'resources/js/g-autocomplete.js'])
    @endpush
</x-app-layout>
