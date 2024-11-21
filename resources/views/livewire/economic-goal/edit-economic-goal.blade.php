<form class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm p-6 rounded-lg w-full max-w-4xl" 
    wire:submit.prevent='editEconomicGoal'>
    <h1 class="text-2xl font-bold text-center mb-10">{{ __('Edit Economic Goal') }}</h1>
    <div class="grid grid-cols-1 gap-4 mb-4">

        <div class="mb-4">
            <x-input-label for="goal_name" :value="__('Name')" />
            <x-text-input 
                id="goal_name" 
                class="block mt-1 w-full" 
                type="text" 
                wire:model="goal_name" 
                :value="old('goal_name')" 
                placeholder="{{__('Name')}}"
            />
            <x-input-error :messages="$errors->get('goal_name')" class="mt-2" />
        </div>

        <h2 class="font-bold text-gray-600 mb-4">{{__('The date range that your economic goal will start and end, these dates will determine if the goal is achieved or failed.')}}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="mb-4">
                <x-input-label for="start_date" :value="__('Start date.')" />
                <x-text-input 
                    id="start_date" 
                    class="block mt-1 w-full" 
                    type="date" 
                    wire:model="start_date" 
                    :value="old('start_date')" 
                />
                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="deadline" :value="__('Deadline')" />
                <x-text-input 
                    id="deadline" 
                    class="block mt-1 w-full" 
                    type="date" 
                    wire:model="deadline" 
                    :value="old('deadline')" 
                />
                <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
            </div>
        </div>

        <div class="mb-4">
            <x-input-label for="goal_description" :value="__('Description')" />
            <textarea 
                wire:model="goal_description" 
                id="goal_description"
                placeholder="{{__('Description')}}"
                class="block font-medium text-sm text-gray-700 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white h-72">
            </textarea>
            <x-input-error :messages="$errors->get('goal_description')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div class="mb-4">
                <x-input-label for="cash_folow_id" :value="__('Amount')" />
                <select 
                    wire:model="cash_folow_id" 
                    id="cash_folow_id" 
                    class="mt-1 py-2 block font-medium text-sm text-gray-900 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white">
                    <option>{{__("-- Select --")}}</option>
                    <option value="6">{{__('Goal amount greater than or equal to')}}</option>
                    <option value="7">{{__('Goal amount less than or equal to')}}</option>
                </select>
                <x-input-error :messages="$errors->get('cash_folow_id')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="goal_amount" :value="__('Goal amount')" />
                <x-text-input 
                    id="goal_amount" 
                    class="block mt-1 w-full" 
                    type="text" 
                    wire:model="goal_amount" 
                    :value="old('goal_amount')" 
                    placeholder="$"
                />
                <x-input-error :messages="$errors->get('goal_amount')" class="mt-2" />
            </div>
        </div>
        <x-primary-button>
            {{__('Save')}}
        </x-primary-button>
    </div>
</form>
