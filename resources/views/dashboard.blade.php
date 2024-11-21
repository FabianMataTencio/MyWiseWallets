<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center font-bold text-3xl text-cyan-500">
                    {{__('Welcome')}} {{auth()->user()->name}}!
                </div>
                <x-home></x-home>
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 py-8">
        <h1 class="font-semibold text-center text-5xl text-cyan-500 dark:text-cyan-500 leading-tight lg:mr-3 mb-8">
            ⭐️ {{(__('Reviews'))}} ⭐️
        </h1>
        <livewire:review.show-reviews-home />
    </div>
</x-app-layout>
