<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TrabFunciones */

$this->title = 'Create Trab Funciones';
$this->params['breadcrumbs'][] = ['label' => 'Trab Funciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trab-funciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
