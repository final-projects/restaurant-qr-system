@props(['title', 'value', 'color' => 'indigo'])

<div class="bg-white shadow rounded-lg p-6 hover:shadow-md transition">
    <div class="text-sm text-gray-500 mb-1">{{ $title }}</div>
    <div class="text-3xl font-bold text-{{ $color }}-600">{{ $value }}</div>
</div>
