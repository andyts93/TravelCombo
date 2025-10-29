@props(['rating' => null])

@php
if ($rating > 5) $rating /= 2;
if ($rating <= 2.5) $ratingText = "poor";
elseif($rating <= 3) $ratingText = "medium";
else $ratingText = "good";
@endphp

<span data-rating="{{ $ratingText }}" {{$attributes->merge(['class' => "inline-flex items-center w-fit gap-1 [&_svg]:size-4 data-[rating='poor']:text-red-600 data-[rating='poor']:stroke-red-600 data-[rating='medium']:text-amber-600 data-[rating='medium']:stroke-amber-600 data-[rating='good']:text-teal-600 data-[rating='good']:stroke-teal-600"])}}>
    @if(!$rating)
        ND
    @else
        @for($i = 1; $i <= $rating; $i++)
            <x-icons.circle-filled class=""></x-icons.circle-filled>
        @endfor
        @if($rating - $i >= -0.5)
            <x-icons.circle-half class=""></x-icons.circle-half>
        @endif
        @for($k = 0; $k < 5 - round($rating); $k++)
            <x-icons.circle></x-icons.circle>
        @endfor
        <span class="px-0.5 rounded-sm">{{ $rating }}</span>
    @endif
</span>
