@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-block px-7 py-2  relative
                before:border-y-[1.4rem] before:border-y-transparent before:border-l-[1.4rem] before:border-white before:absolute before:top-0 before:bottom-0 before:left-0
                bg-[#da251c] text-lg font-bold text-white
                after:border-y-[1.4rem] after:border-y-transparent after:border-l-[1.4rem] after:border-[#da251c] after:bg-white after:absolute after:top-0 after:bottom-0 after:right-0'
            : 'inline-block px-7 py-2  relative
                before:border-y-[1.4rem] before:border-y-transparent before:border-l-[1.4rem] before:border-white before:absolute before:top-0 before:bottom-0 before:left-0
                bg-[#002e59]/75 text-lg font-bold text-white
                after:border-y-[1.4rem] after:border-y-transparent after:border-l-[1.4rem] after:border-[#002e59]/75 after:bg-white after:absolute after:top-0 after:bottom-0 after:right-0';
@endphp

<div {{ $attributes->merge(['class' => $classes ]) }}>
    {{ $slot }}
</div>
