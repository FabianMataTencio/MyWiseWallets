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
                        {{__("Cash Flow")}}: <span class="font-normal text-gray-700">{{$income->cash_folow->tipo_flujo}}</span>
                    </div>
                </div>
                <div class="flex space-x-2 mt-3 md:mt-0">
                    <a href="{{ route('incomes.show', $income->id)}}"
                        class="flex items-center bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition gap-2">
                        <span>{{__("Show more")}}</span>
                        <x-icons.view-icon class="!w-5 !h-5" />
                    </a>
                    <a href=" {{route('incomes.edit', $income->id)}} "
                        class="flex items-center bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-600 transition">
                        <span>{{__("Update")}}</span>
                        <x-icons.update-icon/>
                    </a>
                </div>
            </div>
        @empty
            <div class="py-4 px-4">
                <p class="text-gray-500 text-center">{{ __('No incomes available') }}</p>
            </div>
        @endforelse
    </div>
</div>
