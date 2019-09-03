<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReservacionServiciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservacion Servicios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservacion-servicios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reservacion Servicios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'reservacion',
            'servicio',
            'cant',
            'precio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
