<div>
    <div class="p-6 text-gray-900 dark:text-gray-800">
        <h1 class="text-2xl font-bold text-center mb-10">{{ __('New notifications') }}</h1>
        @forelse ($notifications as $economic_goal)
            <div class="p-5 border border-gray-200 lg:flex lg:justify-between lg:items-center">
                <div>
                    @switch($economic_goal->data['message'])
                        @case(1)
                            <p class="text-green-600 text-lg">{{ __('Goal achieved!') }}</p>
                            <p>{{ __('Goal Name') }}: 
                                <span class="font-bold">{{ $economic_goal->data['goal_name'] ?? __('No name available') }}</span>
                            </p>
                            @break

                        @case(2)
                            <p class="text-red-500 text-lg">{{ __('Goal not achieved') }}</p>
                            <p>{{ __('Goal Name') }}: 
                                <span class="font-bold">{{ $economic_goal->data['goal_name'] ?? __('No name available') }}</span>
                            </p>
                            @break

                        @case(3)
                            <p class="text-blue-500 text-lg">{{ __('Goal achieved before deadline!') }}</p>
                            <p>{{ __('Goal Name') }}: 
                                <span class="font-bold">{{ $economic_goal->data['goal_name'] ?? __('No name available') }}</span>
                            </p>
                            <p class="text-gray-800">{{ __('Congratulations! You deposited more money than you set as your goal and did it ahead of schedule.') }}</p>
                            @break

                        @case(4)
                            <p class="text-red-500 text-lg">{{ __('Goal failed after deadline') }}</p>
                            <p>{{ __('Goal Name') }}: 
                                <span class="font-bold">{{ $economic_goal->data['goal_name'] ?? __('No name available') }}</span>
                            </p>
                            <p class="text-gray-800">{{ __('Bad news: You deposited more money than you had planned not to.') }}</p>
                            @break
                        @default
                            <p class="text-blue-900">{{ __('Unknown status') }}</p>
                    @endswitch
                    <p>{{ __('Hace') }}:
                        <span class="font-bold">{{ $economic_goal->created_at->diffForHumans() }}</span>
                    </p>
                </div>
                <div class="mt-5 lg:mt-0 flex gap-4">
                    <a href="{{ route('economicgoals.show', $economic_goal->data['economic_goal_id'] ?? '#') }}"
                       class="flex items-center justify-center w-full lg:w-auto bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-600 transition">
                        <span>{{ __("Show more") }}</span>
                        <x-icons.view-icon class="!w-5 !h-5 ml-2" />
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-700 text-lg">{{ __('There are no new notifications') }}</p>
            <p class="text-center text-gray-500 text-sm text-wrap">{{ __('(Note: Notifications are created when an economic goal is achieved or failed.)') }}</p>
        @endforelse
    </div>

    <div class="mt-8 p-6 text-gray-900 dark:text-gray-800">
        <h1 class="text-2xl font-bold text-center mb-10">{{ __('Notification history') }}</h1>
        @forelse ($notificationsHistory as $notification)
            <div class="p-5 border border-gray-200 lg:flex lg:justify-between lg:items-center">
                <div>
                    @switch($notification->data['message'])
                        @case(1)
                            <p class="text-green-600 text-lg">{{ __('Goal achieved!') }}</p>
                            <p>{{ __('Goal Name') }}: 
                                <span class="font-bold">{{ $notification->data['goal_name'] ?? __('No name available') }}</span>
                            </p>
                            @break

                        @case(2)
                            <p class="text-red-500 text-lg">{{ __('Goal not achieved') }}</p>
                            <p>{{ __('Goal Name') }}: 
                                <span class="font-bold">{{ $notification->data['goal_name'] ?? __('No name available') }}</span>
                            </p>
                            @break

                        @case(3)
                            <p class="text-blue-500 text-lg">{{ __('Goal achieved before deadline!') }}</p>
                            <p>{{ __('Goal Name') }}: 
                                <span class="font-bold">{{ $notification->data['goal_name'] ?? __('No name available') }}</span>
                            </p>
                            <p class="text-gray-800">{{ __('Congratulations! You deposited more money than you set as your goal and did it ahead of schedule.') }}</p>
                            @break

                        @case(4)
                            <p class="text-red-500 text-lg">{{ __('Goal failed after deadline') }}</p>
                            <p>{{ __('Goal Name') }}: 
                                <span class="font-bold">{{ $notification->data['goal_name'] ?? __('No name available') }}</span>
                            </p>
                            <p class="text-gray-800">{{ __('Bad news: You deposited more money than you had planned not to.') }}</p>
                            @break
                        @default
                            <p class="text-blue-900">{{ __('Unknown status') }}</p>
                    @endswitch
                    <p>{{ __('Hace') }}:
                        <span class="font-bold">{{ $notification->created_at->diffForHumans() }}</span>
                    </p>
                </div>
                <div class="mt-5 lg:mt-0 flex gap-4">
                    <a href="{{ route('economicgoals.show', $notification->data['economic_goal_id'] ?? '#') }}"
                       class="flex items-center justify-center w-full lg:w-auto bg-blue-500 text-white py-2 px-4 rounded-full hover:bg-blue-600 transition">
                        <span>{{ __("Show more") }}</span>
                        <x-icons.view-icon class="!w-5 !h-5 ml-2" />
                    </a>
                    <button wire:click="deleteNotification('{{ $notification->id }}')"
                            class="flex items-center justify-center w-full lg:w-auto bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-600 transition">
                        {{ __('Delete') }}
                        <x-icons.trash-icon class="ml-2 !w-5 !h-5" />
                    </button>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-700 text-lg">{{ __('There are no new notifications') }}</p>
        @endforelse
    </div>
</div>
