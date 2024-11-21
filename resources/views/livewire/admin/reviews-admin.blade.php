<div class="p-6 bg-gray-800 rounded-lg shadow-lg">
    <div class="overflow-x-auto">
        <table id="reviewsTable" class="table-auto w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-700 text-gray-300 text-center">
                    <th class="p-3 text-sm md:text-base">{{ __('User') }}</th>
                    <th class="p-3 text-sm md:text-base">{{ __('Description') }}</th>
                    <th class="p-3 text-sm md:text-base">{{ __('Stars') }}</th>
                    <th class="p-3 text-sm md:text-base">{{ __('Date') }}</th>
                    <th class="p-3 text-sm md:text-base">{{ __('Delete') }}</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 text-gray-100">
                @forelse ($reviews as $review)
                    <tr class="border-b border-gray-700">
                        <td class="p-3 text-sm md:text-base">{{ $review->user->name }}</td>
                        <td class="p-3 text-sm md:text-base">{{ $review->description }}</td>
                        <td class="p-3 text-sm md:text-base text-center">{{ $review->star_id }}</td>
                        <td class="p-3 text-sm md:text-base text-center">{{ $review->created_at->format('d/m/Y') }}</td>
                        <td class="p-3 text-center">
                            <button wire:click="deleteReview('{{ $review->id }}')"
                                class="bg-red-800 text-white p-2 rounded-full hover:bg-red-900 transition-colors duration-300">
                                <x-icons.trash-icon />
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-300 text-sm md:text-base">
                            {{ __('There are no reviews') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>