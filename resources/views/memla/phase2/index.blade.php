<x-dashboard-layout>
    <!-- component -->


    <div class="bg-gray-50"  x-data="handler()" x-init="if(nameFile && nameFile.trim() !== '') { loadFile() }">
        <div class="relative py-6 mt-6 overflow-hidden">
            <div class="px-4 mx-auto mt-6 max-w-7xl sm:mt-4 sm:px-6">
                <div class="text-center">
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                        <span class="block text-memla-900">Data collection and preprocessing</span>
                        <span class="block text-memla-800">Phase 2</span>
                    </h3>

                    <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
                        {{$laboratory_project->title}}
                    </p>
                </div>
            </div>

            @if ($errors->any())
                <x-alert_error >
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </x-alert_error>
            @endif

            <div class="mt-5">

                @if(!$dataset)
                <form class="space-y-6" action="{{route("data-collection.store")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$id}}" name="id_project">
                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">File</h3>
                                <p class="mt-1 text-sm text-gray-500">Load your file of data</p>
                            </div>
                            <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">
                                <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                                    <div class="mt-1 sm:col-span-2 sm:mt-0">
                                        <div class="flex justify-center max-w-lg px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                            <div class="space-y-1 text-center" x-show="path_file==''">
                                                <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <label for="file-upload" class="relative font-medium bg-white rounded-md cursor-pointer text-memla-900 focus-within:outline-none focus-within:ring-2 focus-within:ring-memla-500 focus-within:ring-offset-2 hover:text-memla-500">
                                                        <span>Upload a file</span>
                                                        <input id="file-upload" name="file_upload" x-model="path_file" type="file" class="sr-only">
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs text-gray-500">CSV, XLS, XLSX up to 10MB</p>
                                            </div>
                                            <div class="space-y-1 text-center" x-show="path_file!=''">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 mx-auto text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zM9.75 17.25a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-.75zm2.25-3a.75.75 0 01.75.75v3a.75.75 0 01-1.5 0v-3a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0V18a.75.75 0 001.5 0v-5.25z" clip-rule="evenodd" />
                                                    <path d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <p class="pl-1">File: <span x-text="path_file"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex block px-4 py-2 my-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600" {{--@click="loadFile()"--}}>UpLoad</button>
                    </div>
                </form>
                @else
                    <template x-if="(dataset.rows == 0 && dataset.cols == 0)">
                        <x-alert_memla >
                            <x-slot name="title_alert">
                                Attention!
                            </x-slot>
                            <strong class="font-semibold">The project already has a dataset</strong>
                            <div class="flex justify-end">
                                <button type="button" class="inline-flex block px-4 py-2 my-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"  >Load</button>
                            </div>
                        </x-alert_memla>
                    </template>

                    <template  x-if="(dataset.rows != 0 && dataset.cols != 0) && (dataset.cols < 3 || dataset.rows < 30)" x-cloack>
                        <x-alert_error >
                            The dataset must have a minimum of 30 rows and 3 columns.
                        </x-alert_error>
                    </template>
                @endif
                <template x-if="dataset.cols >= 3 && dataset.rows >= 30" x-cloack>
                    <div>
                        <div class="flex justify-center items-center mt-10" x-data="{show: false, tab_selected:1{{--, isLoading: false--}}}" x-show="!alertLoad">

                            {{--<div x-show="isLoading">Loading...</div>
                            <div x-show="!isLoading">User loaded...</div>--}}

                            <a href="#!" @click="show=true" class="px-6 py-2 text-white bg-blue-600 rounded shadow-xl" >Data exploration</a>
                            {{--modificar tamaño de modal ---}}
                            <x-modal name="modal" :title="'Data collection and preprocessing'" :maxWidth="'8xl'">

                                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-3 ">
                                    <ul class="flex flex-wrap -mb-px">
                                        <li class="mr-2">
                                            <button href="#" @click="tab_selected=1"
                                               class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-memla-600 hover:border-memla-300 text-gray-600" :class="{'text-memla-600 border-b-2 border-memla-600 rounded-t-lg active':tab_selected==1}">
                                                Dataset information
                                            </button>
                                        </li>
                                        <li class="mr-2">
                                            <button :disabled="selected_target == ''" :class="(selected_target !== '')?'hover:text-memla-600 hover:border-memla-300 text-gray-600':''" href="#" @click="tab_selected=2"
                                               class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-300" :class="{'text-memla-600 ':tab_selected==2}">
                                                Domain standardization
                                            </button>
                                        </li>
                                        <li class="mr-2">
                                            <button :disabled="selected_target == ''" :class="(selected_target !== '')?'hover:text-memla-600 hover:border-memla-300 text-gray-600':''" href="#" @click="tab_selected=3"
                                               class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-300"  :class="{'text-memla-600 border-b-2 border-memla-600 rounded-t-lg active':tab_selected==3}">
                                                Duplicate data
                                            </button>
                                        </li>
                                        <li class="mr-2">
                                            <button :disabled="selected_target == ''" :class="(selected_target !== '')?'hover:text-memla-600 hover:border-memla-300 text-gray-600':''" href="#" @click="tab_selected=4"
                                               class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-300"  :class="{'text-memla-600 border-b-2 border-memla-600 rounded-t-lg active':tab_selected==4}">
                                                Non-informative columns
                                            </button>
                                        </li>
                                        <li class="mr-2">
                                            <button :disabled="selected_target == ''" :class="(selected_target !== '')?'hover:text-memla-600 hover:border-memla-300 text-gray-600':''" href="#" @click="tab_selected=5"
                                               class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-300"  :class="{'text-memla-600 border-b-2 border-memla-600 rounded-t-lg active':tab_selected==5}">
                                                Encoding strings to numeric values
                                            </button>
                                        </li>
                                        <li class="mr-2">
                                            <button :disabled="selected_target == ''" :class="(selected_target !== '')?'hover:text-memla-600 hover:border-memla-300 text-gray-600':''" href="#" @click="tab_selected=6 ; loadOutliers()"
                                               class="inline-block p-4 border-b-2 border-transparent rounded-t-lg text-gray-300"  :class="{'text-memla-600 border-b-2 border-memla-600 rounded-t-lg active':tab_selected==6}">
                                                Handling outliers
                                            </button>
                                        </li>
                                    </ul>
                                </div>


                                <div class="grid grid-cols-12 grid-flow-row" x-show="tab_selected==1">
                                    <div class="col-span-5 snap-start items-center px-8 py-5 bg-white rounded-3xl shadow-main">
                                        <ul class="mb-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li class="mb-2">
                                                <div class="relative p-3 py-4" >
                                                    <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                    <p class="text-2xl font-extrabold text-dark-grey-900">Feature selection</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="border rounded-lg overflow-x-auto dark:border-neutral-700">
                                            <table :style="(selected_target != '')?'pointer-events: none; opacity: 0.5;':''" class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                                <thead class="bg-gray-100 dark:bg-gray-700"> <!--Encabezados de la tabla de data information-->
                                                    <tr>
                                                        <template x-for="head in dataset.info.columns">
                                                            <th x-text="head" scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400"></th>
                                                        </template>
                                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Feature</th>
                                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Target</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                <template x-for="(rowData,index) in dataset.info.data">
                                                    <tr class="" :class="(selected_target == '')?'hover:bg-gray-100 dark:hover:bg-gray-700':''">
                                                        <!--Contenido de la tabla de data information-->
                                                        <template x-for="columnData in rowData">
                                                            <td class="py-4 px-6 text-sm font-medium whitespace-nowrap dark:text-white" x-text="columnData"></td>
                                                        </template>
                                                        <td class="">
                                                            <div class="gap-4">
                                                                <div class="flex justify-center">
                                                                    <input type="checkbox" :id="'class'+index" :name="'column'+index" :value="index" x-model="classElements" :disabled="targetElement==index" class="w-4 h-4 text-memla-800 bg-gray-100 rounded border-gray-300 focus:ring-memla-700 dark:focus:ring-memla-800 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div class="gap-4">
                                                                <div class="flex justify-center">
                                                                    <input type="radio" :id="'target'+index" name="target" :value="rowData[1]" x-model="targetElement" @click="classElements=classElements.filter(function(column) {return parseInt(column) != index; });" class="w-4 h-4 text-memla-800 bg-gray-100 border-gray-300 focus:ring-memla-700 dark:focus:ring-memla-800 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-span-7 snap-start items-center px-8 py-5 bg-white rounded-3xl shadow-main">
                                        <ul class="mb-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            <li class="mb-2">
                                                <div class="relative p-3 py-4" >
                                                    <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                    <p class="text-2xl font-extrabold text-dark-grey-900">Dataset description</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="border rounded-lg overflow-x-auto dark:border-neutral-700">
                                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                                <thead class="bg-gray-100 dark:bg-gray-700">
                                                    <tr>
                                                        <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Index</th>
                                                        <template x-for="head in dataset.data_description.columns">
                                                            <th x-text="head" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400"></th>
                                                        </template>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                <template x-for="(rowData, index) in dataset.data_description.data">
                                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        <td x-text="dataset.data_description.index[index]" class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                                                        <template x-for="columnData in rowData">
                                                            <td x-text="columnData??'NA'" class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                                                        </template>
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="flex justify-center mt-2 col-start-4 col-span-6 snap-start px-8 bg-white rounded-3xl shadow-main">
                                        <button x-show="selected_target == ''" x-on:click="stm = true" class="ms-3 mb-5 px-4 py-2 text-white bg-memla-800 hover:bg-memla-900 cursor-pointer rounded-md">Save target and features</button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-5 md:grid-cols-3 lg:grid-cols-3" x-show="tab_selected==2">
                                    <ul class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li class="mb-2">
                                            <div class="relative p-3" >
                                                <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                <h5 class="text-xl font-bold text-slate-90 p-2 pl-3 ">
                                                    Columns
                                                </h5>
                                            </div>
                                        </li>
                                        <template x-for="(titleHeader,indexColumn) in dataset.dataAll.columns">
                                            <div class="grid grid-cols-1 ">
                                                <button class="flex justify-start hover:bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600 cursor-pointer px-4 py-2 border-b border-gray-200
                                                 dark:border-gray-600 focus:bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"
                                                        x-text="titleHeader+' (' + dataset.unique_values[titleHeader].length + ')'" @click="changeListValues(titleHeader,indexColumn)"></button>
                                            </div>
                                        </template>
                                    </ul>

                                    <ul style="max-height: calc(60px * 8); overflow-y: auto;" class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                                        <li class="mb-2 ">
                                            <div class="relative p-3">
                                                <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                <h5 x-text="'Values of '+columnTitle+' column'" :x-text="(columnTitle)?'Values':''" class="text-xl font-bold text-slate-90 p-2 pl-3 "></h5>
                                            </div>
                                        </li>

                                        <div >
                                            <template x-for="(values,indexColumn) in dataset.list_unique_values" >


                                                <li class="px-4 py-2 border-b border-gray-200 dark:border-gray-600 grid grid-cols-2  hover:bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600 cursor-pointer" x-data="{inputActive:false,tooltip:false}" >
                                                    <div>
                                                        <span  class="p-5" x-text="values" x-show="!inputActive" x-on:click="inputActive=!inputActive;changeValue=values"></span>

                                                        <input x-show="inputActive" type="text" x-model="values" x-on:click.outside="inputActive=false " class="my-3">
                                                        <button x-show="inputActive" x-on:click="inputActive=!inputActive;saveChangeValue(values)" class=" px-3 py-1 text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 cursor-pointer rounded">Change</button>
                                                        <button x-show="inputActive" x-on:click="inputActive=!inputActive" class="px-3 py-1 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 cursor-pointer rounded">Cancel</button>

                                                    </div>
                                                    <div>
                                                        <svg x-on:click="tooltip = !tooltip; changeValue=values" class="h-3 w-3 cursor-pointer text-gray-600 fill-current" fill="#000000" height="15px" width="15px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 491.3 491.3" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M167.3,426.8H64.4V321.5c0-6.9-5.6-12.4-12.4-12.4H12.5c-6.9,0-12.4,5.6-12.4,12.4V459c0,17.7,14.4,32.2,32.2,32.2h135 c6.9,0,12.4-5.6,12.4-12.4v-39.4C179.7,432.3,174.2,426.8,167.3,426.8z"></path> <path d="M361,265.4v-39.6c0-6.9-5.6-12.4-12.4-12.4h-70.7v-70.8c0-6.9-5.6-12.4-12.4-12.4h-39.6c-6.9,0-12.4,5.6-12.4,12.4v70.7 h-70.9c-6.9,0-12.4,5.6-12.4,12.4v39.6c0,6.9,5.6,12.4,12.4,12.4h70.7v70.9c0,6.9,5.6,12.4,12.4,12.4h39.6 c6.9,0,12.4-5.6,12.4-12.4v-70.7h70.9C355.5,277.9,361,272.3,361,265.4z"></path> <path d="M12.5,172.8h39.4c6.9,0,12.4-5.6,12.4-12.4v-96h102.9c6.9,0,12.4-5.6,12.4-12.4V12.5c0-6.9-5.6-12.4-12.4-12.4h-135 C14.5,0.1,0,14.5,0,32.3v128.1C0.1,167.3,5.7,172.8,12.5,172.8z"></path> <path d="M478.7,309h-39.4c-6.9,0-12.4,5.6-12.4,12.4v105.3h-98.4c-6.9,0-12.4,5.6-12.4,12.4v39.4c0,6.9,5.6,12.4,12.4,12.4h130.6 c17.7,0,32.2-14.4,32.2-32.2V321.5C491.1,314.6,485.5,309,478.7,309z"></path> <path d="M458.9,0.1H328.4c-6.9,0-12.4,5.6-12.4,12.4v39.4c0,6.9,5.6,12.4,12.4,12.4h98.4v96c0,6.9,5.6,12.4,12.4,12.4h39.4 c6.9,0,12.4-5.6,12.4-12.4v-128C491.1,14.5,476.7,0.1,458.9,0.1z"></path> </g> </g> </g></svg>

                                                        <div x-show="tooltip && dataset.list_domain_values[columnTitle].length>0" class="absolute bg-white border-graphite border-2 rounded p-4 mt-1 pt-5 mt-6"  @click.outside="tooltip = false" >

                                                            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 overflow-auto max-h-80">
                                                                <template x-for="value in dataset.list_domain_values[columnTitle]">
                                                                    <li class="pb-3 sm:pb-4 pr-5 pl-3 hover:bg-gray-50">
                                                                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                                                            <div class="flex-1 min-w-0 " x-data="{valueNewDomain:'',showButtons:false}">
                                                                                <p class="block px-4 py-2 w-full hover:text-memla-900 focus:outline-none focus:ring-2 focus:ring-memla-900 focus:text-memla-900 cursor-pointer" x-text="value" x-on:click="valueNewDomain=value; showButtons=!showButtons" x-on:click.outside="showButtons=false"></p>
                                                                                <button x-show="showButtons" x-on:click="showButtons=false; saveChangeValue(value)" class="px-3 py-1 text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 cursor-pointer rounded">Change</button>
                                                                                <button x-show="showButtons" x-on:click="showButtons=false" class="px-3 py-1 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 cursor-pointer rounded">Cancel</button>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </template>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                            </template>
                                        </div>
                                    </ul>
                                    <ul class="text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <li class="mb-2">
                                            <div class="relative p-3">
                                                <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                <h5 class="text-xl font-bold text-slate-90 p-2 pl-3 ">
                                                    Domains
                                                </h5>
                                            </div>
                                        </li>

                                        <li class="px-4 py-2 border-b border-gray-200 dark:border-gray-600 pb-4" x-show="dataset.list_domain_values[columnTitle]"
                                            x-data="{showInput:false,valueDomain:''}" >
                                            <span x-show="!showInput" x-on:click="showInput=!showInput"><a class="px-6 py-2 text-white bg-gradient-to-r from-memla-600 via-memla-800 to-memla-900 rounded cursor-pointer" >Add</a></span>
                                            <input x-show="showInput" type="text" x-model="valueDomain">
                                            <button x-show="showInput"
                                                    x-on:click="showInput=!showInput;
                                                    dataset.list_domain_values[columnTitle][dataset.list_domain_values[columnTitle].length]=valueDomain;
                                                    valueDomain=''" class="px-3 py-1 text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 cursor-pointer rounded">Save</button>
                                            <button x-show="showInput" x-on:click="showInput=!showInput" class="px-3 py-1 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 cursor-pointer rounded">Cancel</button>
                                        </li>

                                        <template x-for="(values,indexColumn) in dataset.list_domain_values[columnTitle]" >
                                            <li class="px-4 py-2 border-b border-gray-200 dark:border-gray-600">
                                                <span  class="p-5" x-text="values"></span>
                                            </li>
                                        </template>
                                    </ul>

                                </div>

                                <div class="grid grid-rows-1 grid-cols-1 m-0" x-show="tab_selected==3">
                                    <div class="row">
                                        <div class="grid grid-cols-4 grid-flow-col mx-5">
                                            <ul class="col-start-1 col-end-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                <li class="mb-2">
                                                    <div class="relative p-3" >
                                                        <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                        <h5 class="text-xl font-bold text-slate-90 p-2 pl-3 ">
                                                            Duplicate data summary
                                                        </h5>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="col-start-4 ps-5 py-5 felx items-end ms-5 me-0 ">
                                                <button x-on:click="deleteDuplicateValues()" class="px-6 py-2 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 rounded cursor-pointer">Delete all duplicate data</button>
                                            </div>
                                        </div>

                                        <div x-show="(dataset.duplicate_data.values_keys.length == 0)" class="me-5 ms-5 mt-5 flex bg-gradient-to-r from-memla-100 via-memla-200 to-memla-300 rounded-lg p-4 mb-4 text-sm text-yellow-700" role="alert">
                                            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                            <div>
                                                <span class="font-medium">Warning alert!</span> There are not duplicated data.
                                            </div>
                                        </div>
                                        <div class="m-5 border rounded-lg overflow-x-auto dark:border-neutral-700 max-h-screen" x-show="(dataset.duplicate_data.values_keys.length > 0)">
                                            <div class="flex-grow overflow-auto">
                                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 ">
                                                    <thead class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                    <tr>
                                                        <th class="sticky top-0 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider z-10">Quantity</th>
                                                        <template x-for="(titleHeader,indexColumn) in dataset.dataAll.columns">
                                                            <th x-show="(classElements.length==0||classElements.includes(''+indexColumn))||targetElement==indexColumn"  scope="col" class="sticky top-0 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider z-10">
                                                                <div class="flex space-x-2">
                                                                    <span x-text="titleHeader"></span>
                                                                </div>
                                                            </th>
                                                        </template>
                                                    </tr>
                                                    </thead>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                    <template x-for="value_key in dataset.duplicate_data.values_keys">
                                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                            <td x-text="dataset.duplicate_data.data['size'][value_key]" class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white"></td>
                                                            <template x-for="(titleHeader,indexColumn) in dataset.dataAll.columns">
                                                                <td x-text="dataset.duplicate_data.data[titleHeader][value_key]" class="px-5 py-5 border-b border-gray-200 text-sm"></td>
                                                            </template>
                                                        </tr>
                                                    </template>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-rows-1 grid-cols-10 m-0" x-show="tab_selected==4">
                                    <div class="row col-start-2 col-span-8">
                                        <div class="mx-5 mt-2 grid grid-cols-1 grid-flow-col">
                                            <ul class="col-start-1 col-end-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                <li class="mb-2">
                                                    <div class="relative p-3" >
                                                        <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                        <h5 class="text-xl font-bold text-slate-90 p-2 pl-3 ">
                                                            Removal of non-informative columns
                                                        </h5>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="m-5 border rounded-lg overflow-x-auto dark:border-neutral-700 max-h-screen">
                                            <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 ">
                                                <thead class="bg-gray-100 dark:bg-gray-700"> <!--Encabezados de la tabla de data information-->
                                                <tr>
                                                    <template x-for="head in dataset.info.columns">
                                                        <th x-text="head" scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400"></th>
                                                    </template>
                                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Drop column</th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                <template x-for="(rowData,index) in dataset.info.data">
                                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        <!--Contenido de la tabla de data information-->
                                                        <template x-for="columnData in rowData">
                                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white" x-text="columnData"></td>
                                                        </template>
                                                        <td class="p-3">
                                                            <button x-on:click="deleteColumns(rowData[1])" class="px-6 py-2 text-white bg-red-600 rounded cursor-pointer">
                                                                <div class="grid grid-cols-6 gap-4">
                                                                    <div class="col-span-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>
                                                                    </div>
                                                                    <div class="col-span-5">Delete this column</div>
                                                                </div>
                                                            </button>
                                                            <!--<button>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>
                                                            </button>-->
                                                        </td>
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <div class="grid grid-rows-1 grid-cols-1 m-0" x-show="tab_selected==5">
                                    <div class="row">
                                        <div class="mx-5 mt-2 grid grid-cols-1 grid-flow-col">
                                            <ul class="col-start-1 col-end-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                <li class="mb-2">
                                                    <div class="relative p-3" >
                                                        <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                        <h5 class="text-xl font-bold text-slate-90 p-2 pl-3 ">
                                                            Select the encoding type that will be applied to each of the columns.
                                                        </h5>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="m-5 border rounded-lg overflow-x-auto dark:border-neutral-700 max-h-screen">
                                            <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                                                <thead class="bg-gray-100 dark:bg-gray-700"> <!--Encabezados de la tabla de data information-->
                                                <tr>
                                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Column name</th>
                                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Unique values</th>
                                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Encode type</th>
                                                    <!--<th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Preview</th>-->
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                <template x-for="(count, index) in dataset.encode_data">
                                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        <!--Contenido de la tabla de data information-->
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white" x-text="index"></td>
                                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white" x-text="count"></td>

                                                        <!--<template x-for="column in index">
                                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white" x-text="column"></td>
                                                        </template>-->
                                                        <td class="grid grid-cols-2 p-3">
                                                            <button x-on:click="encodeColumns_n(index)" class="px-6 py-2 text-white bg-green-600 rounded cursor-pointer mx-3">
                                                                <div class="grid grid-cols-6 gap-4">
                                                                    <div class="col-span-5">Nominal coding</div>
                                                                </div>
                                                            </button>
                                                            <button x-on:click="encodeColumns_o(index, dataset.unique_values[index])" class="px-6 py-2 text-white bg-green-600 rounded cursor-pointer mx-5">
                                                                <div class="grid grid-cols-6 gap-4">
                                                                    <div class="col-span-5">Ordinal coding</div>
                                                                </div>
                                                            </button>
                                                            <!--<button>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                </svg>
                                                            </button>-->
                                                        </td>
                                                        <!--<td>
                                                            Pendiente
                                                        </td>-->
                                                    </tr>
                                                </template>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-5 md:grid-cols-5 lg:grid-cols-5" x-show="tab_selected==6">
                                    <ul class="col-start-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white mt-2">
                                        <li class="mb-2">
                                            <div class="relative p-3" >
                                                <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                <h5 class="text-xl font-bold text-slate-90 p-2 pl-3 ">
                                                    Column
                                                </h5>
                                            </div>
                                        </li>

                                        <template x-for="(titleHeader,indexColumn) in dataset.dataAll.columns">
                                            <div class="grid grid-cols-1 ">
                                                <button class="flex justify-start hover:bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600 cursor-pointer px-4 py-2 border-b border-gray-200
                                                 dark:border-gray-600 focus:bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"
                                                        x-text="titleHeader" @click="printOutliers(titleHeader,indexColumn)"></button>
                                            </div>
                                        </template>
                                    </ul>

                                    <ul class="col-span-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white mt-2">
                                        <li class="mb-2">
                                            <div class="relative p-3" >
                                                <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                                <h5 class="text-xl font-bold text-slate-90 p-2 pl-3 ">
                                                    Outliers
                                                </h5>
                                            </div>
                                        </li>

                                        <div x-show="number_o == 0 && columnTitle != ''" class="mt-5 flex bg-gradient-to-r from-memla-100 via-memla-200 to-memla-300 rounded-lg p-4 mb-4 text-sm text-yellow-800 mx-3" role="alert">
                                            <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                            <div>
                                                <span class="font-medium"></span> There are not outliers for this column.
                                            </div>
                                        </div>



                                        <template x-for="(values,indexColumn) in dataset.list_outliers">
                                            <li class="px-4 py-2 border-b border-gray-200 dark:border-gray-600 grid grid-cols-2  hover:bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600 cursor-pointer" x-data="{inputActive:false,tooltip:false}" >
                                                <div>
                                                    <span class="p-5" x-show="datatype_column != 'object'" x-text="values"></span>
                                                    <span class="p-5" x-show="datatype_column == 'object'" x-text="indexColumn"></span>
                                                </div>
                                                <div>
                                                    <svg x-on:click="tooltip = !tooltip" class="h-3 w-3 cursor-pointer text-gray-600 fill-current" fill="#000000" height="15px" width="15px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 491.3 491.3" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M167.3,426.8H64.4V321.5c0-6.9-5.6-12.4-12.4-12.4H12.5c-6.9,0-12.4,5.6-12.4,12.4V459c0,17.7,14.4,32.2,32.2,32.2h135 c6.9,0,12.4-5.6,12.4-12.4v-39.4C179.7,432.3,174.2,426.8,167.3,426.8z"></path> <path d="M361,265.4v-39.6c0-6.9-5.6-12.4-12.4-12.4h-70.7v-70.8c0-6.9-5.6-12.4-12.4-12.4h-39.6c-6.9,0-12.4,5.6-12.4,12.4v70.7 h-70.9c-6.9,0-12.4,5.6-12.4,12.4v39.6c0,6.9,5.6,12.4,12.4,12.4h70.7v70.9c0,6.9,5.6,12.4,12.4,12.4h39.6 c6.9,0,12.4-5.6,12.4-12.4v-70.7h70.9C355.5,277.9,361,272.3,361,265.4z"></path> <path d="M12.5,172.8h39.4c6.9,0,12.4-5.6,12.4-12.4v-96h102.9c6.9,0,12.4-5.6,12.4-12.4V12.5c0-6.9-5.6-12.4-12.4-12.4h-135 C14.5,0.1,0,14.5,0,32.3v128.1C0.1,167.3,5.7,172.8,12.5,172.8z"></path> <path d="M478.7,309h-39.4c-6.9,0-12.4,5.6-12.4,12.4v105.3h-98.4c-6.9,0-12.4,5.6-12.4,12.4v39.4c0,6.9,5.6,12.4,12.4,12.4h130.6 c17.7,0,32.2-14.4,32.2-32.2V321.5C491.1,314.6,485.5,309,478.7,309z"></path> <path d="M458.9,0.1H328.4c-6.9,0-12.4,5.6-12.4,12.4v39.4c0,6.9,5.6,12.4,12.4,12.4h98.4v96c0,6.9,5.6,12.4,12.4,12.4h39.4 c6.9,0,12.4-5.6,12.4-12.4v-128C491.1,14.5,476.7,0.1,458.9,0.1z"></path> </g> </g> </g></svg>

                                                    <div x-model="selectHandle" x-show="tooltip" class="absolute bg-white border-graphite border-2 rounded p-4 mt-1 pt-5 mt-6"  @click.outside="tooltip = false ; selectHandle=''"
                                                         @blur="selectHandle = ''">
                                                        <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 overflow-auto max-h-80 mb-3">
                                                            <select class="col-start-6 col-span-3 ps-2 pe-8 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2">
                                                                <option value="" selected>Select a way to handle the outlier</option>
                                                                <option x-text="'Mode ('+dataset.centrals.mode[columnTitle][0]+')'" @click="selectHandle = dataset.centrals.mode[columnTitle][0]" ></option>
                                                                <option x-text="'Mean ('+dataset.centrals.mean[columnTitle]+')'" x-show="datatype_column != 'object'" @click="selectHandle = dataset.centrals.mean[columnTitle]"></option>
                                                                <option x-text="'Median ('+dataset.centrals.median[columnTitle]+')'" x-show="datatype_column != 'object'" @click="selectHandle = dataset.centrals.median[columnTitle]"></option>
                                                                <option value="empty">Empty String</option>
                                                            </select>
                                                        </ul>
                                                        <div x-show="selectHandle != ''">
                                                            <button class="px-3 py-1 text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 cursor-pointer rounded" @click="handleOutliers(values, indexColumn, datatype_column, selectHandle) ; tooltip = false">Saveme</button>
                                                            <button @click="tooltip = false" class="px-3 py-1 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 cursor-pointer rounded">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>
                                    </ul>


                                </div>

                                {{--<div class="grid grid-cols-1 gap-5 md:grid-cols-3 lg:grid-cols-3" x-show="tab_selected==7">

                                    <div class="drag-and-drop" x-data="{ adding: false, removing: false }">
                                        <div class="drag-and-drop__container drag-and-drop__container--from">
                                            <h3 class="drag-and-drop__title">From</h3>
                                            <ul
                                                class="drag-and-drop__items bg-gray-200"
                                                :class="{ 'drag-and-drop__items--removing': removing }"
                                                x-on:drop="removing = false"
                                                x-on:drop.prevent="
                const target = event.target.closest('ul');
                const element = document.getElementById(event.dataTransfer.getData('text/plain'));
                target.appendChild(element);
            "
                                                x-on:dragover.prevent="removing = true"
                                                x-on:dragleave.prevent="removing = false">
                                                <!-- loop through the items -->
                                                <li
                                                    id="item-1"
                                                    class="drag-and-drop__item"
                                                    :class="{ 'drag-and-drop__item--dragging': dragging }"
                                                    x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                                                    x-on:dragend="dragging = false"
                                                    x-data="{ dragging: false }"
                                                    draggable="true">
                                                    Your Item #1
                                                </li>
                                                <li
                                                    id="item-2"
                                                    class="drag-and-drop__item"
                                                    :class="{ 'drag-and-drop__item--dragging': dragging }"
                                                    x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                                                    x-on:dragend="dragging = false"
                                                    x-data="{ dragging: false }"
                                                    draggable="true">
                                                    Your Item #2
                                                </li>
                                                <li
                                                    id="item-3"
                                                    class="drag-and-drop__item"
                                                    :class="{ 'drag-and-drop__item--dragging': dragging }"
                                                    x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                                                    x-on:dragend="dragging = false"
                                                    x-data="{ dragging: false }"
                                                    draggable="true">
                                                    Your Item #3
                                                </li>
                                                <li
                                                    id="item-4"
                                                    class="drag-and-drop__item"
                                                    :class="{ 'drag-and-drop__item--dragging': dragging }"
                                                    x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                                                    x-on:dragend="dragging = false"
                                                    x-data="{ dragging: false }"
                                                    draggable="true">
                                                    Your Item #4
                                                </li>
                                                <li
                                                    id="item-5"
                                                    class="drag-and-drop__item"
                                                    :class="{ 'drag-and-drop__item--dragging': dragging }"
                                                    x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                                                    x-on:dragend="dragging = false"
                                                    x-data="{ dragging: false }"
                                                    draggable="true">
                                                    Your Item #5
                                                </li>
                                                <li
                                                    id="item-6"
                                                    class="drag-and-drop__item"
                                                    :class="{ 'drag-and-drop__item--dragging': dragging }"
                                                    x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                                                    x-on:dragend="dragging = false"
                                                    x-data="{ dragging: false }"
                                                    draggable="true">
                                                    Your Item #6
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="drag-and-drop__divider">⇄</div>
                                        <div class="drag-and-drop__container drag-and-drop__container--to">
                                            <h3 class="drag-and-drop__title">To</h3>
                                            <ul
                                                class="drag-and-drop__items bg-gray-200 p-5 "
                                                :class="{ 'drag-and-drop__items--adding': adding }"
                                                x-on:drop="adding = false"
                                                x-on:drop.prevent="
                const target = event.target.closest('ul');
                const element = document.getElementById(event.dataTransfer.getData('text/plain'));
                target.appendChild(element);
            "
                                                x-on:dragover.prevent="adding = true"
                                                x-on:dragleave.prevent="adding = false">
                                                <!-- loop through the already selected items -->

                                                <li
                                                    id="item-7"
                                                    class="drag-and-drop__item"
                                                    :class="{ 'drag-and-drop__item--dragging': dragging }"
                                                    x-on:dragstart.self="
                    dragging = true;
                    event.dataTransfer.effectAllowed='move';
                    event.dataTransfer.setData('text/plain', event.target.id);
                "
                                                    x-on:dragend="dragging = false"
                                                    x-data="{ dragging: false }"
                                                    draggable="true">
                                                    Your Item #7
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>--}}

                            </x-modal>
                        </div>

                        {{--table dataset--}}
                        <h1 x-show="isLoading">Loading...</h1>

                        <div class="flex flex-col mt-5" style="max-height: calc(60px * 7);" x-show="!alertLoad">
                            <div class="flex-grow overflow-auto">
                                <table class="relative w-full border">
                                    <thead>
                                    <tr>
                                        <th class="sticky top-0 px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">index</th>
                                        <template x-for="(titleHeader,indexColumn) in dataset.dataAll.columns">
                                            <th x-show="(classElements.length==0||classElements.includes(''+indexColumn))||targetElement==indexColumn"  scope="col" class="sticky top-0 px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider z-10">
                                                <div class="flex space-x-2">
                                                    <span x-text="titleHeader"></span>
                                                    <div class="flex flex-col" x-data="{ tooltip: false }" >
                                                        {{--
                                                        <svg @click="''" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="''"><path d="M5 15l7-7 7 7"></path></svg>
                                                        <svg @click="''" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" viewBox="0 0 24 24" stroke="currentColor" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" x-bind:class="''"><path d="M19 9l-7 7-7-7"></path></svg>
                                                        --}}

                                                        <svg  x-on:click="tooltip = !tooltip" class="h-3 w-3 cursor-pointer text-gray-500 fill-current" fill="#000000" height="15px" width="15px"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 491.3 491.3" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M167.3,426.8H64.4V321.5c0-6.9-5.6-12.4-12.4-12.4H12.5c-6.9,0-12.4,5.6-12.4,12.4V459c0,17.7,14.4,32.2,32.2,32.2h135 c6.9,0,12.4-5.6,12.4-12.4v-39.4C179.7,432.3,174.2,426.8,167.3,426.8z"></path> <path d="M361,265.4v-39.6c0-6.9-5.6-12.4-12.4-12.4h-70.7v-70.8c0-6.9-5.6-12.4-12.4-12.4h-39.6c-6.9,0-12.4,5.6-12.4,12.4v70.7 h-70.9c-6.9,0-12.4,5.6-12.4,12.4v39.6c0,6.9,5.6,12.4,12.4,12.4h70.7v70.9c0,6.9,5.6,12.4,12.4,12.4h39.6 c6.9,0,12.4-5.6,12.4-12.4v-70.7h70.9C355.5,277.9,361,272.3,361,265.4z"></path> <path d="M12.5,172.8h39.4c6.9,0,12.4-5.6,12.4-12.4v-96h102.9c6.9,0,12.4-5.6,12.4-12.4V12.5c0-6.9-5.6-12.4-12.4-12.4h-135 C14.5,0.1,0,14.5,0,32.3v128.1C0.1,167.3,5.7,172.8,12.5,172.8z"></path> <path d="M478.7,309h-39.4c-6.9,0-12.4,5.6-12.4,12.4v105.3h-98.4c-6.9,0-12.4,5.6-12.4,12.4v39.4c0,6.9,5.6,12.4,12.4,12.4h130.6 c17.7,0,32.2-14.4,32.2-32.2V321.5C491.1,314.6,485.5,309,478.7,309z"></path> <path d="M458.9,0.1H328.4c-6.9,0-12.4,5.6-12.4,12.4v39.4c0,6.9,5.6,12.4,12.4,12.4h98.4v96c0,6.9,5.6,12.4,12.4,12.4h39.4 c6.9,0,12.4-5.6,12.4-12.4v-128C491.1,14.5,476.7,0.1,458.9,0.1z"></path> </g> </g> </g></svg>
                                                        <div x-show="tooltip" class="absolute bg-white border-graphite border-2 rounded p-4 mt-1 pt-5 mt-6"  @click.outside="tooltip = !tooltip" >
                                                            <p class="mb-5 min-w-full">Number of diferent records: <span x-text="dataset.unique_values[titleHeader].length"></span></p>
                                                            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 overflow-auto max-h-80">
                                                                <template x-for="unique_value in dataset.unique_values[titleHeader]">
                                                                    <li class="pb-3 sm:pb-4 pr-5 pl-3">
                                                                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                                                            <div class="flex-1 min-w-0">
                                                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white" x-text="unique_value"></p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </template>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                        </template>
                                    </tr>
                                    </thead>
                                    </thead>
                                    <tbody class="divide-y">
                                    <template x-for="rawData,index in dataset.dataAll.data">
                                        <tr class="h-16 hover:bg-memla-600 hover:text-black" :class="(dataset.duplicate_values[index])?'bg-red-500 text-white':''" >
                                            <td class="bg-gray-200 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6" x-text="index"></td>
                                            <template x-for="(itemData, indexColumn) in rawData">
                                                <td x-show="(classElements.length==0||classElements.includes(''+indexColumn))||targetElement==indexColumn" x-text="itemData" class="px-5 py-5 border-b border-gray-200 text-sm" :class="(itemData==''||itemData==null)&&itemData!=0?'bg-red-500':(targetElement==indexColumn?'bg-green-500 hover:bg-memla-600':'')"></td>
                                            </template>
                                        </tr>
                                    </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </template>
                {{---- alert off for dev
                <x-alert_info x-show="alert_info" >

                    <div class="rounded-md bg-red-50 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-400">
                                    <path fill-rule="evenodd" d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                In this phase, data is processed to improve quality by processing and eliminating duplicates, erroneous, outliers, and missing values. It is currently focused on structured data (tabular) and is in the 10% of its development.
                            </div>
                        </div>
                    </div>
                </x-alert_info>
                --}}

            </div>
            <div class="py-16 px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24" x-data="{ ver: false, proceed: false, open: false}">
                <div class="text-center">
                    <div class="mt-6">
                        <a href="{{url('/')}}" class="text-base font-medium text-memla-900 hover:text-memla-500">
                            Go back home
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>

                    <!-- Modall -->
                    <div x-show="open == true"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-4"
                         class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
                        <div class="bg-white rounded-lg shadow-lg w-1/3">

                            <div class="sm:flex sm:items-start mt-4 mb-4 ml-4">
                                <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-green-600">
                                        <path fillRule="evenodd" d="M4.848 2.771A49.144 49.144 0 0112 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 01-3.476.383.39.39 0 00-.297.17l-2.755 4.133a.75.75 0 01-1.248 0l-2.755-4.133a.39.39 0 00-.297-.17 48.9 48.9 0 01-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97z" clipRule="evenodd" />
                                    </svg>
                                </div>
                                <div class="mt-5 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-base font-semibold leading-6 text-gray-900 m-2" id="modal-title">Attention</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            <div class="rounded-md bg-red-50 p-4 mr-4">
                                                <div class="flex">
                                                    <div class="flex-shrink-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-blue-400">
                                                            <path fill-rule="evenodd" d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3">
                                                        When changing phases, the information cannot be modified again unless you return to phase 2.
                                                    </div>
                                                </div>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end p-4 border-t">
                                <button @click="proceed = true; ver = false" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Confirm
                                </button>
                                <button @click="open = false" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>

                    {{--Save target and features modal--}}
                    <div x-show="stm == true"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-4"
                         class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-75 z-50">
                        <div class="bg-white rounded-lg shadow-lg w-1/3">

                            <div class="sm:flex sm:items-center mt-4 mb-4 ml-4 bg-memla-100">
                                <div class="p-1 mx-auto flex h-auto w-auto flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" class="bi bi-exclamation-octagon-fill fill-memla-700" viewBox="0 0 16 16">
                                        <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                                    </svg>
                                </div>
                                <div class="mt-5 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                        <div class="rounded-md p-4 mr-4">
                                            <div class="flex">
                                                <div class="ml-3">
                                                    <h3 class="">WAIT!</h3>Are you sure about your choice? Once you save the target and features you will not be able to modify them.
                                                </div>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end p-4 border-t">
                                <button x-on:click="saveTargetFeatures(targetElement, classElements)" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Save
                                </button>
                                <button @click="stm = false" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-12 sm:gap-4">
                        <div class="flex col-start-2 mt-2 ">
                            <a href="{{url('selection-study-topic')}}" class="focus:outline-none">
                                <button type="submit" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium border border-transparent rounded-md text-memla-900 bg-memla-100 hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2" ><span class="me-3"> &larr; </span>  Previous Phase  </button>
                            </a>
                        </div>

                        <div class="flex col-start-9 mt-2 ">
                            @if($dataset)
                                <button @click="open = true" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium border border-transparent rounded-md text-memla-900 bg-memla-100 hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2">Next Phase <span class="ms-3"> &rarr; </span></button>
                            @endif
                        </div>
                    </div>
                </div>

                @if($dataset)
                    <template x-if="proceed">
                        <div x-init="window.location.href = '{{ url('computational-environment', $dataset->laboratory_id) }}'+'/'+dataset.rows"></div>
                    </template>
                @endif

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script type="text/javascript">

            var pathDataset='{{isset($dataset->path)?asset('storage/'.$dataset->path):""}}';
            var nameFile='{{isset($dataset->path)?$dataset->path:""}}'

        function handler() {

            return {
                nameFile: nameFile,
                pathDataset: pathDataset,
                selectHandle:'',
                path_file:'',
                alertLoad:true,
                classElements:[],
                targetElement:null,
                datatype_column:'',
                laboratoryId : {{$id}} ? {{$id}} : 0,
                selected_target : '',
                number_o:0,
                stm: false,
                dataset:{
                    rows:0,
                    cols:0,
                    info:{
                        columns:{},
                        data:{}
                    },
                    dataAll:{
                        columns:{},
                        data:{},
                    },
                    data_description:{
                        columns:{},
                        data:{},
                        index:{},
                        },
                    unique_values:{},
                    outliers:{},
                    strings:{},
                    duplicate_values:{
                        data:{},
                        values_keys:{},
                    },
                    duplicate_data:{
                    },
                    encode_data:{
                    },
                    list_unique_values:{},
                    list_domain_values:{},
                    list_outliers:{},
                    list_strings:{},
                    centrals:{
                        median:{},
                        mean:{},
                        mode:{},
                    },
                    },
                isLoading:false,
                //values for change value in column
                changeValue:'',
                columnTitle:'',
                columnType:'',

                async mainhola(){
                    let respuesta = await fetch("{{route("main")}}")
                },

                async loadOutliers(){
                    console.log(nameFile);
                    this.isLoading=true;
                    this.columnTitle='';
                    //console.log(this.columnTitle);
                    let out = await this.getFile("{{route("load_outliers")}}"+"?file_path="+nameFile+"&target="+this.selected_target);
                    //console.log("parece que aqui no llega")

                    this.dataset.outliers = JSON.parse(out.outlierss);
                    this.dataset.strings = JSON.parse(out.countss);

                    this.dataset.centrals.mode = JSON.parse(out.modee);
                    this.dataset.centrals.median = JSON.parse(out.mediann);
                    this.dataset.centrals.mean = JSON.parse(out.meann);
                    @if(!is_null($laboratory_project->target))
                        this.selected_target = {{$laboratory_project->target}};
                        this.targetElement = this.selected_target
                    @endif
                },

                async loadFile() {
                    this.isLoading=true;
                    //console.log("Hola que talahhh")
                    console.log(this.nameFile)
                    console.log("{{route("load_file")}}")
                    let data = await this.getFile("{{route("load_file")}}"+"?file_path="+nameFile)
                    //let data = await this.getFile("{{route("load_file")}}"+"?file_path=datasets/p1tNc6MkP9MbpqwO24Ju4OumwZKJYdVnLbELrYmE.csv")
                    //console.log(data);
                    this.dataset.rows=data.rowss
                    this.dataset.cols=data.colss

                    this.dataset.dataAll=JSON.parse(data.dataParsed);
                    //console.log(JSON.parse(data.dataParsed))

                    this.dataset.info=JSON.parse(data.dataInfo.split("\n"))
                    console.log(this.dataset.info)
                    this.dataset.data_description=JSON.parse(data.description_dataset);
                    this.alertLoad=false;
                    this.dataset.unique_values=JSON.parse(data.unique_valuess);

                    this.dataset.list_unique_values=this.dataset.unique_values[this.columnTitle];
                    this.dataset.duplicate_values=JSON.parse(data.duplicate_valuess);
                    this.dataset.duplicate_data.data=JSON.parse(data.duplicate_datas);

                    this.dataset.duplicate_data.values_keys = Object.keys(JSON.parse(data.duplicate_datas)[this.dataset.dataAll.columns[0]])
                    this.dataset.encode_data = JSON.parse(data.encode_valuess);

                    /*this.dataset.outliers.numerics = JSON.parse(data.numeric_outliers);
                    this.dataset.list_outliers = this.dataset.outliers.numerics[this.columnTitle];*/
                    //console.log(this.dataset.list_outliers)

                    //console.log(JSON.parse(data.encode_valuess)[this.dataset.dataAll.columns[0]])
                    //console.log(this.dataset.dataAll.columns[0])
                    //console.log(JSON.parse(data.dataInfo))
                    //console.log(this.dataset.info.data[6][3])
                    //console.log(JSON.parse(data[7])[this.dataset.dataAll.columns[0]])
                    //console.log(this.dataset.dataAll.columns[0])
                    //console.log(this.dataset.info.data*/
                    //console.log(this.dataset);
                    //console.log("El target seleccionado es "+this.selected_target);

                    @if(!is_null($laboratory_project->target))
                        this.selected_target = {{$laboratory_project->target}};
                        this.targetElement = this.selected_target
                    @endif

                    //console.log(this.selected_target);
                    //console.log(this.selected_target)
                    //console.log(this.targetElement)
                },
                async getFile(url) {
                    let response = await fetch(url)
                    this.isLoading=false;
                    return await response.json()
                },
                changeListValues(value,index){
                    this.columnTitle=value
                    //console.log(value)
                    this.dataset.list_unique_values=this.dataset.unique_values[value]
                    if(!this.dataset.list_domain_values[value])
                        this.dataset.list_domain_values[value]=[]
                    this.columnType=this.dataset.info.data[index][3]
                },

                async saveChangeValue(value)
                {
                    if(this.changeValue!=value)
                    {
                        //console.log("http://127.0.0.1:5000/change_value?name_file="+(this.nameFile.trim())+"&columnTitle="+this.columnTitle+"&back_value="+this.changeValue+"&new_value="+value);
                        let status= await fetch("{{route("change_value")}}"+"?name_file="+this.nameFile+"&columnTitle="+this.columnTitle+"&back_value="+this.changeValue+"&new_value="+value+"&columnType="+this.columnType)
                        this.loadFile()
                    }
                },

                async deleteDuplicateValues()
                {
                    //console.log('Buenas delete')
                    console.log("http://127.0.0.1:5001/delete_duplicate/"+(this.nameFile));
                    let drop_d = await fetch("{{route("delete_duplicate")}}"+"?name_file="+this.nameFile)
                    this.loadFile()
                },

                async deleteColumns(name_col)
                {
                    //console.log("buenas funcion de columns"+name_col);
                    let drop_c = await fetch("{{route("delete_columns")}}"+"?name_file="+this.nameFile+"&name_col="+name_col)
                    this.loadFile()
                },
                async encodeColumns_o(name_col, col_values)
                {
                    console.log("buenas funcion de encode ordinal: "+col_values);
                    let enc_c = await fetch("{{route("encode_columns_o")}}"+"?name_file="+this.nameFile+"&name_col="+name_col+"&col_values="+col_values)
                    this.loadFile()
                },
                async encodeColumns_n(name_col)
                {
                    console.log("buenas funcion de encode nominal: "+name_col);
                    let enc_c = await fetch("{{route("encode_columns_n")}}"+"?name_file="+this.nameFile+"&name_col="+name_col)
                    this.loadFile()
                },
                printOutliers(value, index){
                    //console.log(value)
                    this.columnTitle=value
                    this.datatype_column = this.dataset.info.data[index][3]
                    if(this.datatype_column !== 'object' && this.datatype_column !== ''){
                        this.dataset.list_outliers=this.dataset.outliers[value]
                        //console.log(this.dataset.outliers[value])
                        //console.log("La columna no es string")
                        this.number_o = Object.keys(this.dataset.list_outliers).length
                    }
                    else{
                        //console.log("La columna es de tipo string y el target es: "+this.selected_target)
                        this.dataset.list_outliers = this.dataset.strings[value]
                        //console.log(this.dataset.strings[value])
                        //console.log(value)
                        this.number_o = Object.keys(this.dataset.list_outliers).length
                    }
                    //console.log(this.datatype_column)
                    //console.log(this.dataset.list_outliers)
                    /*console.log(this.datatype_column)
                    console.log(this.number_o)*/
                },
                async handleOutliers(num, string, datatype, selected){
                    //console.log("Hola buenas")
                    //console.log("Valor anterior: "+num+",  string: "+string+",  tipo columna: "+datatype+",  tipo de: "+selected)
                    //console.log("buenas funcion de handleOuliers: "+selectedway+"\n"+values+"\n"+indexCol+"\n"+this.columnTitle);
                    console.log("{{route("handle_outliers")}}"+"?name_file="+nameFile+"&name_col="+this.columnTitle+"&num="+num+"&string="+string+"&selected_way="+selected+"&datatype="+datatype)
                    let han_o = await fetch("{{route("handle_outliers")}}"+"?name_file="+nameFile+"&name_col="+this.columnTitle+"&num="+num+"&string="+string+"&selected_way="+selected+"&datatype="+datatype)
                    this.loadFile()
                    this.loadOutliers()
                },
                async saveTargetFeatures(target, features){
                    console.log("maldita seasdhkjckjshcd")
                    console.log(target)
                    console.log(features)
                    console.log(features[1][1])
                    if(target == null || features.length == 0){
                        console.log('Target y features null')
                    }
                    else{
                        let saveTF = await fetch("{{route("save_target")}}"+"?name_file="+nameFile+"&target="+target+"&features="+features+"&laboratory_id="+this.laboratoryId)
                    }
                    //console.log(features)
                    {{--console.log("{{route("save_target")}}"+"?name_file="+nameFile+"&target="+target+"&features="+features+"&laboratory_id="+this.laboratoryId)--}}
                    this.loadFile()
                    //console.log("Creo que ya")
                },
            }
        }
    </script>
    </x-slot>
</x-dashboard-layout>
