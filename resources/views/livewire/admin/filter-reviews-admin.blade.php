<div class="bg-gray-900 py-10 rounded-xl mb-8">
    <h2 class="text-2xl md:text-4xl text-gray-200 text-center font-extrabold my-5">{{__('Filter Reviews')}}</h2>

    <div class="max-w-7xl mx-auto ml-4 mr-4">
        <form wire:submit.prevent='reedFormDataReviews'>
            <div class="md:grid md:grid-cols-3 gap-5">
                <div class="mb-5">
                    <label 
                        class="block mb-1 text-sm text-gray-200 uppercase font-bold "
                        for="data_terms">{{__('Data term')}}
                    </label>
                    <input 
                        id="data_terms"
                        type="text"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                        wire:model="data_terms"
                    />
                </div>

                <div class="mb-5">
                    <label 
                        class="block mb-1 text-sm text-gray-200 uppercase font-bold "
                        for="stars">{{__('Stars')}}
                    </label>
                    <select 
                        id="stars" 
                        wire:model="stars"
                        class="block font-medium text-sm text-gray-900 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm bg-white">
                        <option>{{__("-- Select --")}}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-center sm:justify-start space-x-4">
                <input 
                    type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 transition-colors text-white text-sm font-bold px-10 py-2 rounded cursor-pointer uppercase"
                    value="Search"
                />

                <button 
                    type="button"
                    class="bg-gray-500 hover:bg-gray-600 transition-colors text-white text-sm font-bold px-10 py-2 rounded cursor-pointer uppercase"
                    wire:click="resetFilters">
                    {{ __('Delete Filters') }}
                </button>
            </div>
        </form>
    </div>
</div>