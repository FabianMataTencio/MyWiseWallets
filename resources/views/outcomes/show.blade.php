<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cyan-500 dark:text-cyan-500 leading-tight">
            {{ __('Outcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="md:flex md:justify-center p-5">
                <livewire:outcome.show-outcome 
                    :outcome="$outcome"/>
            </div>
        </div>
    </div>
</x-app-layout>