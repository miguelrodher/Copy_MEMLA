<x-dashboard-layout>
    <!-- Index Post -->

    <div x-data="{ newproject : false }" class="container max-w-7xl mx-auto mt-8">
        <div class="mb-4">
            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                <span class="block text-memla-900" >Main projects</span>
            </h1>
            <div class="flex justify-end mb-4">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <a @click=" newproject = true " class="bg-white border-2 border-dashed border-gray-200 rounded-lg shadow-md p-4 flex items-center justify-center cursor-pointer focus:outline-none">
                <svg style="width: 20%" xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-plus-lg text-gray-200" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2"/>
                </svg>
            </a>

        @foreach($projects as $project)
                <div x-data="{ open{{$project->id}}: false }" class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between">
                    <div>
                        <p class="text-gray-700"><strong>Title:</strong> {{ $project->title }}</p>
                    </div>
                    <div class="mt-2 flex justify-end">
                        <div class="tooltip">
                            <a @click="open{{$project->id}} = true" class="mr-2">
                                <button class="inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                                    {{--<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>--}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                    </svg>
                                </button>
                            </a>
                            <span class="tooltiptext">Show laboratory projects</span>
                        </div>
                        <div class="tooltip">
                            <form id="delete-form-{{ $project->id }}" action="{{ route('selection-study-topic.destroy', $project) }}" method="POST" class="mr-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                            <span class="tooltiptext">Delete main project</span>
                        </div>

                        <!--Provisional project modal-->
                        <div x-show="newproject == true"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-4"
                             class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-20 z-50">
                            <div class="bg-white rounded-lg shadow-lg w-3/5 px-5">

                                <div class="flex justify-between items-center py-4 border-b">
                                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                                        <span class="block text-memla-900" >Create a provisional project</span>
                                    </h1>
                                </div>
                                <form method="POST" action="{{route('provisionalproject')}}">
                                    @csrf
                                    <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10 mb-5">
                                        <!-- Title -->
                                        <div>
                                            <label class="block text-sm font-bold text-gray-700" for="title_project">
                                                Title
                                            </label>

                                            <input class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                   type="text" name="title_project" placeholder="180" />
                                        </div>
                                    </div>
                                    <div class="flex justify-end pb-3">
                                        <button type="submit"
                                                class="m-2 inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                                            Save
                                        </button>
                                        <a @click="newproject = false"
                                           class="cursor-pointer m-2 inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">{{ __('Back') }}
                                        </a>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <!-- Modall -->
                        <div x-data="{ create{{$project->id}}: false }" x-show="open{{$project->id}} == true"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-4"
                             class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
                            <div class="bg-white rounded-lg shadow-lg w-4/5">

                                <div class="flex justify-between items-center p-4 border-b">
                                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                                        <span class="block text-memla-900" >Laboratory projects of {{ $project->title }}</span>
                                    </h1>
                                    <div class="flex justify-end">
                                        <div class="tooltip">
                                            <a @click="create{{$project->id}} = true" class="inline-flex block px-4 py-2 my-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600 ">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </a>
                                            <span class="tooltiptext">Add laboratory project</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add laboratory project modal -->
                                <div x-show="create{{$project->id}} == true"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 translate-y-4"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 translate-y-4"
                                     class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
                                    <div class="bg-white rounded-lg shadow-lg w-3/5 px-5 pt-3">
                                        <div class="flex justify-between items-center p-4 border-b">
                                            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                                                <span class="block text-memla-900" >Create new experiment</span>
                                            </h1>
                                        </div>
                                        <form method="POST" action="{{route('project_memla.store')}}">
                                            @csrf
                                            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10 mb-5">

                                                <input type="hidden" name="project_id" value="{{$project->id}}">

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

                                            </div>

                                            <div class="flex justify-end pb-3">
                                                <button type="submit"
                                                        class="m-2 inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                                                    Save
                                                </button>
                                                <a @click="create{{$project->id}} = false"
                                                       class="cursor-pointer m-2 inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">{{ __('Back') }}
                                                </a>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                                <div class="p-4 max-h-[70vh] overflow-x-auto">
                                    @if($project->projectMemlas->isEmpty())
                                        <p class="text-xl text-gray-600">You have not created laboratory projects.</p>
                                    @else
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                            @foreach($project->projectMemlas as $projectMemla)
                                                <div class="bg-white rounded-lg shadow-md p-4 flex flex-col justify-between">
                                                    <div>
                                                        <p class="text-gray-700">Title: {{ $projectMemla->title }}</p>
                                                        <p class="text-gray-700">Description: {{ $projectMemla->description }}</p>
                                                    </div>
                                                    <div class="mt-2 flex justify-end">

                                                        <div class="tooltip">
                                                            <a href="{{url("/data-collection",$projectMemla->id )}}" class="mr-2">
                                                                <button class="inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                                                                    {{--<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                                    </svg>--}}
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-filetype-csv" viewBox="0 0 16 16">
                                                                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM3.517 14.841a1.13 1.13 0 0 0 .401.823q.195.162.478.252.284.091.665.091.507 0 .859-.158.354-.158.539-.44.187-.284.187-.656 0-.336-.134-.56a1 1 0 0 0-.375-.357 2 2 0 0 0-.566-.21l-.621-.144a1 1 0 0 1-.404-.176.37.37 0 0 1-.144-.299q0-.234.185-.384.188-.152.512-.152.214 0 .37.068a.6.6 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.1 1.1 0 0 0-.2-.566 1.2 1.2 0 0 0-.5-.41 1.8 1.8 0 0 0-.78-.152q-.439 0-.776.15-.337.149-.527.421-.19.273-.19.639 0 .302.122.524.124.223.352.367.228.143.539.213l.618.144q.31.073.463.193a.39.39 0 0 1 .152.326.5.5 0 0 1-.085.29.56.56 0 0 1-.255.193q-.167.07-.413.07-.175 0-.32-.04a.8.8 0 0 1-.248-.115.58.58 0 0 1-.255-.384zM.806 13.693q0-.373.102-.633a.87.87 0 0 1 .302-.399.8.8 0 0 1 .475-.137q.225 0 .398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.4 1.4 0 0 0-.489-.272 1.8 1.8 0 0 0-.606-.097q-.534 0-.911.223-.375.222-.572.632-.195.41-.196.979v.498q0 .568.193.976.197.407.572.626.375.217.914.217.439 0 .785-.164t.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.8.8 0 0 1-.118.363.7.7 0 0 1-.272.25.9.9 0 0 1-.401.087.85.85 0 0 1-.478-.132.83.83 0 0 1-.299-.392 1.7 1.7 0 0 1-.102-.627zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879z"/>
                                                                    </svg>
                                                                </button>
                                                            </a>
                                                            <span class="tooltiptext">Show dataset</span>
                                                        </div>

                                                        <div class="tooltip">
                                                            <a href="{{ route('project_memla.edit', $projectMemla) }}" class="mr-2">
                                                                <button class="inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                    </svg>
                                                                </button>
                                                            </a>
                                                            <span class="tooltiptext">Edit laboratory project</span>
                                                        </div>

                                                        <div class="tooltip">
                                                            <form id="delete-form-{{ $projectMemla->id }}" action="{{ route('project_memla.destroy', $projectMemla) }}" method="POST" class="mr-2">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                            <span class="tooltiptext">Delete laboratory project</span>
                                                        </div>

                                                        @if(!$projectMemla->dataset->isEmpty())
                                                            <div class="tooltip">
                                                                <form id="restart-form-{{ $projectMemla->id }}" action="{{ route('project_memla.restar_test_project', $projectMemla->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="inline-flex px-4 py-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                                                            <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                                <span class="tooltiptext">Restart laboratory project</span>
                                                            </div>
                                                        @endif

                                                        {{--<div class="tooltip text-lg text-blue-500">
                                                            Hover over me
                                                            <span class="tooltiptext">Tooltip text</span>
                                                        </div>--}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    @endif
                                </div>
                                <div class="flex justify-end p-4 border-t">
                                    <button @click="open{{$project->id}} = false" class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Close</button>
                                </div>
                            </div>
                        </div>


                        {{-- Tooltip :))))
                            <div class="tooltip text-lg text-orange-500">
                                Hover over me
                                <span class="tooltiptext">Tooltip text</span>
                            </div>
                        --}}
                    </div>
                </div>
            @endforeach
        </div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div x-data="{ titleerror : true }" x-show="titleerror == true"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-4"
                     class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-20 z-50">

                    <div class="py-4 px-5 bg-white rounded-lg shadow-lg w-1/5">
                        <div class="flex items-center mb-2">
                            <svg style=" width: 10% ; fill: #771111" xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                                <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                            </svg>
                            <h6 class="ps-3 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                                <span class="block text-red-900">Error</span>
                            </h6>
                        </div>
                        <div class="flex bg-red-100 rounded-lg p-4 text-sm text-red-700" role="alert">
                            <div>
                                <span class="font-medium">There was an error!</span> {{$error}}.
                            </div>
                        </div>
                        <div class="flex justify-end pt-3">
                            <button @click=" titleerror = false " class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-700">Close</button>
                        </div>
                        <!--<div class="flex justify-between items-center p-4 border-b">
                            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                                <span class="block text-memla-900" >Create a provisional project</span>
                            </h1>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">There were errors
                                with your submission {{$error}}</h3>
                        </div>-->
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <x-slot name="scripts">
    </x-slot>
</x-dashboard-layout>
