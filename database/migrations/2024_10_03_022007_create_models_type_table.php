<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('models_type', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description');

            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('models_type')->insert([
            ['name'=>'regresion_logreg1', 'description' => 'Configuración básica para un conjunto de datos pequeño'],
            ['name'=>'regresion_logreg2', 'description' => 'Configuración para grandes conjuntos de datos'],
            ['name'=>'regresion_logreg3', 'description' => 'Configuración para problemas multiclase'],
            ['name'=>'SVM_linear', 'description' => 'Configuración básica con kernel lineal'],
            ['name'=>'SVM_rbf', 'description' => 'Configuración con kernel radial (RBF)'],
            ['name'=>'SVM_poly', 'description' => 'Configuración con kernel polinómico'],
            ['name'=>'decisionTrees_gini', 'description' => 'Configuración básica con Gini'],
            ['name'=>'decisionTrees_entropy', 'description' => 'Configuración con poda y criterio de entropía'],
            ['name'=>'decisionTrees_randomized', 'description' => 'Configuración con aleatorización y profundidad máxima'],
            ['name'=>'randomForest_basic', 'description' => 'Configuración básica'],
            ['name'=>'randomForest_large_trees', 'description' => 'Configuración con mayor número de árboles y profundidad ajustada'],
            ['name'=>'randomForest_regularized', 'description' => 'Configuración con regularización y más árboles'],
            ['name'=>'kNN_basic', 'description' => 'Configuración básica'],
            ['name'=>'kNN_distance_weights', 'description' => 'Configuración con ponderación por distancia'],
            ['name'=>'kNN_manhattan', 'description' => 'Configuración con métrica de Manhattan y búsqueda Brute Force'],
            ['name'=>'naiveBayes_gnb', 'description' => 'Gaussian Naive Bayes para características continuas'],
            ['name'=>'naiveBayes_mnb', 'description' => 'Multinomial Naive Bayes para datos de texto'],
            ['name'=>'naiveBayes_bnb', 'description' => 'Bernoulli Naive Bayes para características binarias'],
            ['name'=>'neural_basic', 'description' => 'Configuración básica con una capa oculta'],
            ['name'=>'neural_multi_layer', 'description' => 'Configuración con múltiples capas ocultas y tasa de aprendizaje adaptativa'],
            ['name'=>'neural_dropout_sgd', 'description' => 'Configuración con dropout simulado y gradiente estocástico (SGD)'],
            ['name'=>'gradientBoosting_basic', 'description' => 'Configuración básica'],
            ['name'=>'gradientBoosting_high_estimators', 'description' => 'Configuración con mayor número de árboles y baja tasa de aprendizaje'],
            ['name'=>'gradientBoosting_aggressive', 'description' => 'Configuración con un enfoque más agresivo'],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models_type');
    }
};
