@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-yellow']) }}>
        {{ $status }}
    </div>
@endif
