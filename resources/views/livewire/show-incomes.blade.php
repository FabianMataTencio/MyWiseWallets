<div class="col-span-full">
    <div class="divide-y divide-gray-600 w-full md:w-3/4 mx-auto bg-white shadow-md rounded-lg">
        @forelse ($incomes as $income)
            <div class="py-4 px-4 flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="flex-1 w-full md:w-auto">
                    <div class="px-3 py-1 text-left text-xs font-medium text-black uppercase tracking-wider">
                        {{__("Category:")}} <span class="font-bold text-gray-700">{{$income->categorie->categoria}}</span>
                    </div>
                    <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__("Date")}}: <span class="font-normal text-gray-700">{{$income->income_date->format('d/m/Y')}}</span>
                    </div>
                    <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__("Amount")}}: <span class="font-normal text-gray-700">{{$income->income_amunt}}</span>
                    </div>
                    <div class="px-3 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{__("Cash Flow")}}: 
                        <span class="font-normal text-gray-700">
                            @switch($income->cash_folow_id)
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
                <div class="flex flex-wrap space-x-2 mt-2 md:mt-1 ">
                    <a href="{{ route('incomes.show', $income->id)}}"
                        class="flex items-center mt-2 bg-blue-500 text-white pl-3 px-3 py-1 rounded-full hover:bg-blue-600 transition">
                        <span>{{__("Show more")}}</span>
                        <x-icons.view-icon class="!w-5 !h-5" />
                    </a>
                    <a href=" {{route('incomes.edit', $income->id)}} "
                        class="flex items-center mt-2 bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition">
                        <span>{{__("Update")}}</span>
                        <x-icons.update-icon/>
                    </a>
                    <button wire:click="$dispatch('showAlert', {{ $income->id }})"
                        class="flex items-center mt-2 bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition">
                        <span>{{__("Delete")}}</span>
                        <x-icons.trash-icon/>
                    </button>
                </div>
            </div>
        @empty
            <div class="py-4 px-4">
                <p class="text-gray-700 text-lg text-center">{{ __('No incomes available') }}</p>
            </div>
        @endforelse
    </div>
</div>
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('showAlert', incomeId => {
            Swal.fire({
                title: "{{ __('Delete income?') }}",  
                text: "{{ __('A deleted income can not be recovered') }}",  
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('Delete') }}",  
                cancelButtonText: "{{ __('Cancel') }}"  
            }).then((result) => {
                if (result.isConfirmed) {  
                    console.log(incomeId);
                    Livewire.dispatch('deleteIncome', {income: incomeId}); 
                    Swal.fire({
                        title: "{{ __('Deleted!') }}",
                        text: "{{ __('The income has been deleted') }}", 
                        icon: "success"
                    });
                }
            });
        })
    </script>
@endpush
