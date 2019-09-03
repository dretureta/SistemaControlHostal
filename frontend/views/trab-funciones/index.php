<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TrabFuncionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trab Funciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trab-funciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Trab Funciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'trab',
            'func',
            'cantidad',
            'precio',
            // 'estado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
