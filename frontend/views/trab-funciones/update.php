<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrabFunciones */

$this->title = 'Update Trab Funciones: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Trab Funciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="trab-funciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
