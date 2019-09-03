<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\ReservacionServicios */

$this->title = 'Create Reservacion Servicios';
$this->params['breadcrumbs'][] = ['label' => 'Reservacion Servicios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservacion-servicios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
