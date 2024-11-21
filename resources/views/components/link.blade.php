@php
    $classes="text-sm text-gray-100 dark:text-white hover:text-gray-300 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800";
@endphp

<a {{$attributes -> merge(['class'=>$classes])}}>
    {{ $slot }}
</a>