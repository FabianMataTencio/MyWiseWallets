<x-app-layout>
    <x-slot name="slot">
        <div class="mt-4 flex flex-col items-center lg:flex-row lg:items-center lg:justify-center space-y-4 lg:space-y-0 lg:space-x-4">
            <h2 class="font-semibold text-center text-5xl text-cyan-500 dark:text-cyan-500 leading-tight lg:mr-3">
                {{ __('Economic Goals') }}
            </h2>
            <img src="{{ asset('imgs/economic_goal.png') }}" class="w-40 h-40 animate-zoom" alt="economic_goals" loading="lazy">
        </div>

        <div class="flex gap-4 justify-center items-center mt-10">
            <div>
                <a href="{{ route('economicgoals.create') }}" class="w-full py-2 px-4 bg-cyan-500 hover:bg-cyan-700 text-white rounded-full">
                    {{__("Create goal")}}
                </a>
            </div>
            <section x-data="{ OpenFilterEconomicGoals: false }"
                x-init="Livewire.on('closeFilterEconomicGoalsModal', () => { OpenFilterEconomicGoals = false })">
                <div>
                    <button @click="OpenFilterEconomicGoals = true" class="w-full py-2 px-4 bg-cyan-500 hover:bg-cyan-700 text-white rounded-full">
                        {{__("Filters")}}
                    </button>
                </div>
            <x-modals.filter-economic-goals-modal/>
            </section>
        </div>
        <div class="container mx-auto px-2 py-4">
        <livewire:economic-goal.show-economic-goals />
        </div>
    </x-slot>
</x-app-layout>
@if (session('message'))
    <script>
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: "{{ session('message') }}",
            showConfirmButton: false,
            timer: 2200
        });
    </script>
@endif
