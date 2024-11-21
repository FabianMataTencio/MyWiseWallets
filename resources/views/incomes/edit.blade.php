<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-500 dark:text-cyan-500 leading-tight">
            {{ __('Update Income') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-700">
                    <h1 class="text-2xl font-bold text-center mb-10">{{ __('Update Income') }}</h1>
                    <div class="md:flex md:justify-center p-5">
                        <livewire:edit-income 
                            :income="$income"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>