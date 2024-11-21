<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse ( $reviews as $review)
    <div
    class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
    <h3 class="text-2xl font-semibold text-gray-100 mb-3">
        {{__('Review by')}} {{$review->user->name}} 
    </h3>
    <p class="text-gray-200 mb-3"><strong>{{__('Description')}}:</strong> {{$review->description}}</p>
    <div class="flex items-center mb-4">
        @php
            $fullStars = $review->star_id;
            $emptyStars = 5 - $review->star_id;
        @endphp
        @for ($i = 0; $i < $fullStars; $i++)
            <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 24 24">
                <path
                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
            </svg>
        @endfor
        @for ($i = 0; $i < $emptyStars; $i++)
            <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
            </svg>
        @endfor
    </div>
    <div class="flex justify-between items-center border-t border-gray-500 pt-4">
        <p class="text-gray-300 text-sm">📅 {{$review->created_at->format('d/m/Y')}}</p>
    </div>
</div>
    @empty
    <div class="bg-gradient-to-r from-gray-800 via-gray-700 to-gray-600 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
        <h3 class="text-2xl font-semibold text-gray-100 mb-3">
            ⭐️ {{__('There are not reviews')}} ⭐️
        </h3>
    </div>
    @endforelse
    
</div>
