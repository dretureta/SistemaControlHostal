<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Notificaciones */

$this->title = 'Create Notificaciones';
$this->params['breadcrumbs'][] = ['label' => 'Notificaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notificaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
