<x-app-layout>

    <div class="container mx-auto px-4 py-8">
        <h1 class="font-semibold text-center text-5xl text-cyan-500 dark:text-cyan-500 leading-tight lg:mr-3 mb-8">
            ⭐️ {{(__('Reviews'))}} ⭐️
        </h1>

        @auth
            <div class="text-center mb-8">
                <a href="{{route('reviews.create')}}"
                    class="bg-gradient-to-r from-gray-700 to-gray-900 text-white py-2 px-4 rounded-md inline-flex items-center justify-center hover:from-gray-600 hover:to-gray-800 transition-colors duration-300">
                    <x-icons.create-icon/>
                    {{__('Create Review')}}
                </a>
            </div>
        @endauth
        <livewire:review.show-reviews/>
    </div>
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