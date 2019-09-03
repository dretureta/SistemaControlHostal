<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Subservicios */

$this->title = 'CREAR SUB SERVICIOS';
$this->params['breadcrumbs'][] = ['label' => 'SUB SERVICIOS', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">

        <div class="habitacion-create">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>

        </div>


    </div>
</div>
