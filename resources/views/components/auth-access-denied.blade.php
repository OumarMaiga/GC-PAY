@props(['denied'])

@if ($denied)
    <div {{ $attributes->merge(['class' => 'font-medium text-lg text-red-600']) }}>
        {{ $denied }}
    </div>
@endif
