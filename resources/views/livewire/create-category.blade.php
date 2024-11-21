<div>
    <div x-show="OpenCrearCategoria" style="display: none" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <form wire:submit.prevent="crearCategoria">
                <h2 class="text-xl font-bold mb-4">{{__("Create a new category")}}</h2>
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">{{__("Category:")}}</label>
                    <input type="text" id="category" wire:model="category"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800" required>
                    @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="type_category" class="block text-sm font-medium text-gray-700">{{__("Type of category:")}}</label>
                    <select id="type_category" wire:model="type_category"
                        class="border border-gray-300 rounded w-full py-2 px-4 text-gray-800" required>
                        <option value="">{{__("Select a type")}}</option>
                        <option value="1">{{__("Income")}}</option>
                        <option value="2">{{__("Outcome")}}</option>
                    </select>
                    @error('type_category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                @if ($message)
                    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3500)" x-show="show">
                        <div id="alert" class="border border-green-600 bg-green-100 text-green-600 font-bold p-2 my-3">
                            {{ $message }}
                        </div>
                    </div>
                @endif
                <div class="flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">{{__("Save")}}</button>
                    <button type="button" @click="OpenCrearCategoria = false"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">{{__("Close")}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

