<x-app-layout>
    
    <livewire:transactions/>

    <section x-data="{ 
        OpenCategoria: '', 
        OpenCrearCategoria: '', 
        OpenEliminarCategoria: '',
        OpenFilterIncomes : '',
    }" 
    x-init="
        Livewire.on('closeCreateCategoryModal', () => { OpenCrearCategoria = false })
        Livewire.on('closeDeleteCategoryModal', () => { OpenEliminarCategoria = false })
        Livewire.on('closeFilterIncomesModal', () => { OpenFilterIncomes = false })
    " 
    class="flex flex-col gap-4 mt-16">

        <!-- Navegación -->
        <nav class="text-center font-normal space-x-4">
            <a href="{{ route('incomes.index') }}" 
                class="rounded-full w-32 py-2 px-3 text-center font-semibold text-lg {{ $currentRoute === 'incomes.index' ? 'bg-cyan-600 hover:bg-cyan-800 text-white shadow-lg' : 'text-gray-800' }} {{ $currentRoute !== 'incomes.index' ? 'hover:bg-cyan-500 hover:text-white rounded-full' : '' }}">
                {{ __('Incomes') }}
            </a>
            <span class="text-lg font-semibold">/</span>
            <a href="{{ route('outcomes.index') }}"
                class="rounded-full w-32 py-2 px-3 text-center font-semibold text-lg {{ $currentRoute === 'outcomes.index' ? 'bg-cyan-600 hover:bg-cyan-800 text-white shadow-lg' : 'text-gray-800' }} {{ $currentRoute !== 'outcomes.index' ? 'hover:bg-cyan-500 hover:text-white rounded-full' : '' }}">
                {{ __('Outcomes') }}
            </a>
        </nav>

        <!-- Botones para Categorías y Crear Gasto -->
        <div class="flex gap-4 justify-center items-center mt-4">
            <div>
                <button @click="OpenCategoria=true" class="w-full py-2 px-4 bg-cyan-400 hover:bg-cyan-600 text-white rounded-full">
                    {{__("Categories")}}
                </button>
            </div>
            <div>
                <a href="{{ route('incomes.create') }}" class="w-full py-2 px-4 bg-cyan-400 hover:bg-cyan-600 text-white rounded-full">
                    {{__("Create income")}}
                </a>
            </div>
            <div>
                <button @click="OpenFilterIncomes=true" class="w-full py-2 px-4 bg-cyan-400 hover:bg-cyan-600 text-white rounded-full">
                    {{__("Filters")}}
                </button>
            </div>
        </div>

        <!-- Modal para Seleccionar Crear o Eliminar Categoría -->
        <div x-show="OpenCategoria" style="display: none" x-transition
            class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-gray-700 text-white p-6 rounded-lg shadow-lg w-full max-w-sm text-center">
                <p class="text-lg mb-4">{{__("Categories")}}</p>
                <div class="flex justify-center space-x-4">
                    <button @click="OpenCrearCategoria = true; OpenCategoria = false"
                        class="py-2 px-4 bg-blue-500 text-white rounded-lg w-24">{{__("Create")}}</button>
                    <button @click="OpenEliminarCategoria = true; OpenCategoria = false"
                        class="py-2 px-4 bg-red-400 text-white rounded-lg w-24">{{__("Delete")}}</button>
                    <button type="button" @click="OpenCategoria = false"
                        class="py-2 px-4 bg-red-500 text-white rounded-lg w-24 hover:bg-red-600 transition">{{__("Close")}}</button>
                </div>
                
            </div>
        </div>
        <!-- Ventanas Modales -->
        <x-modals.create-category-modal/>
        <x-modals.delete-category-modal/>
        <x-modals.filter-incomes-modal/>

        <!-- Lista de Resultados -->
        <livewire:show-incomes/>
        <p class="mt-3 text-gray-600 text-sm text-center text-wrap">{{ __('Note: By default, only the income for the current month is displayed. If you want to see income from other months, you can use the filters.') }}</p>
            

    </section>
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