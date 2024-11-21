<form class="md:w-1/2 space-y-5" wire:submit.prevent='createIncome'>
    <div>
        <x-input-label for="income_amount" :value="__('Income Amount')" />
        <x-text-input 
            id="income_amount" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="income_amount" 
            :value="old('income_amount')" 
            placeholder="$"
        />
        <x-input-error :messages="$errors->get('income_amount')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="categorie_id" :value="__('Category')" />
        <select 
            wire:model="categorie_id" 
            id="categorie_id" 
            class="block font-medium text-sm text-gray-900 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white">
            <option>{{__("-- Select --")}}</option>
            @forelse ($categories as $category)
            <option value="{{$category->id}}">{{$category->categoria}}</option>
            @empty
            <option disabled selected>{{__("There are not income categories, you must create one")}}</option>
            @endforelse
        </select>
        <x-input-error :messages="$errors->get('categorie_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="cash_folow_id" :value="__('Cash Flow')" />
        <select 
            wire:model="cash_folow_id" 
            id="cash_folow_id" 
            class="block font-medium text-sm text-gray-900 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white">
            <option>{{__("-- Select --")}}</option>
            <option value="1">{{__('Unique')}}</option>
            <option value="2">{{__('Daily')}}</option>
            <option value="3">{{__('Weekly')}}</option>
            <option value="4">{{__('Monthly')}}</option>
            <option value="5">{{__('Annually')}}</option>
        </select>
        <x-input-error :messages="$errors->get('cash_folow_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="income_date" :value="__('Date')" />
        <x-text-input 
            id="income_date" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="income_date" 
            :value="old('income_date')" 
        />
        <x-input-error :messages="$errors->get('income_date')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="income_description" :value="__('Income Description')" />
        <textarea 
            wire:model="income_description" 
            id="income_description"
            placeholder="{{__('Income Description')}}"
            class="block font-medium text-sm text-gray-700 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white h-72">
        </textarea>
        <x-input-error :messages="$errors->get('income_description')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="image" :value="__('Image(optional)')" />
        <x-text-input 
            id="image" 
            class="block mt-1 w-full" 
            type="file" 
            wire:model='image'
            accept="image/*"
        />
        <div class="my-5 w-80">
            @if ($image)
                {{__('Image')}}:
                <img src="{{$image->temporaryUrl()}}" alt="">
            @endif
        </div>
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
    </div>

    <x-primary-button>
        {{__('Save')}}
    </x-primary-button>
</form>

