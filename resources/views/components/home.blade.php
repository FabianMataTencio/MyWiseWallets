<div class="flex flex-col lg:flex-row items-start justify-between m-10 space-y-6 lg:space-y-0">
    <!-- Sección de texto -->
    <div class="lg:w-1/2 pr-14">
        <p class="text-lg font-bold text-gray-800 text-left text-wrap z-1">
            <span class="text-cyan-500">WiseWallet</span> {{__('is an application designed to help you take control of your finances. With this app, you can track your income and expenses, set financial goals, and manage your money efficiently.')}}
        </p>
        <p class="text-lg font-bold text-gray-800 text-left mt-4 z-1">
            {{__('Don’t wait any longer—')}}<a href="{{route('login')}}" class="fond-bold text-cyan-500"> {{__('Sign Up now')}} </a>{{__('to unlock all the features WiseWallet has to offer!')}}
        </p>
        
        <div class="mt-12 text-center mb-7">
            @guest
                <a href="{{ route('login') }}" 
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold py-5 px-14 rounded-full 
                    transition ease-in-out duration-200 transform hover:scale-105">
                    {{ __('Log in') }}
                </a>
            @endguest
            @auth
                <p class="text-cyan-800 text-xl font-light mb-9">
                    {{ __('You are logged in!') }}
                </p>
                <a href="{{ route('incomes.index') }}" class="px-6 py-4 sm:px-10 sm:py-5 md:px-14 md:py-7 bg-gradient-to-r from-blue-600 to-green-500 text-white font-semibold 
                        rounded-full shadow-md transform transition-all duration-300 hover:scale-105 hover:from-green-500 hover:to-blue-600">
                    {{ __('Explore the app') }}
                </a>

            @endauth
        </div>
    </div>

    <div class="relative flex lg:w-1/2 mt-8"> 
        <img 
            src="{{ asset('imgs/home_view.jpg') }}" 
            class="relative h-auto w-full max-w-2xl transform -rotate-4 animate-zoom2" 
            alt="economic_goal_view">
    </div>
</div>