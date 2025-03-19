<x-dashboard-layout>
<body>
<!-- Create Post -->
<div>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{url("/dashboard")}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-memla-900 dark:text-gray-400 dark:hover:text-white">
                    <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="{{url("/project_memla")}}" class="ms-1 text-sm font-medium text-gray-700 hover:text-memla-900  md:ms-2 dark:text-gray-400 dark:hover:text-white">Projects</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Create</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="flex flex-col items-center min-h-screen pt-6 bg-white sm:justify-center sm:pt-0">

        <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
            <div class="mb-4">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                    <span class="block text-memla-900" >Create experiment for:</span>
                    <span class="block text-memla-900 mt-4" >{{$mainproject->title}}</span>
                </h1>
            </div>

            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                <form method="POST" action="{{route('project_memla.store')}}">
                    @csrf

                    <input type="hidden" name="project_id" value="{{$id}}">

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700" for="title">
                            Title
                        </label>

                        <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="text" name="title" placeholder="180" />
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <label class="block text-sm font-bold text-gray-700" for="password">
                            Description
                        </label>
                        <textarea name="description"
                                  class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                  rows="4" placeholder="400"></textarea>
                    </div>

                    <div class="flex items-center justify-start mt-4 gap-x-2">
                        <button type="submit"
                                class="inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                            Save
                        </button>

                        <a href="{{ url('/project_memla') }}"
                           class="inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">{{ __('Back') }}
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>
    <x-slot name="scripts">
    </x-slot>
</x-dashboard-layout>

