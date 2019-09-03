<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">ADICIONAR USUARIO</h3>
    </div>
    <div class="panel-body">
        <div class="user-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
    </div>
</div>

