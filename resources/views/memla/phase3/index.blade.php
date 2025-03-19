<x-dashboard-layout>
    <!-- Index Post -->
        <div class="bg-gray-50"  x-data="handler()" x-init="precargarInfo()">
            <div class="relative py-6 mt-6 overflow-hidden">
                <div class="px-4 mx-auto mt-6 max-w-7xl sm:mt-4 sm:px-6">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                            <span class="block text-memla-900 ">Dataset split and computational environment selection</span>
                            <span class="block text-memla-800">Phase 3</span>
                            {{--<span x-text = showTable></span>--}}
                        </h3>
                        <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
                            {{$laboratory_project->title}}
                        </p>
                    </div>
                </div>

                {{-- revisar los id de etiquetas y campos --}}
                <div class="mr-5 ml-5 mt-5">
                    <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                        <div class="flex items-center justify-center">
                            <span class="inline-flex rounded-md shadow-sm isolate">
                                <button type="button" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-memla-900 border border-transparent rounded-md hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2" x-on:click="showTable = 'tercios', buttonActive = 'tercios'" :class="buttonActive=='tercios' ? 'bg-memla-300' : 'bg-memla-100'">2/3-1/3</button>
                                <button type="button" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2" x-on:click="showTable = 'representative', buttonActive = 'representative'" :class="buttonActive=='representative' ? 'bg-memla-300' : 'bg-memla-100'">Representative sample</button>
                                <button type="button" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2" x-on:click="showTable = 'kFold', buttonActive = 'kFold'" :class="buttonActive=='kFold' ? 'bg-memla-300' : 'bg-memla-100'">K-fold</button>
                            </span>
                        </div>
                        <div class="items-center justify-center md:grid md:grid-cols-3 md:gap-6">

                            <div class="col-span-1 col-start-2 mt-2" :class="buttonActive=='tercios' ? 'show' : 'hidden'">
                                <label for="default-range" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Percentage split</label>
                                <input id="default-range" x-model="testPercentage" type="range" value="100" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                                <h5> Test Percentage:
                                    <span x-text="testPercentage"></span>
                                </h5>
                                <h5> Training Percentage:
                                    <span x-text="trainingPercentage=100-testPercentage"></span>
                                </h5>
                                <button
                                    x-on:click="loadSplit(), showTable = 'tercios'"
                                    id = "save_tercios" name = "save_tercios" type="button"
                                    class="mt-2 px-3 py-1 text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 cursor-pointer rounded">Save 1
                                </button>
                            </div>

                            <div class="col-span-1 col-start-2 mt-2" :class="buttonActive=='representative' ? 'show' : 'hidden'">
                                <label for="confidence_level" class="block text-sm font-medium text-gray-700">Confidence level(%)</label>
                                <div class="flex mt-1 rounded-md shadow-sm">
                                    <select x-model="confidenceLevel" name="confidence_level" id="confidence_level" class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-memla-500 focus:ring-memla-500 sm:text-sm">
                                        <option value="80">80</option>
                                        <option value="85">85</option>
                                        <option value="90">90</option>
                                        <option value="95">95</option>
                                        <option value="99">99</option>
                                    </select>
                                </div>
                                <label for="margin_error" class="block text-sm font-medium text-gray-700">Margin of error (%)</label>
                                <div class="flex mt-1 rounded-md shadow-sm">
                                    <input x-model="marginError" type="text" name="margin_error" id="margin_error" class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-memla-500 focus:ring-memla-500 sm:text-sm" placeholder="Margin of error" value="5">
                                </div>
                                <button
                                    x-on:click="loadRepresentative(), showTable = 'representative'"
                                    id = "save_representative" name = "save_representative" type="button"
                                    class="mt-2 px-3 py-1 text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 cursor-pointer rounded">Save 2
                                </button>
                            </div>

                            <div class="col-span-1 col-start-2 mt-2" :class="buttonActive=='kFold' ? 'show' : 'hidden'">
                                <label for="cross_validation" class="block text-sm font-medium text-gray-700">Cross validation</label>
                                <div class="flex mt-1 rounded-md shadow-sm">
                                    <input x-model="crossValidation" type="number" name="cross_validation" id="cross_validation" class="flex-1 block w-full border-gray-300 rounded-none rounded-r-md focus:border-memla-500 focus:ring-memla-500 sm:text-sm" placeholder="Cross Validation" value="30">
                                </div>
                                <p x-show="errors.crossValidation" x-text="errors.crossValidation" class="text-red-500"></p>
                                <button
                                    x-on:click="errors.crossValidation = '', loadKFold(), showTable = 'kFold'"
                                    id = "save_kFold" name = "save_kFold" type="button"
                                    class="mt-2 px-3 py-1 text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 cursor-pointer rounded">Save 3
                                </button>
                            </div>
                        </div>
                    </div>

                    {{--Table Tercios--}}
                    <div :class="showTable=='tercios' ? 'show' : 'hidden'">
                        <template x-for="data, in dataset.filter((_, i) => i === 0 || i === 1)">       {{--Acceder solo a las posiciones que yo le indique--}}
                            <div class="col-span-7 snap-start items-center px-8 py-10 bg-white sm:rounded-lg sm:p-6 shadow mt-2"> {{--Test--}}
                                <ul class="mb-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li class="mb-2">
                                        <div class="relative p-3" >
                                            <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                            <p class="text-2xl font-extrabold text-memla-900" x-text = "data.description??'NA'"></p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border rounded-lg overflow-x-auto dark:border-neutral-700">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead >
                                        <tr>
                                            <th>Index</th>
                                            <template x-for="head in data.data_description.columns">
                                                <th x-text="head"></th>
                                            </template>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <template x-for="(rowData, index) in data.data_description.data">
                                            <tr class="border">
                                                <td x-text="data.data_description.index[index]"></td>
                                                <template x-for="columnData in rowData">
                                                    <td x-text="columnData??'NA'"></td>
                                                </template>
                                            </tr>
                                        </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </div>
                    {{--Table representative--}}
                    <div :class="showTable=='representative' ? 'show' : 'hidden'">
                        <template x-for="data, in dataset.filter((_, i) => i === 2 || i === 3)">       {{--Acceder solo a las posiciones que yo le indique--}}
                            <div class="col-span-7 snap-start items-center px-8 py-10 bg-white sm:rounded-lg sm:p-6 shadow mt-2"> {{--Test--}}
                                <ul class="mb-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li class="mb-2">
                                        <div class="relative p-3" >
                                            <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                            <p class="text-2xl font-extrabold text-memla-900" x-text = "data.description??'NA'"></p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border rounded-lg overflow-x-auto dark:border-neutral-700">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead >
                                        <tr>
                                            <th>Index</th>
                                            <template x-for="head in data.data_description.columns">
                                                <th x-text="head"></th>
                                            </template>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <template x-for="(rowData, index) in data.data_description.data">
                                            <tr class="border">
                                                <td x-text="data.data_description.index[index]"></td>
                                                <template x-for="columnData in rowData">
                                                    <td x-text="columnData??'NA'"></td>
                                                </template>
                                            </tr>
                                        </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </div>
                    {{--Table k-Fold--}}
                    <div :class="showTable=='kFold' ? 'show' : 'hidden'">
                        <template x-for="data, in dataset.filter((_, i) => i === 4 || i === 5)">       {{--Acceder solo a las posiciones que yo le indique--}}
                            <div class="col-span-7 snap-start items-center px-8 py-10 bg-white sm:rounded-lg sm:p-6 shadow mt-2"> {{--Test--}}
                                <ul class="mb-3 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <li class="mb-2">
                                        <div class="relative p-3" >
                                            <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-memla-300 via-memla-500 to-memla-600"></span>
                                            <p class="text-2xl font-extrabold text-memla-900" x-text = "data.description??'NA'"></p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="border rounded-lg overflow-x-auto dark:border-neutral-700">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                        <thead >
                                        <tr>
                                            <th>Index</th>
                                            <template x-for="head in data.data_description.columns">
                                                <th x-text="head"></th>
                                            </template>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <template x-for="(rowData, index) in data.data_description.data">
                                            <tr class="border">
                                                <td x-text="data.data_description.index[index]"></td>
                                                <template x-for="columnData in rowData">
                                                    <td x-text="columnData??'NA'"></td>
                                                </template>
                                            </tr>
                                        </template>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="py-16">
                    <div class="text-center">
                        <h1 class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl"></h1>
                        <p class="mt-2 text-base text-gray-500">Under construction.</p>
                        <div class="mt-6">
                            <a href="{{url('/')}}" class="text-base font-medium text-memla-900 hover:text-memla-500">
                                Go back home
                                <span aria-hidden="true"> &rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="py-10 px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24">
                    <div class="sm:grid sm:grid-cols-12 sm:gap-4">
                        <div class="flex col-start-2 mt-2 ">
                            {{--@dd($id);--}}
                            <a href="{{url('data-collection',$id)}}" class="focus:outline-none">
                                <button type="submit" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2"   x-on:click="buttonActive = 'bayes'" :class="buttonActive=='bayes' ? 'bg-memla-300' : 'bg-memla-100'"><span> &larr; </span>  Previous Phase  </button>
                            </a>
                        </div>
                        <div class="flex col-start-9 mt-2 ">
                            <a href="{{url('/implementation-algorithm',$id)}}/{{$rows}}" class="focus:outline-none">
                                <button type="submit" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2"   x-on:click="buttonActive = 'bayes'" :class="buttonActive=='bayes' ? 'bg-memla-300' : 'bg-memla-100'">Next Phase  <span> &rarr;</span></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-slot name="scripts">
            <script type="text/javascript">
                var pathDatasetTest = [];
                var pathDatasetTraining = [];
                @if($dataset)
                    var pathDataset='{{asset('storage/'.$dataset->path)}}';
                    var nameFile='{{isset($dataset->path)?$dataset->path:""}}';
                @endif()
                {{--@dd($dataset_test, $dataset_training);--}}

                @for($i = 0; $i < 6; $i++)
                    pathDatasetTest['{{$i}}'] = '{{isset($datasets_type[$i]->path)?$datasets_type[$i]->path:''}}';
                    pathDatasetTraining['{{$i+1}}'] = '{{isset($datasets_type[$i+1]->path)?$datasets_type[$i+1]->path:''}}';
                    '{{$i++}}';
                @endfor

                var rows = '{{$rows}}';

                //console.log(window);

                function handler() {

                    return {
                    rows : rows,
                    pathDataTestLocal: pathDatasetTest,
                    pathDataTrainLocal: pathDatasetTraining,
                    showTable : "",
                    buttonActive : "",
                    laboratoryId : {{$id}} ? {{$id}} : 0,
                    trainingPercentage : 66,
                    testPercentage : 34,
                    confidenceLevel : 80,
                    marginError : 5,
                    crossValidation : 30,

                    path_file:'',
                    alertLoad:true,
                    classElements:[],
                    targetElement:null,
                    arrayFile:[],

                    dataset:[],

                    isLoading:false,
                    //values for change value in column
                    changeValue:'',
                    columnTitle:'',
                    columnType:'',
                    i: 0,
                    loops:0,
                    errors:{
                        crossValidation:''
                    },

                    async loadFile1(nameFile) {
                        let acces = 0;
                        for(this.i; this.i<this.loops; this.i++) {
                            this.dataset[this.i] = {
                                description: "",
                                rows: 0,
                                cols: 0,
                                info: {
                                    columns: {},
                                    data: {}
                                },
                                dataAll: {
                                    columns: {},
                                    data: {}
                                },
                                data_description: {
                                    columns: {},
                                    data: {},
                                    index: {}
                                },
                                unique_values: {},
                                duplicate_values: {
                                    data: {},
                                    values_keys: {}
                                },
                                duplicate_data: {},
                                list_unique_values: {},
                                list_domain_values: {},
                            };

                            this.isLoading = true;
                            let data = await this.getFile("{{route("load_file")}}" + "?file_path=" + nameFile[acces]);
                            //console.log(data);

                            if(this.i === 0 || this.i === 2 || this.i === 4)
                                this.dataset[this.i].description = "Test percentage description"
                            else
                                this.dataset[this.i].description = "Training percentage description"

                            this.dataset[this.i].rows = data.rowss;
                            this.dataset[this.i].cols = data.colss;

                            this.dataset[this.i].dataAll = JSON.parse(data.dataParsed);
                            //console.log(JSON.parse(data.dataParsed))

                            this.dataset[this.i].info = JSON.parse(data.dataInfo.split("\n"))
                            this.dataset[this.i].data_description = JSON.parse(data.description_dataset);
                            this.alertLoad = false;

                            this.dataset[this.i].unique_values = JSON.parse(data.unique_valuess);

                            this.dataset[this.i].list_unique_values = this.dataset[this.i].unique_values[this.columnTitle];
                            this.dataset[this.i].duplicate_values = JSON.parse(data.duplicate_valuess);
                            this.dataset[this.i].duplicate_data.data = JSON.parse(data.duplicate_datas);

                            this.dataset[this.i].duplicate_data.values_keys = Object.keys(JSON.parse(data.duplicate_datas)[this.dataset[this.i].dataAll.columns[0]])
                            console.log(this.dataset);
                            console.log(nameFile[acces]);
                            console.log(this.i);
                            console.log(this.loops);
                            acces ++;
                        }
                    },

                    async getFile(url) {
                        let response = await fetch(url)
                        this.isLoading=false;
                        return await response.json()
                    },

                    async loadSplit(){
                        console.log("Id del lab project: "+this.laboratoryId);    console.log("Test percentage: "+this.testPercentage);    console.log("Training percentage: "+this.trainingPercentage);

                        let loadSplit = await this.getFile("{{route("split_data")}}"+"?name_file="+nameFile+"&testPercentage="+this.testPercentage+"&laboratoryId="+this.laboratoryId);
                        console.log(loadSplit);

                        this.i = 0;         //Estableces a i en lo que necesites para guardar en las posiciones que necesites segun llames a la funcion
                        this.loops = 2;      //Estableces a la condición del for en lo que necesites para que coincida con i, esto se cambia cada vez que llames a loadFile
                        this.arrayFile = [loadSplit.path_test,loadSplit.path_training];
                        this.loadFile1(this.arrayFile);
                    },

                    async loadRepresentative(){
                        console.log("Id del lab project: "+this.laboratoryId);    console.log("Confidence level: "+this.confidenceLevel);    console.log("Margin of error: "+this.marginError);

                        let loadRepresentative = await this.getFile("{{route("split_representative")}}"+"?name_file="+nameFile+"&confidenceLevel="+this.confidenceLevel+"&marginError="+this.marginError+"&laboratoryId="+this.laboratoryId);
                        console.log(loadRepresentative);

                        this.i = 2;         //Estableces a i en lo que necesites para guardar en las posiciones que necesites segun llames a la funcion
                        this.loops = 4;      //Estableces a la condición del for en lo que necesites para que coincida con i, esto se cambia cada vez que llames a loadFile
                        this.arrayFile = [loadRepresentative.path_test,loadRepresentative.path_training];
                        this.loadFile1(this.arrayFile);
                    },

                    async loadKFold(){
                        const value = parseInt(this.crossValidation);
                        if (value < 2 || value > this.rows) {
                            this.errors.crossValidation = 'The K-fold value must be less than or equal to the number of records in your dataset (97).';
                        } else if(isNaN(value)){
                            this.errors.crossValidation = 'The entered value must not be empty. Only numeric values are supported';
                        } else {
                            console.log("Id del lab project: " + this.laboratoryId);
                            console.log("Cross Validation: " + this.crossValidation);

                            let loadKFold = await this.getFile("{{route("split_k_fold")}}" + "?name_file=" + nameFile + "&crossValidation=" + this.crossValidation + "&laboratoryId=" + this.laboratoryId);
                            console.log(loadKFold);

                            this.i = 4;         //Estableces a i en lo que necesites para guardar en las posiciones que necesites segun llames a la funcion
                            this.loops = 6;      //Estableces a la condición del for en lo que necesites para que coincida con i, esto se cambia cada vez que llames a loadFile
                            this.arrayFile = [loadKFold.path_test, loadKFold.path_training];
                            this.loadFile1(this.arrayFile);
                        }
                    },

                    async precargarInfo(){
                        {{--DECLARAR ARREGLOS E ITERAR SOBRE ELLOS PARA LLAMAR A LOAD FILE.--}}
                        console.log("Esta es la path del test: \n");   console.log(this.pathDataTestLocal);
                        console.log("Esta es la path del train: \n");     console.log(this.pathDataTrainLocal);

                        for(var i = 0; i < 6; i++) {
                            if (this.pathDataTestLocal[i] !== "" && this.pathDataTrainLocal[i+1] !== "") {
                                console.log("Entra al if");
                                this.i = i;
                                this.loops = i+2;
                                console.log("i: ",this.i, "loop: ",this.loops);
                                console.log("path test",this.pathDataTestLocal[i], "path train",this.pathDataTrainLocal[i+1]);
                                let array = [this.pathDataTestLocal[i], this.pathDataTrainLocal[i+1]];
                                await this.loadFile1(array);
                                console.log("load file llamada");
                            } else {
                                console.log("No entra al if");
                                console.log("i",this.i);
                                console.log("loop",this.loops);
                            }
                            i++;
                        }
                    },
                }
            }
        </script>
    </x-slot>
</x-dashboard-layout>
