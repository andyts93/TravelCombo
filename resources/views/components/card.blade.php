<div {{ $attributes->merge(['class' => "flex flex-col gap-6 border-0 shadow-lg rounded-3xl bg-white/80 backdrop-blur-sm"]) }}>
    @if(isset($header))
        <div class="p-6">
            <div class="flex items-center gap-3">
                {{ $header }}
            </div>
        </div>
    @endif
    <div class="px-6 pb-6">
        {{ $slot }}
    </div>
</div>
