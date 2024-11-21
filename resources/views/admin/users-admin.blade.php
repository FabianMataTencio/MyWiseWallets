<x-app-layout>

    <div class="container mx-auto px-4 py-8">
        <h1 class="font-semibold text-center text-5xl text-cyan-500 dark:text-cyan-500 leading-tight lg:mr-3 mb-8">
            {{(__('Users Admin'))}} 
        </h1>

        <livewire:admin.filter-users-admin/>
        <livewire:admin.users-admin/>
      
    </div>
</x-app-layout>