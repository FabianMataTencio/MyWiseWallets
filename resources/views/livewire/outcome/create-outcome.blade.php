<form class="md:w-1/2 space-y-5" wire:submit.prevent='createOutcome'>
    <div>
        <x-input-label for="outcome_amount" :value="__('Outcome Amount')" />
        <x-text-input 
            id="outcome_amount" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="outcome_amount" 
            :value="old('outcome_amount')" 
            placeholder="$"
        />
        <x-input-error :messages="$errors->get('outcome_amount')" class="mt-2" />
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
            <option disabled selected>{{__("There are not outcome categories, you must create one")}}</option>
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
        <x-input-label for="outcome_date" :value="__('Date')" />
        <x-text-input 
            id="outcome_date" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="outcome_date" 
            :value="old('outcome_date')" 
        />
        <x-input-error :messages="$errors->get('outcome_date')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="outcome_description" :value="__('Outcome Description')" />
        <textarea 
            wire:model="outcome_description" 
            id="outcome_description"
            placeholder="{{__('Outcome Description')}}"
            class="block font-medium text-sm text-gray-700 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white h-72">
        </textarea>
        <x-input-error :messages="$errors->get('outcome_description')" class="mt-2" />
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

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('showConfirmOutcome', () => {
            Swal.fire({
                title: "{{ __('Proceed') }}",  
                text: "{{ __('The amount you are trying to enter is greater than your remaining balance. Do you want to proceed?') }}",  
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('Yes') }}",  
                cancelButtonText: "{{ __('No') }}"  
            }).then((result) => {
                if (result.isConfirmed) { 
                    Livewire.dispatch('confirmOutcome'); 
                }
            });
        });
    </script>
@endpush
