<div>
    <div x-show="OpenFilterEconomicGoals" style="display: none">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <form wire:submit.prevent='readFilterData'>
                <h3 class="text-lg font-semibold mb-4">{{__('Filters')}}</h3>
                <x-input-label for="filter_by_day" :value="__('Filter by goal name')" />
                <div class="mb-4">
                    <x-input-label for="goal_name" :value="__('The name could be the same as the goal name or similar')" />
                    <x-text-input 
                        id="goal_name" 
                        class="block mt-1 w-full" 
                        type="text" 
                        wire:model="goal_name" 
                        :value="old('goal_name')" 
                    />
                    <x-input-error :messages="$errors->get('goal_name')" class="mt-2" />
                </div>
                <x-input-label for="filter_by_day" :value="__('Filter by day')" />
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <x-input-label for="start_date" :value="__('Start Date')" />
                        <x-text-input 
                            id="start_date" 
                            class="block mt-1 w-full" 
                            type="date" 
                            wire:model="start_date" 
                            :value="old('start_date')" 
                        />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="end_date" :value="__('Deadline')" />
                        <x-text-input 
                            id="end_date" 
                            class="block mt-1 w-full" 
                            type="date" 
                            wire:model="end_date" 
                            :value="old('end_date')" 
                        />
                        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                    </div>
                </div>
                <x-input-label for="rang_of_amount" :value="__('Filter by rang of amount')" />
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <x-input-label for="minimum_goal_amount" :value="__('Minimum amount')" />
                        <x-text-input 
                            id="minimum_goal_amount" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="minimum_goal_amount" 
                            :value="old('minimum_goal_amount')" 
                        />
                        <x-input-error :messages="$errors->get('minimum_goal_amount')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="maximun_goal_amount" :value="__('Maximum amount')" />
                        <x-text-input 
                            id="maximun_goal_amount" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="maximun_goal_amount" 
                            :value="old('maximun_goal_amount')" 
                        />
                        <x-input-error :messages="$errors->get('maximun_goal_amount')" class="mt-2" />
                    </div>
                </div>
                <x-input-label class="mt-2" :value="__('Funds deposited')" />
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <x-input-label for="minimum_funds_amount" :value="__('Minimum amount')" />
                        <x-text-input 
                            id="minimum_funds_amount" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="minimum_funds_amount" 
                            :value="old('minimum_funds_amount')" 
                        />
                        <x-input-error :messages="$errors->get('minimum_funds_amount')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="maximun_funds_amount" :value="__('Maximum amount')" />
                        <x-text-input 
                            id="maximun_funds_amount" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="maximun_funds_amount" 
                            :value="old('maximun_funds_amount')" 
                        />
                        <x-input-error :messages="$errors->get('maximun_funds_amount')" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="submit" value="search" @click="OpenFilterEconomicGoals = false"  class="py-2 px-4 bg-cyan-600 hover:bg-cyan-800 text-white rounded">{{__("Filter")}}</button>
                    <button type="button" wire:click="resetFilters" @click="OpenFilterEconomicGoals = false"  class="py-2 px-4 bg-cyan-600 hover:bg-cyan-800 text-white rounded">{{__("Delete Filters")}}</button>
                    <button type="button" @click="OpenFilterEconomicGoals = false" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition">{{__("Close")}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
