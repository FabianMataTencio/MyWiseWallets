<div class="p-10 bg-gray-800 rounded-lg shadow-md max-w-4xl mx-auto">
    <h1 class="text-2xl text-white font-bold text-center mb-10">{{ __('Outcome') }}</h1>
    <div class="md-5">
        <div class="md:grid md:grid-cols-2 gap-6 bg-gray-700 p-6 rounded-lg my-10 shadow-lg">
            <div>
                <p class="font-bold text-lg text-gray-300 my-3">{{__('Outcome Amount')}}:</p>
                <span class="block text-xl text-white font-semibold">{{ $outcome->outcome_amount }}</span>
            </div>

            <div>
                <p class="font-bold text-lg text-gray-300 my-3">{{__('Category')}}:</p>
                <span class="block text-xl text-white font-semibold">{{ $outcome->categorie->categoria }}</span>
            </div>

            <div>
                <p class="font-bold text-lg text-gray-300 my-3">{{__('Cash Flow')}}:</p>
                <span class="block text-xl text-white font-semibold">
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

            <div>
                <p class="font-bold text-lg text-gray-300 my-3">{{__('Date')}}:</p>
                <span class="block text-xl text-white font-semibold">{{ $outcome->outcome_date->format('d/m/Y')}}</span>
            </div>

            <div class="md:col-span-2">
                <p class="font-bold text-lg text-gray-300 my-3">{{__('Outcome Description')}}:</p>
                <span class="block text-xl text-white font-semibold">{{ $outcome->outcome_description }}</span>
            </div>
        </div>

        @if($outcome->image)
            <div class="md:grid md:grid-cols-6 gap-4 my-6">
                <div class="md:col-span-2">
                    <img src="{{ asset('storage/outcomes/' . $outcome->image) }}" alt="{{'Outcome Image' . $outcome->outcome_description}}" class="rounded-lg shadow-lg max-w-full h-auto">
                </div>
            </div>
        @endif
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('outcomes.index') }}" 
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold py-3 px-12 rounded-full 
            transition ease-in-out duration-200 transform hover:scale-105">
            {{ __('Come back') }}
        </a>
    </div>
</div>
