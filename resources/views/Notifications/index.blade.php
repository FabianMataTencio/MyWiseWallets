<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl  text-cyan-500 dark:text-cyan-500 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg">
                <livewire:notification.show-notifications />
            </div>
        </div>
    </div>
</x-app-layout>

