<div class="col-span-full">
    <div class="divide-y divide-gray-600 w-full md:w-3/4 mx-auto bg-white shadow-md rounded-lg">
        @forelse ($outcomes as $outcome)
            <div class="py-4 px-4 flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="flex-1 w-full md:w-auto">
                    <div class="px-3 py-1 text-left text-xs font-medium text-black uppercase tracking-wider">
                        {{__("Category:")}} <span class="font-bold text-gray-700">{{$outcome->categorie->categoria}}</span>
                    </div>
                    <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__("Date")}}: <span class="font-normal text-gray-700">{{$outcome->outcome_date->format('d/m/Y')}}</span>
                    </div>
                    <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__("Amount")}}: <span class="font-normal text-gray-700">{{$outcome->outcome_amount}}</span>
                    </div>
                    <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__("Cash Flow")}}: 
                        <span class="font-normal text-gray-700">
                            @switch($outcome->cash_folow_id)
                                @case(1)
                                    {{ __('Unique') }}
                                    @break
                                @case(2)
                                    {{ __('Daily') }}
                                    @break
                                @case(3)
                                    {{ __('Weekly') }}
                                    @break
                                @case(4)
                                    {{ __('Monthly') }}
                                    @break
                                @case(5)
                                    {{ __('Annually') }}
                                    @break
                                @default
                                    {{ __('Not Available') }}
                            @endswitch
                        </span>
                    </div>
                </div>
                <div class="flex flex-wrap space-x-2 mt-2 md:mt-1">
                    <a href="{{ route('outcomes.show', $outcome->id)}}"
                        class="flex items-center mt-2 bg-blue-500 text-white pl-3 px-3 py-1 rounded-full hover:bg-blue-600 transition">
                        <span>{{__("Show more")}}</span>
                        <x-icons.view-icon class="!w-5 !h-5" />
                    </a>
                    <a href=" {{route('outcomes.edit', $outcome->id)}} "
                        class="flex items-center mt-2 bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition">
                        <span>{{__("Update")}}</span>
                        <x-icons.update-icon/>
                    </a>
                    <button wire:click="$dispatch('showAlert', {{ $outcome->id }})"
                        class="flex items-center mt-2 bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition">
                        <span>{{__("Delete")}}</span>
                        <x-icons.trash-icon/>
                    </button>
                </div>
            </div>
        @empty
            <div class="py-4 px-4">
                <p class="text-gray-500 text-center">{{ __('No outcomes available') }}</p>
            </div>
        @endforelse
    </div>
</div>
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('showAlert', outcomeId => {
            Swal.fire({
                title: "{{ __('Delete outcome?') }}",  
                text: "{{ __('A deleted outcome can not be recovered') }}",  
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('Delete') }}",  
                cancelButtonText: "{{ __('Cancel') }}"  
            }).then((result) => {
                if (result.isConfirmed) { 
                    Livewire.dispatch('deleteOutcome', {outcome: outcomeId}); 
                    Swal.fire({
                        title: "{{ __('Deleted!') }}",
                        text: "{{ __('The outcome has been deleted') }}", 
                        icon: "success"
                    });
                }
            });
        })
    </script>
@endpush
