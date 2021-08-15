<x-app-layout>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <div class="text-center">
            <div class="text-4xl font-black">
                {{ __("Upgrade to continue") }}
            </div>
            <div class="mt-4">
                {{ __("Pay monthly or get 2 months free when purchasing an annual plan.") }}
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 mt-12">

            <div class="col-span-2 sm:col-span-1">
                <div class="rounded-xl shadow">
                    <div class="rounded-t-xl p-6 bg-white">
                        <div class="inline-block px-4 py-1 bg-gray-100 rounded-full text-sm font-medium uppercase text-bluegray-900">
                            {{__("Monthly")}}
                        </div>

                        <div class="mt-6 flex items-baseline text-6xl font-extrabold">
                            $29
                            <span class="ml-1 text-2xl font-medium text-gray-500">/mo</span>
                        </div>

                        <div class="mt-5 text-lg text-gray-500">
                            {{__("Pay for Voicebits on a month to month basis.")}}
                        </div>
                    </div>

                    <div class="px-6 pt-6 pb-8 rounded-b-xl bg-gray-50 space-y-6 sm:pt-6">
                        <ul class="space-y-4">
                            <li class="flex items-center gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-base text-gray-700">{{ __("Up to 5 shows") }}</p>
                            </li>

                            <li class="flex items-center gap-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-base text-gray-700">{{ __("Multiple teams") }}</p>
                            </li>

                            <li class="flex items-center gap-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-base text-gray-700">{{ __("50.000 monthly downloads") }}</p>
                            </li>

                            <li class="flex items-center gap-4 line-through text-red-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <p class="text-base">{{ __("Get 2 months free") }}</p>
                            </li>
                        </ul>

                        <div class="mb-8">
                            <a href="" class="block w-full p-4 rounded-lg text-center bg-bluegray-700 text-white font-semibold hover:bg-bluegray-900 hover:shadow transition">
                                {{__("Get Started")}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2 sm:col-span-1">
                <div class="rounded-xl shadow">
                    <div class="rounded-t-xl p-6 bg-white">
                        <div class="inline-block px-4 py-1 bg-gray-100 rounded-full text-sm font-medium uppercase text-bluegray-900">
                            {{__("Annual")}}
                        </div>

                        <div class="mt-6 flex items-baseline text-6xl font-extrabold">
                            $290
                            <span class="ml-1 text-2xl font-medium text-gray-500">/year</span>
                        </div>

                        <div class="mt-5 text-lg text-gray-500">
                            {{__("Get 2 months free when paying annually.")}}
                        </div>
                    </div>

                    <div class="px-6 pt-6 pb-8 rounded-b-xl bg-gray-50 space-y-6 sm:pt-6">
                        <ul class="space-y-4">
                            <li class="flex items-center gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-base text-gray-700">{{ __("Up to 5 shows") }}</p>
                            </li>

                            <li class="flex items-center gap-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-base text-gray-700">{{ __("Multiple teams") }}</p>
                            </li>


                            <li class="flex items-center gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-base text-gray-700">{{ __("50.000 monthly downloads") }}</p>
                            </li>

                            <li class="flex items-center gap-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <p class="text-base text-gray-700">{{ __("Get 2 months free") }}</p>
                            </li>
                        </ul>

                        <div class="mb-8">
                            <a href="" class="block w-full p-4 rounded-lg text-center bg-bluegray-700 text-white font-semibold hover:bg-bluegray-900 hover:shadow transition">
                                {{__("Get Started")}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-2 mx-auto text-bluegray-500">
                {{ __("More plan options coming soon.") }}
            </div>

        </div>

    </div>

</x-app-layout>
