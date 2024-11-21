<div class="bg-white dark:bg-gray-100 overflow-hidden shadow-sm p-6 rounded-lg w-full max-w-4xl">
    <h1 class="text-3xl font-extrabold text-center text-gray-800 dark:text-gray-900 mb-10">
        {{ __('Economic Goal') }}
    </h1>

    @if ($economic_goal->state_id == 1)
        <div class="mt-3 text-lg font-bold rounded-lg bg-red-500 text-white px-3 py-1 w-48 text-center">
            {{ __('Failed') }}
        </div>
    @elseif ($economic_goal->state_id == 2)
        <div class="mt-3 text-lg font-bold rounded-lg bg-green-500 text-white px-3 py-1 w-48 text-center">
            {{ __('Achieved') }}
        </div>
    @else
        <h1 class="text-3xl font-bold text-blue-600">{{ number_format($percentage, 2) }}% <span class="font-bold text-lg text-blue-500">{{__('Completed')}}</span> </h1>
        <div class="progress-bar" style="--fill-size: {{ $percentage }}%;"></div>
        <div class="mt-4 text-sm font-bold rounded-lg bg-blue-300 text-black px-3 py-1 w-32 text-center">
            {{ __('In Progress') }}
        </div>
    @endif

    <div class="mb-4">
        <h3 class="text-xl font-semibold mb-2 mt-6 text-gray-700">
            {{ __('Goal Name') }}: 
            <span class="font-normal text-gray-900">{{$economic_goal->goal_name}}</span>
        </h3>
    </div>

    <h2 class="font-bold text-lg text-gray-600 mb-4">
        {{ __('The date range that your economic goal will start and end, these dates will determine if the goal is achieved or failed.') }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="mb-4">
            <x-input-label for="start_date" class="text-gray-800 text-lg font-semibold" :value="__('Start date')" />
            <span class="font-medium text-gray-900">{{$economic_goal->start_date->format('d/m/Y')}}</span>
        </div>

        <div class="mb-4">
            <x-input-label for="deadline" class="text-gray-800 text-lg font-semibold" :value="__('Deadline')" />
            <span class="font-medium text-gray-900">{{$economic_goal->deadline->format('d/m/Y')}}</span>
        </div>
    </div>

    <div class="mb-4">
        <p class="text-gray-700 mb-2 text-lg">
            {{ __('Description') }}: 
            <span class="font-medium text-gray-900">{{$economic_goal->goal_description}}</span>
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="mb-4">
            @if ($economic_goal->cash_folow_id == 6)
                <p class="text-gray-700 mb-2 text-lg">
                    {{ __('Goal amount greater than or equal to') }}: 
                    <span class="font-medium text-gray-900">{{$economic_goal->goal_amount}}</span>
                </p>
            @else
                <p class="text-gray-700 mb-2 text-lg">
                    {{ __('Goal amount less than or equal to') }}: 
                    <span class="font-medium text-gray-900">{{$economic_goal->goal_amount}}</span>
                </p>
            @endif
        </div>
        <div class="mb-4">
            <p class="text-gray-700 mb-2 text-lg">
                {{ __('Funds deposited') }}: 
                <span class="font-medium text-gray-900">{{$economic_goal->funds_deposited}}</span>
            </p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('economicgoals.index') }}" 
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold py-3 px-12 rounded-full 
            transition ease-in-out duration-200 transform hover:scale-105">
            {{ __('Come back') }}
        </a>
    </div>
</div>
