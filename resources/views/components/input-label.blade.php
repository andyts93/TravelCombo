@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm leading-none font-medium select-none flex items-center gap-1 text-slate-700']) }}>
    {{ $value ?? $slot }}
</label>
