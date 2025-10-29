@props(['color' => 'slate-gray'])

@php
switch($color) {
    case 'slate-gray':
        $bgColors = "from-slate-50 to-gray-100 shadow-slate-100/50";
        $iconColors = "from-slate-500 to-gray-500";
        break;
    case 'orange-red':
        $bgColors = "from-orange-50 to-red-100 shadow-orange-100/50";
        $iconColors = "from-orange-500 to-red-500 text-white";
        break;
    case 'cyan-blue':
        $bgColors = "from-cyan-50 to-blue-100 shadow-cyan-100/50";
        $iconColors = "from-cyan-500 to-blue-500 text-white";
        break;
    case 'blue-indigo':
        $bgColors = "from-blue-50 to-indigo-100 shadow-blue-100/50";
        $iconColors = "from-blue-500 to-indigo-500 text-white";
        break;
    case 'amber-red':
        $bgColors = "from-amber-50 to-red-100 shadow-amber-100/50";
        $iconColors = "from-amber-500 to-red-500 text-white";
        break;
    case 'green-brown':
        $bgColors = "from-green-50 to-orange-100 shadow-green-100/50";
        $iconColors = "from-green-500 to-amber-900 text-white";
        break;
}
@endphp

@push('tailwindcss-safelist')
    <div class="from-cyan-500 to-blue-500 from-cyan-50 to-blue-100 shadow-cyan-100/50 from-orange-50 to-red-100 shadow-orange-100/50 from-orange-500 to-red-500 text-white from-slate-50 to-gray-100 shadow-slate-100/50 from-slate-500 to-gray-500 from-blue-50 to-indigo-100 shadow-blue-100/50 from-blue-500 to-indigo-500 text-white from-amber-50 to-red-100 shadow-amber-100/50 from-amber-500 to-red-500 text-white from-green-50 to-amber-400 shadow-green-100/50 from-green-500 to-amber-900 text-white"></div>
@endpush

<div {{ $attributes->merge(['class' => "p-6 shadow-lg rounded-2xl overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-between bg-gradient-to-br $bgColors"]) }}>
    {{ $slot }}
    @if(isset($icon))
    <div class="icon p-2.5 bg-gradient-to-br rounded-xl shadow-md group-hover:scale-110 transition-transform duration-300 {{ $iconColors }}">
        {{ $icon }}
    </div>
    @endif
</div>
