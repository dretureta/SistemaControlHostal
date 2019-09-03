<?php

use yii\helpers\Html;
use frontend\assets\AppAsset; 



/* @var $this yii\web\View */
/* @var $model frontend\models\Habitacion */

$this->title = 'CREAR HABITACIÓN';
$this->params['breadcrumbs'][] = ['label' => 'HABITACIÓN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



$asset = AppAsset::register($this);



?>


<div class="panel panel-default" style="margin-top: -1em">
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







