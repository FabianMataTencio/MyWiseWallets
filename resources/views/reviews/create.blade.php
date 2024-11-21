<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-gray-900 p-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-white mb-6">{{__('Create New Review')}}</h1>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <!-- Mensaje de error si existe -->
                @if ($errors->any())
                    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3500)" x-show="show">
                        <div id="alert" class="border border-red-600 bg-red-100 text-red-600 font-bold p-2 my-3">
                            {{__('There were some errors with your review')}}
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="description" class="block text-gray-300 text-sm font-medium">{{__('Description')}}:</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 block w-full px-4 py-2 border border-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-800 text-white"
                        required>{{ old('description') }}</textarea>
                    <!-- Mostrar mensaje de error para el campo 'description' -->
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="rating" class="block text-gray-300 text-sm font-medium">{{__('Rating')}}:</label>
                    <div class="flex items-center">
                        <input type="hidden" id="rating" name="rating" value="{{ old('rating') }}" required>
                        <div class="flex space-x-1">
                            @foreach(range(1, 5) as $i)
                                <svg class="star w-8 h-8 text-gray-400 cursor-pointer {{ old('rating') >= $i ? 'text-yellow-500' : '' }}" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" onclick="setRating({{ $i }})">
                                    <path
                                        d="M12 .587l3.668 7.431L24 9.797l-6 5.847L19.335 24 12 19.799 4.665 24 6 15.644l-6-5.847 8.332-1.779z" />
                                </svg>
                            @endforeach
                        </div>
                    </div>
                    <!-- Mostrar mensaje de error para el campo 'rating' -->
                    @error('rating')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <button type="button" onclick="window.location='{{ route('reviews.index') }}'"
                        class="bg-gradient-to-r from-gray-700 to-gray-800 text-white py-2 px-4 rounded-md inline-flex items-center justify-center hover:from-gray-600 hover:to-gray-700 transition-colors duration-300">
                        &larr; {{__('Come back')}}
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-gray-700 to-gray-800 text-white py-2 px-4 rounded-md inline-flex items-center justify-center hover:from-gray-600 hover:to-gray-700 transition-colors duration-300">
                        <x-icons.create-icon/>
                        {{__('Create Review')}}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingInput = document.getElementById('rating');

        function setRating(rating) {
            ratingInput.value = rating;
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add('text-yellow-500');
                    s.classList.remove('text-gray-400');
                } else {
                    s.classList.remove('text-yellow-500');
                    s.classList.add('text-gray-400');
                }
            });
        }

        // Mantener el valor de las estrellas pre-seleccionadas
        if (ratingInput.value) {
            setRating(ratingInput.value);
        }
    </script>
</x-app-layout>
