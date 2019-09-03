<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Funciones */

$this->title = 'ACTUALIZAR FUNCIONES: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'FUNCIONES', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ACTUALIZAR';
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <div class="agencia-update">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>

        </div>
    </div>
</div>
