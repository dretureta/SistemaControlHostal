<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\DptoFunciones */

$this->title = 'Create Dpto Funciones';
$this->params['breadcrumbs'][] = ['label' => 'Dpto Funciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dpto-funciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
