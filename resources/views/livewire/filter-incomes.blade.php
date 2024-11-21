<div>
    <div x-show="OpenFilterIncomes" style="display: none">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <form wire:submit.prevent='readFilterData'>
                <h3 class="text-lg font-semibold mb-4">{{__('Filters')}}</h3>
                <!-- Filtro por categoría -->
                <div class="mb-4">
                    <x-input-label for="categorie_id" :value="__('Filter by category')" />
                    <select 
                        wire:model="categorie_id" 
                        id="categorie_id" 
                        class="block font-medium text-sm text-gray-900 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white">
                        <option>{{__("-- Select --")}}</option>
                        @forelse ($categories as $category)
                        <option value="{{$category->id}}">{{$category->categoria}}</option>
                        @empty
                        <option disabled selected>{{__("There are no categories, you must create one")}}</option>
                        @endforelse
                    </select>
                    <x-input-error :messages="$errors->get('categorie_id')" class="mt-2" />
                </div>

                <!-- Filtro por rango de fechas -->
                <x-input-label for="filter_by_day" :value="__('Filter by day')" />
                <div class="mb-4">
                    <x-input-label for="start_date" :value="__('Start date')" />
                    <x-text-input 
                        id="start_date" 
                        class="block mt-1 w-full" 
                        type="date" 
                        wire:model="start_date" 
                        :value="old('start_date')" 
                    />
                    <x-input-error :messages="$errors->get('start_date')" class="mt-2" />

                    <x-input-label for="end_date" :value="__('End date')" />
                    <x-text-input 
                        id="end_date" 
                        class="block mt-1 w-full" 
                        type="date" 
                        wire:model="end_date" 
                        :value="old('end_date')" 
                    />
                    <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                </div>

                <!-- Filtro por rango de montos -->
                <x-input-label for="rang_of_amount" :value="__('Filter by rang of amount')" />
                <div class="mb-4">
                    <x-input-label for="minimum_amount" :value="__('Minimum amount')" />
                    <x-text-input 
                        id="minimum_amount" 
                        class="block mt-1 w-full" 
                        type="text" 
                        wire:model="minimum_amount" 
                        :value="old('minimum_amount')" 
                    />
                    <x-input-error :messages="$errors->get('minimum_amount')" class="mt-2" />
                    <x-input-label for="maximun_amount" :value="__('Maximum amount')" />
                    <x-text-input 
                        id="maximun_amount" 
                        class="block mt-1 w-full" 
                        type="text" 
                        wire:model="maximun_amount" 
                        :value="old('maximun_amount')" 
                    />
                    <x-input-error :messages="$errors->get('maximun_amount')" class="mt-2" />
                </div>

                <!-- Botones para aplicar y limpiar filtros -->
                <div class="flex justify-end space-x-4">
                    <button type="submit" value="search" @click="OpenFilterIncomes = false"  class="py-2 px-4 bg-cyan-600 hover:bg-cyan-800 text-white rounded">{{__("Filter")}}</button>
                    <button type="button" wire:click="resetFilters" @click="OpenFilterIncomes = false"  class="py-2 px-4 bg-cyan-600 hover:bg-cyan-800 text-white rounded">{{__("Delete Filters")}}</button>
                    <button type="button" @click="OpenFilterIncomes = false" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">{{__("Close")}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
