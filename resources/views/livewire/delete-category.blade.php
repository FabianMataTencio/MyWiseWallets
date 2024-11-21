<div>
    <div x-show="OpenEliminarCategoria" style="display: none" x-transition class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
            <h2 class="text-xl font-bold mb-4">{{__("Delete a category")}}</h2>
            <form wire:submit.prevent="eliminarCategoria">
                <div class="mb-4">
                    <label for="selectedCategory" class="block text-sm font-medium text-gray-700">{{__("Category:")}}</label>
                    <select id="selectedCategory" wire:model="selectedCategory"
                        class="border border-gray-300 rounded w-full py-2 px-4" required>
                        <option value="">{{__("Select a category")}}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->categoria }}
                            </option>
                        @endforeach
                    </select>
                    @error('selectedCategory') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                @if (session()->has('message'))
                    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 4000)" x-show="show">
                        <div id="alert" class="border border-green-600 bg-green-100 text-green-600 font-bold                    p-2 my-3">
                                {{ session('message') }}
                        </div>
                    </div>
                @endif
                <div class="flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">{{__("Delete")}}</button>
                    <button type="button" @click="OpenEliminarCategoria = false"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">{{__("Close")}}</button>
                </div>
            </form>
            @if (session()->has('error'))
                <div class="mt-4 text-red-500">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</div>
