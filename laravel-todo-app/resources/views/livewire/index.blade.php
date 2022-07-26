<x-guest-layout>

    <div class="flex flex-1 items-center h-full">
        <div class="flex flex-row bg-gray-100 bg-opacity-90 justify-center items-center md:w-full shadow-xl ">

            <img
                src="https://to-do-cdn.microsoft.com/static-assets/c26cd0d92ec61ba2c661adefaa535ab3cc4fb124f347a850fded8034dad5d360/icons/welcome-left.png"
                class="object-contain hidden xl:block max-h-64 my-auto">
            <div class="flex flex-col items-center p-6">
                <x-jet-application-mark class="block h-16 w-auto mb-3"/>
                <h1 class="text-2xl font-semibold pb-3">{{__('Laravel/Jetstream TODO')}}</h1>
                <p class="text-lg text-base text-gray-800 pb-6  lg:pb-12 text-center w-2/3">{{__('Use our app and boost your productivity to the sky now!')}}</p>
                <a href="{{route('login')}}"
                   class="px-3 py-1 rounded bg-blue-400 hover:bg-blue-500 font-semibold mb-3 lg:mb-6 shadow-md">{{__('Start now!')}}</a>
                <div class="flex flex-col items-center lg:flex lg:justify-center lg:gap-x-4">
                    <a href="{{route('register')}}"
                       class="font-semibold text-sm text-gray-600 hover:text-black mb-1">{{__('Create account')}}</a>
                    <a href="" class="font-semibold text-sm text-gray-400 hover:text-black">{{__('Learn more')}}</a>
                </div>
            </div>
            <img
                src="https://to-do-cdn.microsoft.com/static-assets/f2f56b7d4c72910540effed9ccddae703d8d09b94075dddfeeab6cd79def0c60/icons/welcome-right.png"
                class="object-contain hidden xl:block max-h-64 my-auto">
        </div>
    </div>
</x-guest-layout>
