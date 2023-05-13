@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
	'class' => 'px-3 py-2 bg-gray-100 border-gray-300 text-gray-700 focus:border-indigo-500 focus:outline-blue rounded-md shadow-sm',
	]) !!}>
