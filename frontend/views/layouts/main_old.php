<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use frontend\models\Reservacion;
use frontend\models\Gastos;
use yii\helpers\ArrayHelper;
use frontend\models\Habitacion;
use yii\helpers\Url;
use frontend\models\Agencia;
use frontend\models\ReservacionServicios;
use frontend\models\Subservicios;
use frontend\models\Servicio;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script>
            var base_url_gastos = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/gastos'); ?>';
            var base_url_agencia = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/agencia'); ?>';
            var base_url_sub = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/subservicio'); ?>';
            var base_url_hab = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/hab'); ?>';
            var base_url_ocup = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/ocup'); ?>';
            var base_url_combo = '<?php echo Yii::$app->urlManager->createAbsoluteUrl('site/combo'); ?>';
        </script>



    </head>

    <?php
    $habi = Habitacion::find()
            ->innerJoin('ocupacion_hab', $on = 'habitacion.id=ocupacion_hab.hab')
            ->orderBy("nombre ASC")
            ->all();


    $fecha = "20" . date('y') . "-" . date('m');

    $sum_gastos = Gastos::find()->where(['like', 'fecha', $fecha])->all();
    $sum_ga = 0;
    for ($i = 0; $i < count($sum_gastos); $i++) {
        $sum_ga+=$sum_gastos[$i]->precio;
    }

    $sum_utilidad = ReservacionServicios::find()->where(['like', 'fecha', $fecha])->all();
    $sum_util = 0;
    for ($i = 0; $i < count($sum_utilidad); $i++) {
        $sum_util+=$sum_utilidad[$i]->precio * $sum_utilidad[$i]->cant;
    }




    /*$sum_reservacion = Reservacion::find()
            ->innerJoin('reservacion_hab', $on = 'reservacion.id=reservacion_hab.reservacion')
            ->where(['like', 'fecha_entrada', $fecha])
            ->all();
    print_r($sum_reservacion);die;*/


    $connection = \Yii::$app->db;
    $connection->open();
    /*  ESTA CONSULTA LE FALTA EL LIKE PARA Q SEA DEL MES EN CURSO 
        and reservacion.fecha_entrada like %:$fecha%    */
    $command = $connection->createCommand('SELECT reservacion.fecha_entrada,reservacion.fecha_salida,reservacion_hab.precio from reservacion,reservacion_hab where reservacion.id=reservacion_hab.reservacion');
    $command->bindParam(':fecha', $fecha);
    $list_res = $command->queryAll();
    
    //print_r($list_res);die;

     $sum_res = 0;
    for ($i = 0; $i < count($list_res); $i++) {

        $start_ts = strtotime($list_res[$i]['fecha_entrada']);
        $end_ts = strtotime($list_res[$i]['fecha_salida']);
        $diferencia = $end_ts - $start_ts;
        $dif_dias = round($diferencia / 86400);
        $sum_res+=$dif_dias * $list_res[$i]['precio'];
    }
    ?>

    <body >
    <?php $this->beginBody() ?>
<?php
NavBar::begin([
    'brandLabel' => 'SISTEMA',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
$menuItems = [
    ['label' => 'INICIO', 'url' => ['/site/index']],
    ['label' => 'RESERVACIÓN', 'url' => ['/reservacion/index']],
    ['label' => 'AUXILIARES', 'url' => ['/user/index'], 'items' => [
            ['label' => 'SERVICIOS', 'url' => ['/servicio/index']],
            ['label' => 'SUB SERVICIOS', 'url' => ['/subservicios/index']],
            ['label' => 'AGENCIA', 'url' => ['/agencia/index']],
            ['label' => 'HABITACIÓN', 'url' => ['/habitacion/index']],
            ['label' => 'OCUPACIÓN', 'url' => ['/ocupacion/index']],
            ['label' => 'OCUPACIÓN HAB', 'url' => ['/ocupacion-hab/index']],
            ['label' => 'GASTOS', 'url' => ['/gastos/index']],
        ]],
    ['label' => 'REPORTES', 'url' => ['/reservacion/reportes']],
//            ['label' => 'BASE DE DATOS', 'url' => ['/ocupacion/index']],
];
?>



    <body class="  ">
        <div class="bg-dark dk" id="wrap">
            <div id="top">

                <!-- .navbar -->
                <nav class="navbar navbar-inverse navbar-static-top">
                    <div class="container-fluid">

                        <!-- Brand and toggle get grouped for better mobile display -->

                        <!--                        <div class="topnav">
                                                    <div class="btn-group">
                                                        <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip" class="btn btn-default btn-sm" id="toggleFullScreen">
                                                            <i class="glyphicon glyphicon-fullscreen"></i>
                                                        </a> 
                                                    </div>
                                                    <div class="btn-group">
                                                        <a data-placement="bottom" data-original-title="E-mail" data-toggle="#myModal" class="btn btn-default btn-sm">
                                                            <i class="fa fa-envelope"></i>
                                                            <span class="label label-warning">5</span> 
                                                        </a> 
                                                        <a data-placement="bottom" data-original-title="Messages" href="#" data-toggle="tooltip" class="btn btn-default btn-sm">
                                                            <i class="fa fa-comments"></i>
                                                            <span class="label label-danger">4</span> 
                                                        </a> 
                                                        <a data-toggle="modal" data-original-title="Help" data-placement="bottom" class="btn btn-default btn-sm" href="#helpModal">
                                                            <i class="fa fa-question"></i>
                                                        </a> 
                                                    </div>
                                                    <div class="btn-group">
                                                        <a href="login.html" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                                                            <i class="fa fa-power-off"></i>
                                                        </a> 
                                                    </div>
                                                    <div class="btn-group">
                                                        <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                                                            <i class="fa fa-bars"></i>
                                                        </a> 
                                                        <a data-placement="bottom" data-original-title="Show / Hide Right" data-toggle="tooltip" class="btn btn-default btn-sm toggle-right"> <span class="glyphicon glyphicon-comment"></span>  </a> 
                                                    </div>
                                                </div>-->
                        <div class="collapse navbar-collapse navbar-ex1-collapse text-left">

<?php
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'items' => $menuItems,
]);
NavBar::end();
?>


                        </div>
                    </div><!-- /.container-fluid -->
                </nav><!-- /.navbar -->
                <header class="head">
                    <div class="search-bar">
                        <form class="main-search" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Live Search ...">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-sm text-muted" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span> 
                            </div>
                        </form><!-- /.main-search -->
                    </div><!-- /.search-bar -->
                    <div class="main-bar">

                    </div><!-- /.main-bar -->
                </header><!-- /.head -->

            </div>



            <div id="content " >
                <div class="outer ">
                    <div class="inner bg-light lter ">  
                        <div data-uk-sticky='{top:80}'>
                            <div class=" navbar-inverse">
                                <div class="row" data-uk-sticky='{top:80}'>



                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <ul class="stats_box">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <li>
                                                            <div class="sparkline pie_week"></div>
                                                            <div class="stat_text">
                                                                <strong ><label class="label-success" >$ <?php echo '  ' . $sum_util + $sum_res ?></label></strong> Utilidad                                                        
                                                                <span class="percent down label-success"> Neta: <?php echo $sum_util + $sum_res - $sum_ga ?></span> 
                                                            </div>
                                                            <span class="label label-success"><?php echo date('m') ?></span> 
                                                        </li>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <li>
                                                            <div class="sparkline stacked_month"></div>
                                                            <div class="stat_text">
                                                                <strong><label class="label-danger" >$<?php echo ' ' . $sum_ga ?></label></strong> Gastos
                                                                <span class="percent down label-danger"> Cant: <?php echo count($sum_gastos) ?></span> 

                                                            </div>
                                                            <span class="label label-danger"><?php echo date('m') ?></span>  
                                                        </li>

                                                    </div>
                                                </div>



                                            </ul>
                                        </div>
                                    </div>


                                    <div class="col-md-6 text-center">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <a class="quick-btn" href="#" data-toggle="modal" data-target="#indexreservacion">
                                                    <i class="fa fa-hotel fa-2x"></i>
                                                    <span>RESERVAR</span> 
                                                    <span class="label label-default"><?php echo date('m') ?></span> 
                                                </a> 
                                            </div>
                                            <div class="col-md-3">
                                                <a class="quick-btn" href="#" data-toggle="modal" data-target="#indexgastos">
                                                    <i class="fa fa-check fa-2x"></i>
                                                    <span>GASTOS</span> 
                                                    <span class="label label-danger"><?php echo date('m') ?></span> 
                                                </a> 
                                            </div>
                                            <div class="col-md-3">
                                                <a class="quick-btn" href="#" data-toggle="modal" data-target="#indexservicios">
                                                    <i class="fa fa-server fa-2x"></i>
                                                    <span>SERVICIOS</span> 
                                                </a> 
                                            </div>
                                            <div class="col-md-3">
                                                <a class="quick-btn" href="#" data-toggle="modal" data-target="#indexagencia">
                                                    <i class="fa fa-send fa-2x"></i>
                                                    <span>AGENCIA</span> 
                                                    <span class="label label-success"></span> 
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br> 

                            <div class="row " data-uk-sticky='{top:80}'>
<?php
$cont = 0;
for ($i = 0; $i < count($habi); $i++) {
    $cont++;
    ?>
                                    <div class="col-md-2"> 
                                        <div class="external-event bg-<?php echo $habi[$i]->color ?>"> <?php echo $habi[$i]->nombre ?> </div>
                                    </div>
    <?php
    if ($cont == 6) {
        $cont = 0;
        ?> 
                                        <br>
                                        <?php
                                    }
                                }
                                ?> 
                            </div>



                        </div>
<?=
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])
?>
                        <?= Alert::widget() ?>


                        <div class="row">
                            <div class="col-md-12">

<?= $content ?>

                            </div>
                        </div>


                    </div><!-- /.inner -->
                </div><!-- /.outer -->
            </div><!-- /#content -->

        </div><!-- /#wrap -->
        <div class="footer bg-dark dker text-center">
            <p>2016 @ SISTEMA DE RESERVAS</p>
        </div>





        <!--MODAL RESERVACION-->



        <div class="modal fade" id="indexreservacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <div class="row">
                            <!--<div class="text-center"><img width="90%"  src="/restaurante/frontend/web/img/2.jpg" /></div>--> 
                        </div>
                    </div>
                    <div class="modal-body">



                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"> <i class="fa fa-plus"> ADICIONAR RESERVA</i></h3>
                            </div>
                            <div class="panel-body">
                                <div class="agencia-create">
                                    <div id="respond">
<?php
$form = ActiveForm::begin(['id' => 'form-reserva',
            'method' => 'post',
            'action' => ['site/reservacion'],]);

$resindex = new Reservacion();
?> 

                                        <div class="row">
                                            <div class="col-md-12">                                                                                                            
                                                <p class="comment-form-author">
                                                    <label>Nombre</label>                
<?= $form->field($resindex, 'nombre_cliente')->textInput(['maxlength' => true, 'class' => 'form-control', 'style' => 'height: 50px;margin-top:-2.5em;width: 100%', 'aria-required' => 'true']) ?>
                                                </p>

                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-6">

<?php
echo $form->field($resindex, 'fecha_entrada')->widget(DatePicker::classname(), [
    'name' => 'fecha_ent',
    'value' => date('yyyy-mm-dd', strtotime('+0 days')),
    'options' => ['placeholder' => 'Fecha Entrada', 'style' => 'height: 45px;width: 100%;', 'aria-required' => 'true'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        'autoclose' => true
    ],
]);
?>
                                            </div>
                                            <div class="col-md-6">

<?php
echo $form->field($resindex, 'fecha_salida')->widget(DatePicker::classname(), [
    'name' => 'fecha_sal',
    'value' => date('yyyy-mm-dd', strtotime('+ days')),
    'options' => ['placeholder' => 'Fecha Salida', 'style' => 'height: 45px;width: 100%', 'aria-required' => 'true'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        'autoclose' => true
    ],
]);
?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
<?php
$hab = ArrayHelper::map(Habitacion::find()->orderBy('nombre ASC')->all(), 'id', 'nombre');
echo $form->field($resindex, 'nombre_cliente')->dropDownList(
        $hab, [
    'prompt' => 'Habitación',
    'style' => 'height: 50px;width: 100%',
    'aria-required' => 'true',
    'onchange' => '$.get( "' . Url::toRoute('dependencias/hab') . '", { id: $(this).val() } )
                                                        .done(function( data ) {
                               
                                                        var prueba = 0;
                                                        prueba = JSON.parse(data);                          
                               
                                                        document.getElementById("precioindex").value = prueba;                                
                                                        document.getElementById("precioindex").disabled = false;                                
                                                    }
                                                 );'
        ]
);
?>
                                            </div>
                                            <div class="col-md-4" style="margin-top: -2em">
                                                <p class="comment-form-author">
                                                    <label>Precio</label>                
<?= $form->field($resindex, 'nombre_cliente')->textInput(['maxlength' => true, 'class' => 'form-control', 'disabled' => 'true', 'id' => 'precioindex', 'style' => 'height: 50px;margin-top:-2.5em;width: 100%', 'aria-required' => 'true']) ?>
                                                </p>
                                            </div>

                                            <div class="col-md-4">
<?php
$agen = ArrayHelper::map(Agencia::find()->all(), 'id', 'nombre');
echo $form->field($resindex, 'agencia')->dropDownList(
        $agen, [
    'prompt' => 'Agencia',
    'style' => 'height: 50px;width: 100%',
    'aria-required' => 'true'
        ]
);
?>   
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-9" style="margin-top: -3em">
                                                <p class="comment-form-author">
                                                    <label>Observaciones</label>                
<?= $form->field($resindex, 'obs')->textarea(['maxlength' => true, 'class' => 'form-control', 'id' => 'obs', 'style' => 'height: 50px;margin-top:-2.5em;;width: 100%', 'aria-required' => 'true']) ?>
                                                </p>
                                            </div>
                                            <div class="col-md-3" style="margin-top: 1em">
                                                <div class="form-group">
<?= Html::submitButton('Adicionar', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'data-reservacion' => "availability"]) ?>
                                                </div>
                                            </div>
                                        </div>







<?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>






        <!--MODAL GASTOS-->


        <div class="modal fade" id="indexgastos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <div class="row">
                            <!--<div class="text-center"><img width="90%"  src="/restaurante/frontend/web/img/2.jpg" /></div>--> 
                        </div>
                    </div>
                    <div class="modal-body">


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-plus"> ADICIONAR GASTOS</i></h3>
                            </div>
                            <div class="panel-body">
                                <div class="agencia-create">
                                    <div id="respond">
<?php
$form2 = ActiveForm::begin();

$gastos = new Gastos();
?> 

                                        <div class="row">
                                            <div class="col-md-12">                                                                                                           
                                                <p class="comment-form-author" >
                                                    <label>Nombre</label>                
<?= $form2->field($gastos, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'style' => 'height: 50px;margin-top:-2.5em;width: 100%', 'aria-required' => 'true']) ?>
                                                </p>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4" style="margin-top: -2em">
                                                <p class="comment-form-author">
                                                    <label>Precio</label>                
<?= $form2->field($gastos, 'precio')->textInput(['maxlength' => true, 'class' => 'form-control', 'style' => 'height: 50px;margin-top:-2.5em;width: 100%', 'aria-required' => 'true', 'required' => 'required']) ?>
                                                </p>
                                            </div>

                                            <div class="col-md-5">
<?php
echo $form2->field($gastos, 'fecha')->widget(DatePicker::classname(), [
    'name' => 'fecha_sal',
    'value' => date('yyyy-mm-dd', strtotime('+ days')),
    'id' => 'fechagastos',
    'options' => ['placeholder' => 'Fecha', 'style' => 'height: 45px;width: 100%', 'aria-required' => 'true'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        'autoclose' => true
    ],
]);
?>
                                            </div>

                                            <div class="col-md-3">

                                                <br style="margin-top: 0.3em">
                                                <a data-gastos="availability" id="availability" class="btn btn-success bt-xs"><i class="fa fa-plus"></i> Adicionar </a>

                                            </div>
                                        </div>
<?php ActiveForm::end(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>                        

                    </div>

                </div>
            </div>
        </div>




        <!--MODAL AGENCIA-->

        <div class="modal fade" id="indexagencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <div class="row">
                            <!--<div class="text-center"><img width="90%"  src="/restaurante/frontend/web/img/2.jpg" /></div>--> 
                        </div>
                    </div>
                    <div class="modal-body">


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-plus"> ADICIONAR AGENCIA</i></h3>
                            </div>
                            <div class="panel-body">
                                <div class="agencia-create">
<?php
$form1 = ActiveForm::begin();

$agencia = new Agencia();
?> 
                                    <div id="respond">
                                        <div class="row">
                                            <div class="col-md-9"> 
                                                <p class="comment-form-author" >
                                                    <label>Nombre</label>                
<?= $form1->field($agencia, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'style' => 'height: 50px;margin-top:-2.5em;;width: 100%', 'aria-required' => 'true']) ?>
                                                </p>

                                            </div>                                        

                                            <div class="col-md-3">

                                                <br style="margin-top: 2.5em">
                                                <a data-agencias="availability" id="availability" class="btn btn-success bt-xs"><i class="fa fa-plus"></i> Adicionar </a>
                                            </div>
                                        </div>
                                    </div>
<?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>                        

                    </div>

                </div>
            </div>
        </div>



        <!--MODAL SERVICIOS-->

        <div class="modal fade" id="indexservicios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <div class="row">
                            <!--<div class="text-center"><img width="90%"  src="/restaurante/frontend/web/img/2.jpg" /></div>--> 
                        </div>
                    </div>
                    <div class="modal-body">


                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-plus"> ADICIONAR SUBSERVICIOS</i></h3>
                            </div>
                            <div class="panel-body">
                                <div class="agencia-create">
<?php
$form3 = ActiveForm::begin();

$sub = new Subservicios();
?> 
                                    <div id="respond">
                                        <div class="row">
                                            <div class="col-md-12">                                                                                                           
<?php
$serv = ArrayHelper::map(Servicio::find()->all(), 'id', 'nombre');
echo $form3->field($sub, 'servicio')->dropDownList(
        $serv, [
    'prompt' => 'Seleccione un servicio',
    'style' => 'height: 50px;width: 100%',
    'aria-required' => 'true'
        ]
);
?>
                                            </div>
                                        </div>


                                        <div class="row" >
                                            <div class="col-md-5" style="margin-top: -2.5em">
                                                <p class="comment-form-author" >
                                                    <label>Nombre</label>                
<?= $form3->field($sub, 'nombre')->textInput(['maxlength' => true, 'class' => 'form-control', 'style' => 'height: 50px;margin-top:-2.5em;;width: 100%', 'aria-required' => 'true']) ?>
                                                </p>
                                            </div>
                                            <div class="col-md-4" style="margin-top: -2.5em">                                                
                                                <p class="comment-form-author" >
                                                    <label>Precio</label>                
<?= $form3->field($sub, 'precio')->textInput(['maxlength' => true, 'class' => 'form-control', 'style' => 'height: 50px;margin-top:-2.5em;;width: 100%', 'aria-required' => 'true']) ?>
                                                </p>
                                            </div>
                                            <div class="col-md-3">
                                                <br style="margin-top: -3em">
                                                <a data-sub="availability" id="availability" class="btn btn-success bt-xs"><i class="fa fa-plus"></i> Adicionar </a>

                                            </div>
                                        </div>
                                    </div>
<?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>                        

                    </div>

                </div>
            </div>
        </div>






<?php $this->endBody() ?>

    </body> 



</html>
<?php $this->endPage() ?>

<?php
$men_res = 0;

if (isset($_GET['men_res'])) {
    $men_res = $_GET['men_res'];
    if ($men_res == 0) {
        ?>
        <script type="text/javascript">
            UIkit.notify('<i class="fa fa-success"></i><strong> Info!</strong> La habitacion ya esta reservada', {timeout: 0, status: 'warning', pos: 'bottom-right'});
        </script>
        <?php
        header('location:index.php?men_res=0');
    } if ($men_res == 1) {
        ?>
        <script type="text/javascript">
            UIkit.notify('<i class="fa fa-success"></i><strong> Info!</strong> Se ha creado la reserva correctamente', {timeout: 0, status: 'warning', pos: 'bottom-right'});
        </script>
        <?php
    }
    if ($men_res == 2) {
        ?>
        <script type="text/javascript">
            UIkit.notify('<i class="fa fa-success"></i><strong> Info!</strong> La fecha de entrada no puede ser mayor que la salida', {timeout: 0, status: 'warning', pos: 'bottom-right'});
        </script>
        <?php
    }
}
?>







