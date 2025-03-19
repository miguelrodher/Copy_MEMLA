<x-dashboard-layout>
    <!-- Index Post -->

    <div class="container max-w-7xl mx-auto mt-8">
        <div class="bg-gray-50" x-data="{ buttonActive: '' }">
            <div class="relative py-6 mt-6 overflow-hidden">
                <div class="px-4 mx-auto mt-6 max-w-7xl sm:mt-4 sm:px-6">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                            <span class="block text-memla-900">Knowledge application</span>
                            <span class="block text-memla-800">Phase 5</span>
                        </h3>
                        <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">description...</p>
                    </div>
                </div>
                <div class="px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24">
                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <a href="{{asset("files/example_report.pdf")}}" target="_blank" class="inline-flex block px-6 py-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                            Print report
                            <!-- Heroicon name: mini/envelope -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                            </svg>
                        </a>
                    </div>
                </div>
                {{--  inline-flex items-center px-6 py-3 text-base font-medium text-white bg-memla-600 border border-transparent rounded-md shadow-sm hover:bg-memla-700 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2  --}}
                <div class="px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24">
                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <h4 class="font-bold tracking-tight text-center text-gray-900 text-1xl sm:text-1xl md:text-1xl">
                            Data model overview
                        </h4>
                        <table class="min-w-full mt-3 divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Property</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Value</th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Input data</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">WORK.IMPORT</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Target var</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">Class</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Event level</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">Sadne</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Observations</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">863</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Original vars</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">16</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Selected vars</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">15</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24">
                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <h4 class="font-bold tracking-tight text-center text-gray-900 text-1xl sm:text-1xl md:text-1xl">
                            Model overview<br>
                            Target: class
                        </h4>
                        <table class="min-w-full mt-3 divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Value</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Number</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Percentage of data</th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">SADNE</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">85</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">16.4321</td>

                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">NEUTR</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">85</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">16.4321</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">HAPPI</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">85</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">16.4321</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">FEAR</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">86</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">16.8927432</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">DISGU</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">85</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">16.4321</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">ANGER</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">85</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">16.4321</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24">
                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <h4 class="font-bold tracking-tight text-center text-gray-900 text-1xl sm:text-1xl md:text-1xl">
                            Model overview<br>
                            Var Summary
                        </h4>
                        <table class="min-w-full mt-3 divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Role</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Level</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Original number</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Selected input number</th>

                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Input</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">Binary</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">1</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">1</td>


                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Input</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">Interval</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">13</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">13</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Input</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">Nominal</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">1</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">1</td>
                            </tr>
                            <tr>
                                <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">Taget</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">Nominal</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">1</td>
                                <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">0</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <x-alert_info x-show="alert_info">
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-400">
                                    <path fill-rule="evenodd" d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                In this phase, the reports resulting from the experiments will be shown, and suggestions for the implementation of results will be offered. This phase is in the 5% of its development.
                            </div>
                        </div>
                    </div>
                </x-alert_info>


                <div class="py-16">
                    <div class="text-center">
                        <h1 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl"></h1>
                        <p class="mt-2 text-base text-gray-500">Under construction.</p>
                    </div>
                </div>
                <div class="py-5 px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24">
                    <div class="sm:grid sm:grid-cols-12 sm:gap-4">
                        <div class="flex col-start-2 mt-2 ">
                            <a href="{{url('/implementation-algorithm',$id)}}/{{$show}}" class="focus:outline-none">
                                <button type="submit" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2"   x-on:click="buttonActive = 'bayes'" :class="buttonActive=='bayes' ? 'bg-memla-300' : 'bg-memla-100'"><span> &larr; </span>  Previous Phase  </button>
                            </a>
                        </div>
                        <div class="flex col-start-9 mt-6">
                            <a href="{{url('/')}}" class="text-base font-medium text-memla-900 hover:text-memla-500">
                                Go back home
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
    </x-slot>
</x-dashboard-layout>
