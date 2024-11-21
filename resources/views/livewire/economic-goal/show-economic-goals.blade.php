<div class="grid gap-6 mt-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    @forelse ($economic_goals as $economic_goal)
        <div class="relative border border-gray-300 rounded-lg shadow-lg p-4">
            @if ($economic_goal->state_id == 1)
                <div class="absolute top-0 left-0 mt-2 ml-2 px-2 py-1 text-xs font-bold rounded-lg bg-red-500 text-white">
                    {{__('Failed')}}
                </div>
            @elseif ($economic_goal->state_id == 2)
                <div class="absolute top-0 left-0 mt-2 ml-2 px-2 py-1 text-xs font-bold rounded-lg bg-green-500 text-white">
                    {{__('Achieved')}}
                </div>
            @else
                <div class="absolute top-0 left-0 mt-2 ml-2 px-2 py-1 text-xs font-bold rounded-lg bg-blue-300 text-black">
                    {{__('In Progress')}}
                </div>
            @endif
            <h3 class="text-xl font-semibold mb-2 mt-6">{{__('Goal Name')}}: <span class="font-normal">{{$economic_goal->goal_name}}</span></h3>
            <p class="text-gray-700 mb-2">{{__('Start Date')}}: <span class="font-medium">{{$economic_goal->start_date->format('d/m/Y')}}</span></p>
            <p class="text-gray-700 mb-2">{{__('Deadline')}}: <span class="font-medium">{{$economic_goal->deadline->format('d/m/Y')}}</span></p>
            <p class="text-gray-700 mb-2">{{__('Goal Amount')}}: <span class="font-medium">{{$economic_goal->goal_amount}}</span></p>
            <p class="text-gray-700 mb-2">{{__('Funds deposited')}}: <span class="font-medium">{{$economic_goal->funds_deposited}}</span></p>
            <div class="flex flex-wrap space-x-2 mt-2 md:mt-1 ">
                <a href="{{ route('economicgoals.show', $economic_goal->id)}}"                        
                    class="flex items-center mt-2 bg-blue-500 text-white pl-3 px-3 py-1 rounded-full hover:bg-blue-600 transition">
                    <span>{{__("Show more")}}</span>
                    <x-icons.view-icon class="!w-5 !h-5" />
                </a>
                <a href=" {{route('economicgoals.edit', $economic_goal->id)}} "
                    class="flex items-center mt-2 bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition">
                    <span>{{__("Update")}}</span>
                    <x-icons.update-icon/>
                </a>
                <button wire:click="$dispatch('showAlert', {{ $economic_goal->categorie_id }})"
                    class="flex items-center mt-2 bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-600 transition">
                    <span>{{__("Delete")}}</span>
                    <x-icons.trash-icon/>
                </button>
            </div>
        </div>
    @empty
        <div class="relative border border-gray-300 rounded-lg shadow-lg p-4">
            <h1 class="fond-bold text-gray-700 text-3xl">{{__('There are not economic goals.')}}</h1>
        </div>
    @endforelse
</div>
@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('showAlert', categorieId => {
            Swal.fire({
                title: "{{ __('Delete economic goal?') }}",  
                text: "{{ __('A deleted economic goal cannot be recovered and will also delete the associated category and any related incomes or outcomes.') }}",  
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('Delete') }}",  
                cancelButtonText: "{{ __('Cancel') }}"  
            }).then((result) => {
                if (result.isConfirmed) { 
                    Livewire.dispatch('deleteEconomicGoal', {categorie: categorieId}); 
                    Swal.fire({
                        title: "{{ __('Deleted!') }}",
                        text: "{{ __('The economic goal has been deleted') }}", 
                        icon: "success"
                    });
                }
            });
        })
    </script>
@endpush
