<?php
/* @var $this yii\web\View */

$this->title = 'SISTEMA';
?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Habitacion;
use frontend\assets\AppAsset;
//Estos use son los q t permiten incluir los ficheros js
use yii\web\View;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ReservacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CALENDARIO PASADIA';
$this->params['breadcrumbs'][] = $this->title;

$asset = AppAsset::register($this);

//Asi se incluyen ficheros js en una pagina
//$this->registerJsFile($asset->baseUrl . '/js/calendario/jquery-2.2.3.min.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile($asset->baseUrl . '/js/calendario/jquery-ui.min.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile($asset->baseUrl . '/js/calendario/jquery.slimscroll.min.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile($asset->baseUrl . '/js/calendario/fastclick.min.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile($asset->baseUrl . '/js/calendario/app.min.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile($asset->baseUrl . '/js/calendario/demo.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile($asset->baseUrl . '/js/calendario/moment.min.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile($asset->baseUrl . '/js/calendario/fullcalendar.min.js', ['depends' => [JqueryAsset::className()]]);
$this->registerJsFile($asset->baseUrl . '/js/calendario/script.js', ['depends' => [JqueryAsset::className()]]);



//$this->registerJsFile($asset->baseUrl . 'assets/uikit/js/components/sticky.js', ['depends' => [JqueryAsset::className()]]);
?>



<div class="row">
    <div class="col-md-12">
        <div class="hold-transition skin-blue sidebar-mini">


            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <!-- THE CALENDAR -->
                            <div id="calendar_pasa"></div>
                        </div>
                        <!-- /.box-body -->
                    </div>

                </div>
            </div>



        </div>
    </div>
</div>