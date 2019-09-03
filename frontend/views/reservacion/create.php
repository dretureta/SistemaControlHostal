<?php

use yii\helpers\Html;
use frontend\models\Auxiliar;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */

$this->title = 'CREAR RESERVACIÓN';
$this->params['breadcrumbs'][] = ['label' => 'RESERVACIÓN', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$aux = null;

if (isset($_GET['id'])) {
    $aux = Auxiliar::findOne(Yii::$app->request->get('id'));
    Auxiliar::deleteAll(['id'=>$_GET['id']]);
}



?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"> <?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <div class="agencia-create">



<?=
$this->render('_form', [
    'model' => $model,
    'aux' => $aux,
])
?>

        </div>
    </div>
</div>
