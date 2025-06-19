@props(['route', 'icon', 'label'])

@php
    $active = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
   class="flex items-center gap-2 px-4 py-2 rounded hover:bg-indigo-100 text-gray-700 transition-all
   {{ $active ? 'bg-indigo-100 font-semibold text-indigo-700' : '' }}">
    <span>{{ $icon }}</span>
    @if($label)
        <span>{{ $label }}</span>
    @endif
</a>
