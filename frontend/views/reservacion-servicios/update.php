<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReservacionServicios */

$this->title = 'Update Reservacion Servicios: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reservacion Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reservacion-servicios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
