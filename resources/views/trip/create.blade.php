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

    @if(session('error'))
        <x-alert type="error" class="mb-4">{{ session('error') }}</x-alert>
    @endif

    <x-card class="shadow-violet-100/50 mb-4">
        <x-forms.trip-form :countries="$countries"></x-forms.trip-form>
    </x-card>
</x-app-layout>
