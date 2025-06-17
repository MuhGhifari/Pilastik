@props(['title' => null])

<div {{ $attributes->merge(['class' => 'flex flex-col bg-white rounded-2xl px-6 pb-6 pt-4 shadow-[0_1px_6px_rgba(0,0,0,0.25)]']) }}>
    @if($title)
        <h2 class="text-xl font-coolvetica text-forest m-0 p-0">{{ $title }}</h2>
    @endif
    {{ $slot }}
</div>