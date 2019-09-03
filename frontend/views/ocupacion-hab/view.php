<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\OcupacionHab */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ocupacion Habs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ocupacion-hab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ocupacion',
            'hab',
            'precio',
        ],
    ]) ?>

</div>
