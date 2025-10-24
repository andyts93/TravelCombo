@props(['type' => null, 'title' => null])

@php
switch($type) {
    case 'error':
        $classes = "border-red-200 bg-red-50";
        $titleClass = "text-red-900";
        $slotClass = "text-red-700";
        $title = 'Error';
}
@endphp

<div {{ $attributes->merge(['class' => "relative w-full border px-4 py-3 text-sm gap-y-0.5 items-start grid has-[>svg]:grid-cols-[calc(0.25rem*4)_1fr] grid-cols-[0_1fr] has-[>svg]:gap-x-3 [&>svg]:size-4 [&>svg]:translate-y-0.5 [&>svg]:text-current rounded-xl " . $classes]) }}>
    @switch($type)
        @case('error')
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-exclamation-circle"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 9v4" /><path d="M12 16v.01" /></svg>
        @break
    @endswitch

    @if(isset($title))
        <div class="col-start-2 line-clamp-1 min-h-4 font-medium tracking-tight {{ $titleClass }}">{{ $title }}</div>
    @endif

    <div class="col-start-2 grid justify-items-start gap-1 text-sm [&_p]:leading-relaxed {{ $slotClass }}">{{ $slot }}</div>
</div>
