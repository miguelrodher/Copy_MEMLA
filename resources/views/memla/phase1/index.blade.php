<x-welcome-layout>
    <div class="bg-gray-50">
        <div class="relative py-6 mt-6 overflow-hidden">
            <div class="px-4 mx-auto mt-6 max-w-7xl sm:mt-4 sm:px-6">
                <div class="text-center">
                    <h3 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                        <span class="block text-memla-900">Selection of the study topic</span>
                        <span class="block text-memla-800">Phase 1</span>
                    </h3>
                    <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
                        Phase 1 of most investigations begins by stating a hypothesis, scope and limitations of the
                        research problem</p>
                </div>
            </div>


            <div class="px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24" x-data="handler()">
                {{-- ! Formulario phase 1 --}}
                <form class="space-y-6" action="" method="POST" id="form_phase1">
                    @csrf
                    {{--generalities--}}
                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Generalities</h3>
                                <p class="mt-1 text-sm text-gray-500">Description of the possible title, problems and
                                    justification of the experiment.</p>
                            </div>
                            <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-4 sm:col-span-3">
                                        <label for="company-website" class="block text-sm font-medium text-gray-700">Title
                                            of the experiment</label>
                                        <div class="flex mt-1 rounded-md shadow-sm">
                                            <input type="text" name="title_project" id="title_project"
                                                   class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                   placeholder="Write here the possible title of the experiment"
                                                   value="{{old("title_project")}}">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="problematic"
                                           class="block text-sm font-medium text-gray-700">Problematic</label>
                                    <div class="mt-1">
                                        <textarea id="problematic" name="problematic" rows="3"
                                                  class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                  placeholder="Describe here the problem of your project">{{old("problematic")}}</textarea>
                                    </div>
                                </div>
                                <div>
                                    <label for="justification" class="block text-sm font-medium text-gray-700">Justification</label>
                                    <div class="mt-1">
                                        <textarea id="justification" name="justification" rows="3"
                                                  class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                  placeholder="Describe here the justification of your project">{{old("justification")}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--
                                      <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Definition of the machine-learning
                                    approach </h3>
                                <p class="mt-1 text-sm text-gray-500">We need the focus of your research experiment, in
                                    order to define a good protocol</p>
                            </div>
                            <div class="mt-5 md:col-span-2 md:mt-0">
                                <fieldset>
                                    <legend class="sr-only">Do you have examples of input data and results?</legend>

                                    <div class="text-base font-medium text-gray-900" aria-hidden="true">Do you have
                                        examples of input data and results?
                                    </div>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="option_yes" name="have_results" type="radio" value="Yes"
                                                       class="w-4 h-4 text-memla-800 border-gray-300 rounded focus:ring-memla-700" {{old('have_results')=="Yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="option_yes" class="font-medium text-gray-700">Yes</label>
                                            </div>
                                            <div class="flex items-center h-5 ml-3">
                                                <input id="option_no" name="have_results" type="radio" value="No"
                                                       class="w-4 h-4 text-memla-800 border-gray-300 rounded focus:ring-memla-700" {{old('have_results')=="No" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="option_no" class="font-medium text-gray-700">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-base font-medium text-gray-900" aria-hidden="true">Do
                                        you want to <span class="font-bold">predict</span> the behavior of a
                                        phenomenon?</label>
                                    </div>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="option_yes_behavior" name="predict_behavior" type="radio" value="Yes"
                                                       class="w-4 h-4 text-memla-800 border-gray-300 rounded focus:ring-memla-700" {{old('predict_behavior')=="Yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="option_yes_behavior" class="font-medium text-gray-700">Yes</label>
                                            </div>
                                            <div class="flex items-center h-5 ml-3">
                                                <input id="option_no_behavior" name="predict_behavior" type="radio" value="No"
                                                       class="w-4 h-4 text-memla-800 border-gray-300 rounded focus:ring-memla-700" {{old('predict_behavior')=="No" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="option_no_behavior" class="font-medium text-gray-700">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-base font-medium text-gray-900" aria-hidden="true">Do
                                        you need to <span class="font-bold">classify</span> data?</label>
                                    </div>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="option_yes_classify" name="classify_data" type="radio" value="Yes"
                                                       class="w-4 h-4 text-memla-800 border-gray-300 rounded focus:ring-memla-700" {{old('classify_data')=="Yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="option_yes_classify" class="font-medium text-gray-700">Yes</label>
                                            </div>
                                            <div class="flex items-center h-5 ml-3">
                                                <input id="option_no_classify" name="classify_data" type="radio" value="No"
                                                       class="w-4 h-4 text-memla-800 border-gray-300 rounded focus:ring-memla-700" {{old('classify_data')=="No" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="option_no_classify" class="font-medium text-gray-700">No</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-base font-medium text-gray-900" aria-hidden="true"> Is it required to <span class="font-bold">find relationships</span>
                                        in the data?</label>
                                    </div>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="option_yes_find" name="find_relationships" type="radio" value="Yes"
                                                       class="w-4 h-4 text-memla-800 border-gray-300 rounded focus:ring-memla-700" {{old('find_relationships')=="Yes" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="option_yes_find" class="font-medium text-gray-700">Yes</label>
                                            </div>
                                            <div class="flex items-center h-5 ml-3">
                                                <input id="option_no_find" name="find_relationships" type="radio" value="No"
                                                       class="w-4 h-4 text-memla-800 border-gray-300 rounded focus:ring-memla-700" {{old('find_relationships')=="No" ? 'checked='.'"'.'checked'.'"' : '' }}>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="option_no_find" class="font-medium text-gray-700">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    --}}
                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Definition of project
                                    resources </h3>
                                <p class="mt-1 text-sm text-gray-500">To be able to generate support in the generation
                                    of a schedule of activities</p>
                            </div>
                            <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">

                                <h3 class="text-base font-medium leading-6 text-gray-900">Available time for the
                                    project</h3>
                                <div class="grid grid-cols-6 gap-4">
                                    <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                        <x-datepicker model="startDate" name="start_date" :date="old('start_date',now())" label="Start date" id="startDate" />

                                            {{---
                                            <input type="date" x-model="startDate" name="start_date" id="start_date"
                                                   autocomplete="given-name"
                                                   class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                   value="{{old("start_date")}}">--}}
                                    </div>

                                    <div class="col-span-6 md:col-span-3 lg:col-span-3">
                                        <x-datepicker model="endDate" name="end_date" :date="old('end_date',now())" label="End date" id="endDate"/>
                                    </div>
                                </div>
                                <div class="">
                                    <label for="number_members" class="block"><h3
                                            class="text-base font-medium leading-6 text-gray-900">Number of members of
                                            the task force</h3></label>
                                    <div class="mt-1">
                                        <select id="number_members" name="number_members" autocomplete="country-name"
                                                class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="" disabled>Select...</option>
                                        <option
                                            value="1-5" {{old('number_members')=="1-5" ? 'selected='.'"'.'selected'.'"' : '' }}>
                                            1-5
                                        </option>
                                        <option
                                            value="6-10" {{old('number_members')=="6-10" ? 'selected='.'"'.'selected'.'"' : '' }}>
                                            6-10
                                        </option>
                                        <option
                                            value="11-15" {{old('number_members')=="11-15" ? 'selected='.'"'.'selected'.'"' : '' }}>
                                            11-15
                                        </option>
                                        <option
                                            value="16-20" {{old('number_members')=="16-20" ? 'selected='.'"'.'selected'.'"' : '' }}>
                                            16-20
                                        </option>

                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Definition of objectives</h3>
                                <p class="mt-1 text-sm text-gray-500">Specific objectives are considered by default</p>
                            </div>
                            <div class="mt-5 space-y-6 md:col-span-2 md:mt-0">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3">
                                        <label for="goal" class="block text-sm font-medium text-gray-700">Goal</label>
                                        <div class="flex mt-1 rounded-md shadow-sm">
                                            <input type="text" name="goal" id="goal"
                                                   class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                   placeholder="Goal" value="{{old("goal")}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <h3 class="col-span-6 text-sm font-medium leading-6">Specific objectives</h3>
                                    <template>
                                        <div x-text="fields"></div>
                                    </template>


                                    <template x-for="(field, index) in fields" :key="index">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 md:col-span-1">
                                                <label :for="'objective'+(index+1)"
                                                       class="block text-sm font-medium text-gray-700"
                                                       x-text="'Objective '+(index+1)"></label>
                                            </div>
                                            <div class="col-span-6 md:col-span-4">
                                                <div class="flex mt-1 rounded-md shadow-sm">
                                                    <input type="text" :name="'objective['+(index+1)+']'"
                                                           :id="'objective'+(index+1)"
                                                           class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                           x-model="field.objective">
                                                </div>
                                            </div>
                                            <div class="col-span-6 md:col-span-1">
                                                <a href="#!"
                                                   class="px-1 py-1 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-500 hover:to-orange-400"
                                                   @click="removeField(index)">&times;</a>
                                                <a href="#!"
                                                   class="px-1 py-1 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-600 hover:to-gray-500"
                                                   x-show="index!=0" @click="changeIndexField(index,index-1)">&uarr;</a>
                                                <a href="#!"
                                                   class="px-1 py-1 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-600 hover:to-gray-500"
                                                   x-show="index<(fields.length-1)"
                                                   @click="changeIndexField(index,index+1)">&darr;</a>

                                            </div>
                                        </div>
                                    </template>
                                    <a href="#!"
                                       class="block px-4 py-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"
                                       @click="addNewField()">+ Add objetive</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <div class="md:grid md:grid-cols-4 md:gap-6">
                            <div class="md:col-span-1">
                                <h3 class="text-lg font-bold leading-6 text-gray-900">Project demarcation</h3>
                                <p class="mt-1 text-sm text-gray-500">Proposal to contribute to the knowledge generated
                                    by the first phase of MEMLA based on the data you provided by applying Natural
                                    Language Processing (NLP)</p>
                                <div class="flex justify-center" x-data="{ buttonDisabled: false }">
                                    {{-- ! Añadir validacion al boton, tiene que estar logeado el usuario para generar la informacion --}}

                                        <button type="button" x-on:click="buttonDisabled = true"
                                                class="inline-flex block px-4 py-3 my-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"
                                                @click="nlpGenerate()" x-show="!buttonDisabled">Generate
                                        </button>
                                        <div role="status" x-show="buttonDisabled">
                                            <svg aria-hidden="true"
                                                 class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                 viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor"/>
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    {{--
                                   @if (auth()->check())
                                   @else
                                      <a href="login" class="inline-flex block px-4 py-3 my-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600">Generate</a>
                                        <a href="login"><input type="button"
                                                               class="inline-flex block px-4 py-3 my-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600 cursor-pointer"
                                                               value="Generate"></a>
                                    @endif
                                            --}}
                                </div>
                            </div>


                            <div class="mt-5 space-y-6 md:col-span-3 md:mt-0">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3">
                                        {{-- ! El usuario no puede editar la informacion generada --}}
                                        <label for="definition_hypothesis"
                                               class="block font-medium text-gray-700 text-medium">Definition of the
                                            hypothesis.</label>
                                        <div class="flex mt-1 rounded-md shadow-sm">
                                            <textarea name="definition_hypothesis" id="definition_hypothesis" rows="4"
                                                      class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm "readonly>{{Session::get('result')?(isset(Session::get('result')->hypothesis)?Session::get('result')->hypothesis:'The server of Natural Language Processing is not available'):''}}{{old("definition_hypothesis")}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3">
                                        <label for="definition_scopes"
                                               class="block font-medium text-gray-700 text-medium">Definition of
                                            scopes.</label>
                                        <div class="flex mt-1 rounded-md shadow-sm">
                                            <textarea name="definition_scopes" id="definition_scopes" rows="7"
                                                      class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"readonly>{{Session::get('result')?(isset(Session::get('result')->scopes)?implode("\n",Session::get('result')->scopes):'The server of Natural Language Processing is not available'):''}}{{old("definition_scopes")}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                     <div class="col-span-3">
                                         <label for="definition_limitations"
                                                class="block font-medium text-gray-700 text-medium">Definition of
                                             limitations.</label>
                                         <div class="flex mt-1 rounded-md shadow-sm">
                                             <textarea name="definition_limitations" id="definition_limitations" rows="7"
                                                       class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"readonly>{{Session::get('result')?(isset(Session::get('result')->limitations)?implode("\n",Session::get('result')->limitations):'The server of Natural Language Processing is not available'):''}}{{old("definition_scopes")}}</textarea>
                                         </div>
                                     </div>
                                 </div>

                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="sm:flex sm:items-center">
                                <div class="sm:flex-auto">
                                    <h1 class="text-xl font-semibold text-gray-900">Development of schedule of
                                        activities</h1>
                                </div>
                                <div class="flex justify-center">
                                    <button type="button"
                                            class="inline-flex block px-4 py-3 my-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"
                                            @click="scheduleGenerate()">Generate Schedule
                                    </button>
                                </div>
                            </div>
                            <div
                                class="mt-8 -mx-4 pb-3 shadow ring-1 ring-black ring-opacity-5 sm:-mx-6 md:mx-0 md:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Activities
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 lg:table-cell">
                                            Start Date
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell">
                                            End Date
                                        </th>
                                        <th scope="col"
                                            class="hidden px-3 py-3.5 text-left text-sm font-semibold text-gray-900 sm:table-cell"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                    <template x-for="(field, index) in schedule" :key="index">
                                        <tr>
                                            <td class="w-full py-4 pl-4 pr-3 text-sm font-medium text-gray-900 max-w-0 sm:w-auto sm:max-w-none sm:pl-6">
                                                <input type="text" :name="'activity['+(index+1)+']'"
                                                       :id="'activity'+(index+1)"
                                                       class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                                       x-model="(field.activity)">

                                                <dl class="font-normal lg:hidden">
                                                    <dt class="sr-only">Start Date</dt>
                                                    <dd class="mt-1 text-gray-700 truncate"
                                                        x-text="field.dates.startDate"></dd>
                                                    <dt class="sr-only sm:hidden">End Date</dt>
                                                    <dd class="mt-1 text-gray-500 truncate"
                                                        x-text="field.dates.endDate"></dd>
                                                </dl>
                                            </td>
                                            <td class="hidden px-3 py-4 text-sm text-gray-500 lg:table-cell">

                                                <x-datepicker  type="text" name="activityStart[]"
                                                               reactive=":"
                                                        id="'activityStart'+(index+1)"
                                                               class="dateSchedule"
                                                       model="field.dates.startDate" />
                                            </td>
                                            <td class="hidden px-3 py-4 text-sm text-gray-500 sm:table-cell">
                                                <x-datepicker type="text" name="activityEnd[]" reactive=":"
                                                       id="'activityEnd'+(index+1)"
                                                              class="dateSchedule"
                                                       model="field.dates.endDate" />
                                            </td>
                                            <td>
                                                <a href="#!"
                                                   class="px-1 py-1 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-red-400 to-red-500 hover:from-red-600 hover:to-red-700"
                                                   @click="removeActivity(index)">&times;</a>
                                                <a href="#!"
                                                   class="px-1 py-1 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-cyan-400 to-cyan-500 hover:from-cyan-600 hover:to-cyan-700"
                                                   x-show="index!=0"
                                                   @click="changeIndexActivity(index,index-1)">&uarr;</a>
                                                <a href="#!"
                                                   class="px-1 py-1 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-cyan-400 to-cyan-500 hover:from-cyan-600 hover:to-cyan-700"
                                                   x-show="index<(schedule.length-1)"
                                                   @click="changeIndexActivity(index,index+1)">&darr;</a>

                                            </td>
                                        </tr>
                                    </template>
                                    <tr>
                                        <td colspan="4"
                                            class="w-full py-4 pl-4 pr-3 text-sm font-medium text-gray-900 max-w-0 sm:w-auto sm:max-w-none sm:pl-6">
                                            <a href="#!"
                                               class="block px-4 py-3 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"
                                               @click="addNewActivity()">+ Add activity</a>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="flex justify-end mt-2">
                            <p>
                            <h3>
                                <span
                                    class="text-black">If memla.mx was helpful to you, feel free to cite us:</span><br>


                                <span class="text-black">Sánchez-DelaCruz, E., Loeza-Mejía, C.I., Pozos-Parra, P., (2023). MEMLA: Methodology for Experiments with Machine Learning Algorithms. [In process]</span><br>
                               {{--- <span class="text-black">•Loeza-Mejía, C.I., Sánchez-DelaCruz, E., Landero-Hernández, L.A. & José-Guzmán, I.O. (2023). Three decades of challenges, perspectives, and changes in methodologies to implement machine learning projects: a systematic review. [Under review]</span><br>--}}
                            </h3>
                            </p>
                            <button type="submit" x-show="project_id==0"
                                    class="inline-flex block px-4 py-3 my-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"
                                    @click="printPhase1()">Save project
                            </button>
                            <a :href="'{{url("printpdf/phase1")}}/'+project_id"  x-show="project_id!=0 && showNextPhase==false" target="_blank"
                                    class="inline-flex block px-4 py-3 my-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"
                                    @click="showNextPhase=true">Generate PDF
                            </a>

                            <a href="{{url('project_memla')}}" class="focus:outline-none" x-show="showNextPhase == true">
                                <button type="button"
                                        class="inline-flex block px-4 py-3 my-2 font-medium text-center text-white rounded-md shadow bg-gradient-to-r from-memla-800 to-memla-900 hover:from-memla-200 hover:to-memla-300 hover:text-gray-600"
                                        x-on:click="buttonActive = 'bayes'"
                                        :class="buttonActive == 'bayes' ? 'bg-memla-300' : 'bg-memla-100'"> Next Phase <span> &rarr;</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
                @if ($errors->any())
                    <x-alert_error x-show="alert_error" x-init="buttonDisabled=false" x-model="redirectt = true">

                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were {{$errors->count()}} errors
                                        with your submission</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul role="list" class="list-disc space-y-1 pl-5">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-alert_error>
                @endif
                @if (!$errors->any()&&false)
                    <x-alert_info x-show="alert_info">

                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         class="w-6 h-6 text-blue-400">
                                        <path fill-rule="evenodd"
                                              d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    In this phase, the user defines the title, problem, and justification of the
                                    project, as well as the time and resources required to complete a machine learning
                                    project. Subsequently, a natural language processing algorithm is employed to offer
                                    suggestions of hypotheses, scopes, and limitations. In addition, the start and end
                                    dates of the project are considered to suggest the schedule of activities. The user
                                    obtains a PDF file of the project proposal. This phase is in 90% of its development.
                                </div>
                            </div>
                        </div>
                    </x-alert_info>
                @endif



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
                                                Your project has been saved, to continue go to the bottom of the site to print your pdf
                                            </div>
                                        </div>
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end p-4 border-t">
                            <button @click="open = false" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Confirm
                            </button>
                        </div>
                    </div>
                </div>
                <template x-if="project_id!=0">
                    <div x-data="open=true"></div>
                </template>
            </div>
        </div>
    </div>



    {{--  inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-indigo-700 bg-indigo-100 border border-transparent rounded-md hover:bg-indigo-200  --}}
    <x-slot name="scripts">
        <script type="text/javascript">

            function handler() {
                return {
                    fields: [
                        @if(old("objective"))
                            @foreach(old("objective") as $objective)
                                {!! '{objective: "'.$objective.'"},' !!}
                            @endforeach
                        @else
                            {objective: "Analyze the state-of-the-art."},
                            {objective: "Get a dataset."},
                            {objective: "Implement a machine learning algorithm."},
                            {objective: "Validate the results using machine learning metrics."},
                            {objective: "Apply knowledge (generate a prototype)."},
                        @endif
                    ],
                    @if(old("activity"))
                        schedule: [
                        @foreach(old("activity") as $activity)
                            {!! '{activity:"'.$activity.'", dates:{startDate:"'.old("activityStart")[$loop->index].'",endDate:"'.old("activityEnd")[$loop->index].'"}},' !!}
                        @endforeach
                        ],
                    @else
                        schedule: [],
                    @endif

                    buttonActive:'',
                    proceed: false,
                    open: false,
                    showNextPhase: false,
                    startDate: "{{old("start_date",now())}}",
                    endDate: "{{old("end_date",now())}}",
                    scheduleDays: 0,
                    schedulePeriod: 0,
                    alert_error: {{$errors->any()?"true":"false"}},
                    alert_info: true,
                    redirectt : false,
                    project_id:{{Session::get('project_id')?Session::get('project_id'):0}},
                    addNewField() {
                        console.log(this.fields)
                        this.fields.push({
                            objetive: '',
                        });
                    },
                    removeField(index) {
                        this.fields.splice(index, 1);
                    },
                    changeIndexField(index, position) {

                        const fromIndex = index;
                        const toIndex = position;
                        const element = this.fields.splice(fromIndex, 1)[0];
                        this.fields.splice(toIndex, 0, element);

                    },

                    addNewActivity() {
                        this.schedule.push({
                            activity: '',
                            dates: [],
                        });
                        this.calculateDates();
                    },
                    removeActivity(index) {
                        this.schedule.splice(index, 1);
                        this.calculateDates();
                    },
                    changeIndexActivity(index, position) {

                        const fromIndex = index;
                        const toIndex = position;
                        const element = this.schedule.splice(fromIndex, 1)[0];
                        this.schedule.splice(toIndex, 0, element);

                    },
                    nlpGenerate() {

                        document.getElementById("form_phase1").target = ""
                        document.getElementById("form_phase1").method = "post"
                        document.getElementById("form_phase1").action = "{{url('selection-study-topic')}}"
                        document.getElementById("form_phase1").submit();
                    },
                    printPhase1() {
                        document.getElementById("form_phase1").method = "post"
                        document.getElementById("form_phase1").action = "{{url('selection-study-topic/save_data')}}"
                        document.getElementById("form_phase1").submit();
                    },
                    scheduleGenerate() {

                       // console.log(this.startDate)

                        this.schedule = [];
                        this.fields.forEach(element => {
                            this.schedule.push({activity: element.objective, dates: []})
                        });
                        this.calculateDates();
                    },
                    calculateDates() {

                        let startDate = moment(this.startDate);
                        let endDate = moment(this.endDate);
                        let dateAux = startDate;
                       // console.log(startDate)

                        this.scheduleDays = endDate.diff(startDate, 'days')
                        this.schedulePeriod = parseInt(this.scheduleDays / this.schedule.length);

                        this.schedule.forEach((element, index, array) => {
                            element.dates = {
                                startDate: dateAux.format('MM/DD/YYYY'),
                                endDate: (index < array.length - 1 ? dateAux.add(this.schedulePeriod, 'days') : endDate).format('MM/DD/YYYY')
                            }
                            dateAux.add(1, 'days')
                        });

                         console.log(this.schedule);
                        //let dateTest=moment(startDate).add(1,'M');
                        //console.log(startDate.add(0.33,'months').toDate()+'--'+ this.schedulePeriod);
                        //this.fields.forEach(element => console.log(element));
                    }
                }
            }
        </script>
    </x-slot>
</x-welcome-layout>

