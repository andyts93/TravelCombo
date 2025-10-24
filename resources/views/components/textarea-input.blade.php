@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'border px-3 py-1 bg-gray-100 w-full border-slate-200 rounded-xl min-h-11']) }}></textarea>
