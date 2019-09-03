<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\DptoFuncionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dpto Funciones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dpto-funciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dpto Funciones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dpto',
            'func',
            'precio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
