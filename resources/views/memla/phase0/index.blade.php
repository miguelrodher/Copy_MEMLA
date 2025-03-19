<x-welcome-layout>
    <div class="bg-gray-50">
        <div class="relative py-6 mt-6 overflow-hidden">
            <div class="px-4 mx-auto mt-6 max-w-7xl sm:mt-4 sm:px-6">
                <div class="text-center">
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                        <span class="block text-memla-900">Introduction to machine learning</span>
                        <span class="block text-memla-800">Phase 0</span>
                    </h3>
                    <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">Under construction...</p>
                </div>
            </div>

            {{-- revisar los id de etiquetas y campos --}}



            <x-alert_info x-show="alert_info">
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-400">
                                <path fill-rule="evenodd" d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            It introduces basic concepts and activities for understanding machine learning principles. This phase is in the 5% of its development.
                        </div>
                    </div>
                </div>
            </x-alert_info>


        </div>
    </div>

</x-welcome-layout>
