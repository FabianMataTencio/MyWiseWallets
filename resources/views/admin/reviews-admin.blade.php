<x-app-layout>

    <div class="container mx-auto px-4 py-8">
        <h1 class="font-semibold text-center text-5xl text-cyan-500 dark:text-cyan-500 leading-tight lg:mr-3 mb-8">
            {{(__('Reviews Admin'))}} 
        </h1>
        <livewire:admin.filter-reviews-admin/>
        <livewire:admin.reviews-admin/>
    </div>
</x-app-layout>