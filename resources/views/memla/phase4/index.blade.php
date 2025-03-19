<x-dashboard-layout>
    <!-- Index Post -->

    <div class="container max-w-7xl mx-auto mt-8">
        <div class="bg-gray-50" x-data="handler()">
            <div class="relative py-6 mt-6 overflow-hidden">
                <div class="px-4 mx-auto mt-6 max-w-7xl sm:mt-4 sm:px-6">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl md:text-4xl">
                            <span class="block text-memla-900">Algorithm application and validation</span>
                            <span class="block text-memla-800">Phase 4</span>
                        </h3>
                        <p class="max-w-md mx-auto mt-3 text-base text-gray-500 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl">
                            {{$laboratory_project->title}}
                        </p>
                    </div>
                </div>

                <div class="px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24">
                    <form class="space-y-6" action="#" method="POST">
                        <div class="px-4 py-5 bg-white shadow sm:rounded-lg sm:p-6">
                            <div class="flex items-center justify-center mb-2">
                                <h4 class="font-bold tracking-tight text-gray-900 text-1xl sm:text-1xl md:text-1xl">
                                    Select a classifier
                                </h4>
                            </div>
                            <div class="grid grid-cols-9 flex items-center justify-center">
                                <select
                                    class="col-start-2 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md hover:bg-memla-200{{-- --}} focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2"
                                    x-model="buttonActive">
                                    <option @click="buttonActive='',buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="" selected>Select a classifier</option>
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="regresion">Logistic Regression</option>
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="SVM">SVM (Support Vector Machine)</option>
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="decisionTrees">Decision Trees</option>
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="randomForest">Random Forest</option>
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="kNN">k-NN (K-Nearest Neighbors)</option>
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="naiveBayes">Naive Bayes</option>
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="neural">Neural Networks</option>
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="gradientBoosting">Gradient Boosting {{--(XGBoost, LightGBM, CatBoost)--}}</option>
                                </select>
                                {{--<span x-text="buttonActive"></span>--}}
                                <select
                                    :disabled="buttonActive == ''"
                                    x-show="buttonActive == 'regresion' || buttonActive == ''"
                                    class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2" :class="buttonActive==''?' text-memla-500':'hover:bg-memla-200'"
                                    x-model="buttonConfiguration">
                                    <option @click="buttonConfiguration='', TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="">Select a configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="logreg1">Small data set</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="logreg2">Large data set</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="logreg3">Multiclass problems</option>
                                </select>
                                <select
                                    x-show="buttonActive == 'SVM'"
                                    class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 hover:bg-memla-200"
                                    x-model="buttonConfiguration">
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="">Select a configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="linear">Linear kernel</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="rbf">Radial kernel (RBF)</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="poly">Polynomial kernel</option>
                                </select>
                                <select
                                    x-show="buttonActive == 'decisionTrees'"
                                    class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 hover:bg-memla-200"
                                    x-model="buttonConfiguration">
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="">Select a configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="gini">Basic with Gini</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="entropy">Pruning and entropy criterion</option>
                                        <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="randomized">Randomization and maximum depth</option>
                                </select>
                                <select
                                    x-show="buttonActive == 'randomForest'"
                                    class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 hover:bg-memla-200"
                                    x-model="buttonConfiguration">
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="">Select a configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="basic">Basic configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="large_trees">Adjusted depth</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="regularized">With regularization and more trees</option>
                                </select>
                                <select
                                    x-show="buttonActive == 'kNN'"
                                    class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 hover:bg-memla-200"
                                    x-model="buttonConfiguration">
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="">Select a configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="basic">Basic configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="distance_weights">distance-weighted</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="manhattan">With Manhattan Metric and Brute Force Search</option>
                                </select>
                                <select
                                    x-show="buttonActive == 'naiveBayes'"
                                    class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 hover:bg-memla-200"
                                    x-model="buttonConfiguration">
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="">Select a configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="gnb">For continuous features</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="mnb">For text data</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="bnb">For binary characteristics</option>
                                </select>
                                <select
                                    x-show="buttonActive == 'neural'"
                                    class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 hover:bg-memla-200"
                                    x-model="buttonConfiguration">
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="">Select a configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="basic">Basic setup with a hidden layer</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="multi_layer">With multiple hidden layers</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="dropout_sgd">With simulated dropout and stochastic gradient</option>
                                </select>
                                <select
                                    x-show="buttonActive == 'gradientBoosting'"
                                    class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 hover:bg-memla-200"
                                    x-model="buttonConfiguration">
                                    <option @click="buttonConfiguration='',TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="">Select a configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="basic">Basic configuration</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="high_estimators">Low learning rate</option>
                                    <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="aggressive">With a more aggressive approach</option>
                                </select>
                                {{--<span x-text="buttonConfiguration"></span>--}}
                            </div>
                            <div class="items-center justify-center md:grid md:grid-cols-3 md:gap-6 mt-2">
                                <div class="col-span-1 col-start-2 mt-2">
                                    <h4 class="font-bold tracking-tight text-center text-gray-900 text-1xl sm:text-1xl md:text-1xl">
                                        Select a preprocessed dataset
                                    </h4>
                                    <div class="flex items-center justify-center mt-1 rounded-md shadow-sm space-x-2">
                                        <select
                                            :disabled="buttonConfiguration ==''"
                                            class="col-start-6 col-span-3 px-6 py-3 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2"
                                            :class="buttonConfiguration==''?' text-memla-500':'hover:bg-memla-200'">
                                            <option @click="TestDT='',TrainingDT='',buttonTM='',buttonSM=''" value="" :selected="TestDT==''">Select a preprocessed dataset</option>
                                            <option @click="buttonTM='',buttonSM='',TestDT=pathDtTestTercios, TrainingDT=pathDtTrainingTercios, spliteType='tercios'" value="">2/3-1/3</option>
                                            <option @click="buttonTM='',buttonSM='',TestDT=pathDtTestRS, TrainingDT=pathDtTrainingRS, spliteType='RS'" value="">Representative sample</option>
                                            <option @click="buttonTM='',buttonSM='',TestDT=pathDtTestkFold, TrainingDT=pathDtTrainingkFold, spliteType='K-fold'" value="">K-fold</option>
                                        </select>
                                    </div>
                                    {{--<span x-text="TestDT"></span>
                                    <span x-text="TrainingDT"></span>--}}
                                </div>
                            </div>
                            <div class="items-center justify-center md:grid md:grid-cols-3 md:gap-6 mt-2">
                                <div class="col-span-1 col-start-2 mt-2">
                                    <h4 class="font-bold tracking-tight text-center text-gray-900 text-1xl sm:text-1xl md:text-1xl">
                                        Send request
                                    </h4>
                                    <div class="grid grid-cols-9 justify-center mt-2">
                                        <div class="col-start-2 rounded-md">
                                            <button
                                                :disabled="TestDT==''"
                                                x-on:click="buttonTM = 'Entrenando modelo', trainModel()"
                                                id = "train_model" name = "train_model" type="button"
                                                class="px-4 py-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 whitespace-nowrap"
                                                :class="TestDT==''?' text-memla-500':'hover:bg-memla-200'">Train model
                                            </button>
                                            {{--<span x-text="buttonTM"></span>--}}
                                        </div>
                                        <div class="col-start-6 rounded-md">
                                            <button
                                                :disabled="buttonTM==''"
                                                x-on:click="buttonSM = 'Guardando modelo', saveModel()"
                                                id = "save_model" name = "save_model" type="button"
                                                class="px-4 py-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2 whitespace-nowrap"
                                                :class="buttonTM==''?' text-memla-500':'hover:bg-memla-200'">Save model
                                            </button>
                                            {{--<span x-text="buttonSM"></span>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>







                <div class="py-3">
                    <div class="text-center">
                        <p class="text-base text-gray-500">Matriz de Confusión</p>
                        <div class="flex justify-center mt-6">
                            <table class="tabla-matriz-confusion">
                                <thead>
                                <tr>
                                    {{--<th>Real \\ Predicho</th>--}}
                                    <th>     </th>
                                    <template x-for="label in confusionMatrixLabels" :key="label">
                                        <th x-text="label"></th>
                                    </template>
                                </tr>
                                </thead>
                                <tbody>
                                <template x-for="(row, rowIndex) in confusionMatrix" :key="rowIndex">

                                    <tr>
                                        <th x-text="confusionMatrixLabels[rowIndex]"></th>
                                        <template x-for="(value, colIndex) in row" :key="colIndex">
                                            <td x-text="value"></td>
                                        </template>
                                    </tr>
                                </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="py-3">
                    <div class="text-center">
                        <p class="text-base text-gray-500">Métricas del Modelo</p>
                        <div class="flex justify-center mt-6">
                            <ul>
                                <li>Exactitud (Accuracy): <span x-text="accuracy + '%'"></span></li>
                                <li>Precisión (Precision): <span x-text="precision + '%'"></span></li>
                                <li>Recall: <span x-text="recall + '%'"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>






                <div class="py-16">
                    <div class="text-center">
                        <p class="mt-2 text-base text-gray-500">Confusion matrix</p>
                        <div class="flex justify-center mt-6">
                            <img class="" src="{{asset('img/template/cm.svg')}}" alt="">
                        </div>
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
                <div class="py-5 px-4 mx-auto mt-4 max-w-7xl sm:mt-2 sm:px-6 md:px-24">
                    <div class="sm:grid sm:grid-cols-12 sm:gap-4">
                        <div class="flex col-start-2 mt-2 ">
                            <a href="{{url('computational-environment',$id)}}/{{$rows}}" class="focus:outline-none">
                                <button type="submit" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2"   x-on:click="buttonActive = 'bayes'" :class="buttonActive=='bayes' ? 'bg-memla-300' : 'bg-memla-100'"><span> &larr; </span>  Previous Phase  </button>
                            </a>
                        </div>
                        <div class="flex col-start-9 mt-2 ">
                            <a href="{{url('knowledge-application',$id)}}/{{$rows}}" class="focus:outline-none">
                                <button type="submit" class="inline-flex items-center px-6 py-3 ml-2 mr-2 text-base font-medium text-memla-900 bg-memla-100 border border-transparent rounded-md hover:bg-memla-200 focus:outline-none focus:ring-2 focus:ring-memla-500 focus:ring-offset-2"   x-on:click="buttonActive = 'bayes'" :class="buttonActive=='bayes' ? 'bg-memla-300' : 'bg-memla-100'">Next Phase  <span> &rarr;</span></button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
        <script type="text/javascript">
            var pathDtTestTercios, pathDtTrainingTercios, pathDtTestRS, pathDtTrainingRS, pathDtTestkFold, pathDtTrainingkFold;

            pathDtTestTercios = '{{isset($datasets_type[0]->path)?$datasets_type[0]->path:''}}'
            pathDtTrainingTercios = '{{isset($datasets_type[1]->path)?$datasets_type[1]->path:''}}'
            pathDtTestRS = '{{isset($datasets_type[2]->path)?$datasets_type[2]->path:''}}'
            pathDtTrainingRS = '{{isset($datasets_type[3]->path)?$datasets_type[3]->path:''}}'
            pathDtTestkFold = '{{isset($datasets_type[4]->path)?$datasets_type[4]->path:''}}'
            pathDtTrainingkFold = '{{isset($datasets_type[5]->path)?$datasets_type[5]->path:''}}'

            @if($dataset)
                var pathDataset='{{asset('storage/'.$dataset->path)}}';
                var nameFile='{{isset($dataset->path)?$dataset->path:""}}';
            @endif()

            var rows = '{{$rows}}';
            var target = '{{$target}}';
            var features = {!! json_encode($features) !!};

            //console.log(window);

            function handler() {

                return {
                    rows : rows,
                    pathDtTestTercios: pathDtTestTercios,
                    pathDtTrainingTercios: pathDtTrainingTercios,
                    pathDtTestRS: pathDtTestRS,
                    pathDtTrainingRS: pathDtTrainingRS,
                    pathDtTestkFold: pathDtTestkFold,
                    pathDtTrainingkFold: pathDtTrainingkFold,
                    spliteType : '',
                    accuracy: 0,
                    precision: 0,
                    recall: 0 ,

                    resultTrain : "",
                    resultSave: "",
                    model : "",

                    buttonActive : "",
                    buttonConfiguration : "",
                    buttonDT : "",
                    TestDT : "",
                    TrainingDT : "",
                    buttonTM : "",
                    buttonSM : "",
                    vari: "",
                    laboratoryId : {{$id}} ? {{$id}} : 0,
                    target : target,
                    features : features,

                    isLoading:false,

                    errors:{
                        crossValidation:''
                    },

                    confusionMatrix: [],
                    confusionMatrixLabels: [],

                    async getFile(url) {
                        let response = await fetch(url)
                        this.isLoading=false;
                        return await response.json()
                    },

                    async trainModel(){
                        console.log("Algoritmo: "+this.buttonActive);  console.log("Configuracion: "+this.buttonConfiguration);  console.log("Test percentage: "+this.TestDT);    console.log("Training percentage: "+this.TrainingDT);

                        this.resultTrain = await this.getFile("{{route("train_model")}}"+"?algorithm="+this.buttonActive+"&configuration="+this.buttonConfiguration+"&test_dt="+this.TestDT+"&training_dt="+this.TrainingDT+"&laboratory_id="+this.laboratoryId+"&spliteType="+this.spliteType+"&target="+this.target+"&features="+this.features);
                        console.log(this.resultTrain);

                        this.confusionMatrix = this.resultTrain[0].matriz_confusion;
                        this.accuracy = this.resultTrain[0].accuracy;
                        this.precision = this.resultTrain[0].precision;
                        this.recall = this.resultTrain[0].recall;

                        // Generar etiquetas de clase
                        this.confusionMatrixLabels = [];
                        for (let i = 0; i < this.confusionMatrix.length; i++) {
                            this.confusionMatrixLabels.push(`Clase ${i}`);
                        }
                    },

                    async saveModel(){
                        this.resultSave = await this.getFile("{{route("save_model")}}"+"?pathTestid="+this.resultTrain[1].test_dataset_id+"&pathTrainingid="+this.resultTrain[1].training_dataset_id+"&modelTypeId="+this.resultTrain[1].model_type_id+"&modelPath="+this.resultTrain[1].model_path);
                        console.log(this.resultSave);
                    },

                    {{--Para "Guardar" el modelo ocupo recibir de la funcion de arriba la path del modelo y el id para buscarlo en la base de datos y restaurar el registro.--}}
                }
            }
        </script>
    </x-slot>

</x-dashboard-layout>
