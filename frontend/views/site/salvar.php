<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Agencia */

$this->title = 'BASE DE DATOS';
$this->params['breadcrumbs'][] = ['label' => 'BD', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> SALVAR BASE DE DATOS</h3>
            </div>
            <div class="panel-body">
                <div class="agencia-create">
                    <form action="<?= \Yii::$app->urlManager->createUrl(['site/salvarbd']); ?>" method="post">
                        <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
                        <div class="row">
                            <div class="col-md-8">
                                <b>Fecha </b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">date_range</i>
                                    </span>
                                    <div class="form-line">
                                        <input required="required" class="form-control" type="text" id="salvar" name="fechaslava" placeholder="Fecha">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn-success" style= 'height:32px;width:94%' id=""><i class="fa fa-save">  </i> SALVAR BD</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> CARGAR DASE DE DATOS</h3>
            </div>
            <div class="panel-body">
                <div class="agencia-create">
<!--<!             <form action="" method="post" enctype="multipart/form-data">-->
                    <form action="<?= \Yii::$app->urlManager->createUrl(['site/cargarbd']); ?>" method="post" >
                        <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
                        <div class="row">
                            <div class="col-md-8">
                                <b>Dirección</b>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">attach_file</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="file" name="archivo" required="required">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn-success" style= 'height:32px;width:94%' id="" data-confirm="Debe salvar la bd antes de cargar una version anterior"><i class="fa fa-plus">  </i> CARGAR BD</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>


