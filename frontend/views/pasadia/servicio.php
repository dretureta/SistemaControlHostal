<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\PasadiaServicio;
use frontend\models\Servicio;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'ADICIONAR SERVICIOS AL PASADIA';
$this->params['breadcrumbs'][] = ['label' => 'PASADIA', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//$fe_sa = explode('-', $fecha_sal);
//$model->fecha_salida = $fe_sa[2] . '-' . $fe_sa[1] . '-' . $fe_sa[0];

$pasadia = new PasadiaServicio();
$serv = new Servicio;
?>




<div class="row">
    <div class="col-md-6">


        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title"><i class="fa fa-plus"></i> ADICIONAR SERVICIO </h6>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                        <?php
                        $form = ActiveForm::begin([
                                    'method' => 'post',
                                    'id' => 'validar_pasadia',
                                    'action' => ['pasadia/add']]);
                        ?>

                        <div class="row">
                            <div class="col-md-12 hidden">
                                <?= $form->field($pasadia, 'pasadia')->textInput(['maxlength' => true, 'class' => 'form-control', 'value' => $model->id, 'name' => 'id_pasadia', 'id' => 'id_pasadia']) ?>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-md-6">
                                <b>Servicios</b>

                                <div class="form-group form-float input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">settings</i>
                                    </span>
                                    <div class="form-line">
                                        <select id="pasadia_servicio" class="form-control" name="pasadia_servicio" required="" aria-required="true">
                                            <option value="">Seleccione Servicio</option>
                                            <?php
                                            $servicio = Servicio::find()->orderBy("prioridad asc")->all();
                                            for ($i = 0; $i < count($servicio); $i++) {
                                                ?>
                                                <option value="<?php echo $servicio[$i]->id ?>"><?php echo $servicio[$i]->nombre ?></option>
                                            <?php }
                                            ?>
                                        </select>                                                  
                                    </div>
                                </div>              

                            </div>

                            <div class="col-md-6" >
                                <b>Subservicios</b>
                                <div class="form-group form-float input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">settings</i>
                                    </span>
                                    <div class="form-line" id="subadd">
                                        <input type="text" class="form-control" id="pasadia_sub" name="pasadia_sub" required="" aria-required="true" placeholder="Elija primero un servicio">                                        
                                    </div>
                                </div>        
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <b>Precio</b>
                                <div class="form-group form-float input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">monetization_on</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="pasadia_impb" name="pasadia_impb" required="" aria-required="true" disabled="true">                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>Cantidad</b>
                                <div class="form-group form-float input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">add_circle</i>
                                    </span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="pasadia_cant" name="pasadia_cant" required="" aria-required="true">                                        
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <b>No Incluir en Factura</b><br><br>
                                <div class="switch">
                                    <label><input value="1" name="pasa_incl" id="pasa_incl" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <b>No Incluir en los Ingresos</b><br><br>
                                <div class="switch">
                                    <label><input value="1" name="pasa_ingreso" id="pasa_incl" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn-success" style= 'height:32px;width: 100%'><i class="fa fa-plus">  </i> ADICIONAR</button>
                                </div>
                            </div>
                            <div class="col-md-2">

                            </div>

                            <div class="col-md-4" style="margin-top: 0.8em">
                                <a href="<?= \Yii::$app->urlManager->createUrl(['pasadia/index', 'style' => 'height: 40px;width: 100%;']); ?>" class="btn btn-danger text-center" style="height: 35px;width: 100%"><i class="fa fa-arrow-circle-left">  </i><b> TERMINAR</b></a>

                            </div>
                        </div>


                        <?php ActiveForm::end(); ?>
                    </div>
                </div> 
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?= $model->nombre ?></h3>
            </div>
            <div class="panel-body" style="width: 100%;height: 575px;">
                <div class="agencia-create">

                    <style>
                        .wrap table {
                            width: 100%;
                            table-layout: fixed;
                        }

                        .inner_table {
                            height: 440px;
                            overflow-y: auto;
                        }
                    </style>

                    <div class="wrap">

                        <table class="head" border="0" width="230px">
                            <tr style="background-color:#337ab7;color: white;height: 35px"> 
                                <th width="100px"><b style="margin-left: 1em">SERVICIO</b></th>
                                <th width="41px" style="text-align: center">CANTIDAD</th>
                                <th width="34px" style="text-align: center">PRECIO</th>
                                <th width="50px" style="text-align: center">IMPORTE</th>
                            </tr> 
                        </table>

                        <div class="inner_table">
                            <table  class="table table-striped table-bordered" id="" >
<!--                            <thead class="bg-primary">
                                <tr>
                                    <th width="105px">SERVICIO</th>
                                    <th width="40px" >CANTIDAD</th>
                                    <th width="40px">PRECIO</th>
                                    <th width="45px">IMPORTE</th>
                                </tr>
                            </thead>-->
                                <tbody>
                                    <?php
                                    $id_pasadia = $model->id;
                                    $cont = 0;
                                    $imp = 0;
                                    $resultado = array();
                                    $connection = \Yii::$app->db;
                                    $connection->open();

                                    $command = $connection->createCommand('select servicio.id,servicio.nombre FROM servicio,subservicios,pasadia_servicio,pasadia where servicio.id=subservicios.servicio and subservicios.id=pasadia_servicio.servicio and  pasadia_servicio.pasadia=pasadia.id and pasadia.id=:pasa and (pasadia_servicio.incluir=0 or pasadia_servicio.incluir=2) GROUP BY servicio.nombre ORDER BY servicio.prioridad');
                                    $command->bindParam(':pasa', $id_pasadia);
                                    $result = $command->queryAll();

                                    for ($i = 0; $i < count($result); $i++) {
                                        $command1 = $connection->createCommand('select subservicios.nombre, SUM(pasadia_servicio.cant)as cant,pasadia_servicio.precio,SUM(pasadia_servicio.cant)*pasadia_servicio.precio as total  from subservicios,pasadia_servicio,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=pasadia_servicio.servicio and pasadia_servicio.pasadia=:pasa and (pasadia_servicio.incluir=0 or pasadia_servicio.incluir=2) GROUP BY pasadia_servicio.servicio,pasadia_servicio.precio ORDER BY subservicios.nombre');
                                        $command1->bindParam(':serv', $result[$i]['id']);
                                        $command1->bindParam(':pasa', $id_pasadia);
                                        $subservicios = $command1->queryAll();

                                        $resultado[$cont] = array(
                                            'desc' => '<h6>' . $result[$i]['nombre'] . '</h6>',
                                            'cant' => ' ',
                                            'precio' => ' ',
                                            'total' => ' '
                                        );
                                        $cont++;

                                        for ($k = 0; $k < count($subservicios); $k++) {
                                            $resultado[$cont] = array(
                                                'desc' => '<p style="margin-left: 1em">' . $subservicios[$k]['nombre'] . '</p>',
                                                'cant' => $subservicios[$k]['cant'],
                                                'precio' => $subservicios[$k]['precio'],
                                                'total' => $subservicios[$k]['total']
                                            );
                                            $cont++;
                                            $imp+=$subservicios[$k]['total'];
                                        }
                                    }

                                    $resultado[$cont] = array(
                                        'desc' => '',
                                        'cant' => '',
                                        'precio' => '<h6>TOTAL</h6>',
                                        'total' => '<h6>' . Yii::$app->formatter->asDecimal($imp, 2) . ' </h6>'
                                    );

                                    for ($i = 0; $i < count($resultado); $i++) {
                                        ?>
                                        <tr style="width: 230px">
                                            <td style="width: 110px"><?php echo $resultado[$i]['desc'] ?></td>
                                            <td style="width: 40px" class="text-center"><?php echo $resultado[$i]['cant'] ?></td>
                                            <td style="width: 40px" class="text-center"><?php echo $resultado[$i]['precio'] ?></td>
                                            <td style="width: 45px" class="text-center"><?php echo $resultado[$i]['total'] ?></td>
                                        </tr>


                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>



                    </div>





                </div>
                <br>
                <div class="row">
                    <div class="col-md-2 text-right" >
                        <b>Ingles</b><br>
                        <div class="switch">
                            <label><input name="ingles_pasa" id="ingles_pasa" type="checkbox"><span class="lever switch-col-indigo"></span></label>

                        </div>
                    </div>
                    <div class="col-md-2 text-center" >
                        <b>Frances</b><br>
                        <div class="switch">
                            <label><input name="frances_pasa" id="frances_pasa" type="checkbox"><span class="lever switch-col-indigo"></span></label>
                        </div>
                    </div>

                    <div class="col-md-3  text-center" >
                        <p><a class="btn btn-primary" href="javascript:imprSelecPasa('Imprime')" >IMPRIMIR</a></p>

                    </div>

                    <div class="col-md-2  text-left" >
                        <p><a href="<?= \Yii::$app->urlManager->createUrl(['pasadia/info', 'id' => $model->id]); ?>" class="btn btn-primary">INFO</a></p>
                    </div>

                </div>



            </div>
        </div>



    </div>

</div>


<style type="text/css" media="print">
    .Imprime {
        height: auto;
        width: 210px;
        margin: 0px;
        padding: 0px;
        float: left;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 6px;
        font-style: normal;
        line-height: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        color: #000;
    }
    @page{
        margin: 0;
    }
</style>


<div class="row hidden ">

    <div class="col-md-4">

        <div id="imp_espanolpasa" class="Imprime">
            -------------------------------------------------------------------------------------
            <div style="margin-left:7em"><b style='font-size: 12px'>  HACIENDA "LA CASONA" </b></div>  
            -------------------------------------------------------------------------------------<br>

            <p style="margin-left: 0.1em">
                Cliente: <?php
                echo $model->nombre;
                $fe = explode('-', $model->fecha);
                $model->fecha = $fe[2] . '-' . $fe[1] . '-' . $fe[0]
                ?>  <br>
                Fecha : <?php echo $model->fecha ?><br>
            </p>

            <table  border='0'>
                <thead >
                    <tr>
                        <th width="120px" style="text-align: justify;text-decoration: underline;">SERVICIO</th>
                        <th width="30px" style="text-decoration: underline;">CANTIDAD</th>
                        <th style="margin-left:0.5em;text-decoration: underline;" width="30px">PRECIO</th>
                        <th width="30px" style="margin-left:0.5em;text-decoration: underline;">IMPORTE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 0;
                    $imp = 0;
                    $resultado = array();

                    $command = $connection->createCommand('select servicio.id,servicio.nombre as nombre FROM servicio,subservicios,pasadia_servicio,pasadia where servicio.id=subservicios.servicio and subservicios.id=pasadia_servicio.servicio and  pasadia_servicio.pasadia=pasadia.id and pasadia.id=:pasa and pasadia_servicio.incluir=0 GROUP BY servicio.nombre ORDER BY servicio.prioridad');
                    $command->bindParam(':pasa', $id_pasadia);
                    $result = $command->queryAll();

                    for ($i = 0; $i < count($result); $i++) {
                        $command1 = $connection->createCommand('select subservicios.nombre as nombre, SUM(pasadia_servicio.cant)as cant,pasadia_servicio.precio,SUM(pasadia_servicio.cant)*pasadia_servicio.precio as total  from subservicios,pasadia_servicio,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=pasadia_servicio.servicio and pasadia_servicio.pasadia=:pasa and pasadia_servicio.incluir=0 GROUP BY pasadia_servicio.servicio,pasadia_servicio.precio ORDER BY subservicios.nombre ');
                        $command1->bindParam(':serv', $result[$i]['id']);
                        $command1->bindParam(':pasa', $id_pasadia);
                        $subservicios = $command1->queryAll();

                        $resultado[$cont] = array(
                            'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify"> ' . $result[$i]['nombre'] . ' </b>
                                            </td>
                                        </tr>
                                    </table>',
                            'cant' => "",
                            'precio' => '',
                            'total' => ''
                        );
                        $cont++;

                        for ($k = 0; $k < count($subservicios); $k++) {
                            $resultado[$cont] = array(
                                'desc' => '<table  style="width: 120px;margin-left: -0.3em">
                                        <tr>
                                            <td style="width: 10px">

                                            </td>
                                            <td style="width: 110px">
                                                <p style="text-align: justify">' . $subservicios[$k]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                'cant' => '<p style="margin-left:2em">' . $subservicios[$k]['cant'] . '</p>',
                                'precio' => '<p style="margin-left:1em">' . $subservicios[$k]['precio'] . '</p>',
                                'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($subservicios[$k]['total'], 2) . '</p>'
                            );

                            $cont++;
                            $imp+=$subservicios[$k]['total'];
                        }
                    }

                    $resultado[$cont] = array(
                        'desc' => '',
                        'cant' => '<b style="margin-left:1em;text-decoration: underline">' . 'TOTAL' . '</b>',
                        'precio' => '<b style="margin-left:1em;text-decoration: underline">' . '(CUC)' . '</b>',
                        'total' => '<b style="margin-left:1em;text-decoration: underline">' . Yii::$app->formatter->asDecimal($imp, 2) . '</b>'
                    );

                    for ($i = 0; $i < count($resultado); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $resultado[$i]['desc'] ?></td>
                            <td><?php echo $resultado[$i]['cant'] ?></td>
                            <td><?php echo $resultado[$i]['precio'] ?></td>
                            <td><?php echo $resultado[$i]['total'] ?></td>
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
            <p style="margin-left:1.5em"><b style='font-size: 12px'>"El servicio esta incluido, mas, aceptamos propina"</b></p>
            <p style="margin-left:5.5em"><b style='font-size: 12px'>"GRACIAS POR VISITARNOS"</b></p>
        </div>
    </div>
    <div class="col-md-4">
        <div id="imp_inglespasa" class="Imprime">
            -------------------------------------------------------------------------------------
            <div style="margin-left:7em"><b style='font-size: 12px'>  HACIENDA "LA CASONA" </b></div>  
            -------------------------------------------------------------------------------------<br>
            <p style="margin-left: 0.1em">
                Client: <?php
                echo $model->nombre;
                ?>  <br>
                Date : <?php echo $model->fecha ?><br>
            </p>
            <table  border='0'>
                <thead >
                    <tr>
                        <th width="120px" style="text-align: justify;text-decoration: underline;">SERVICE</th>
                        <th width="30px" style="text-decoration: underline;">QUANTITY</th>
                        <th <th style="margin-left:0.5em;text-decoration: underline;" width="30px">PRICE</th>
                        <th width="30px" style="text-decoration: underline;margin-left:0.5em">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 0;
                    $imp = 0;
                    $resultado = array();

                    $command = $connection->createCommand('select servicio.id,servicio.ingles as nombre FROM servicio,subservicios,pasadia_servicio,pasadia where servicio.id=subservicios.servicio and subservicios.id=pasadia_servicio.servicio and  pasadia_servicio.pasadia=pasadia.id and pasadia.id=:pasa and pasadia_servicio.incluir=0 GROUP BY servicio.ingles ORDER BY servicio.prioridad');
                    $command->bindParam(':pasa', $id_pasadia);
                    $result = $command->queryAll();

                    for ($i = 0; $i < count($result); $i++) {
                        $command1 = $connection->createCommand('select subservicios.ingles as nombre, SUM(pasadia_servicio.cant)as cant,pasadia_servicio.precio,SUM(pasadia_servicio.cant)*pasadia_servicio.precio as total  from subservicios,pasadia_servicio,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=pasadia_servicio.servicio and pasadia_servicio.pasadia=:pasa and pasadia_servicio.incluir=0 GROUP BY pasadia_servicio.servicio,pasadia_servicio.precio ORDER BY subservicios.nombre ');
                        $command1->bindParam(':serv', $result[$i]['id']);
                        $command1->bindParam(':pasa', $id_pasadia);
                        $subservicios = $command1->queryAll();

                        $resultado[$cont] = array(
                            'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify"> ' . $result[$i]['nombre'] . ' </b>
                                            </td>
                                        </tr>
                                    </table>',
                            'cant' => "",
                            'precio' => '',
                            'total' => ''
                        );
                        $cont++;

                        for ($k = 0; $k < count($subservicios); $k++) {
                            $resultado[$cont] = array(
                                'desc' => '<table  style="width: 120px;margin-left: -0.3em">
                                        <tr>
                                            <td style="width: 10px">

                                            </td>
                                            <td style="width: 110px">
                                                <p style="text-align: justify">' . $subservicios[$k]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                'cant' => '<p style="margin-left:2em">' . $subservicios[$k]['cant'] . '</p>',
                                'precio' => '<p style="margin-left:1em">' . $subservicios[$k]['precio'] . '</p>',
                                'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($subservicios[$k]['total'], 2) . '</p>'
                            );

                            $cont++;
                            $imp+=$subservicios[$k]['total'];
                        }
                    }


                    $resultado[$cont] = array(
                        'desc' => '',
                        'cant' => '<b style="margin-left:1em;text-decoration: underline">' . 'TOTAL AMOUNT' . '</b>',
                        'precio' => '<b style="margin-left:1em;text-decoration: underline">' . '(CUC)' . '</b>',
                        'total' => '<b style="margin-left:1em;text-decoration: underline">' . Yii::$app->formatter->asDecimal($imp, 2) . '</b>'
                    );

                    for ($i = 0; $i < count($resultado); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $resultado[$i]['desc'] ?></td>
                            <td><?php echo $resultado[$i]['cant'] ?></td>
                            <td><?php echo $resultado[$i]['precio'] ?></td>
                            <td><?php echo $resultado[$i]['total'] ?></td>
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
            <p style="margin-left:2.5em"><b style="font-size: 12px; margin-left:2em">"Service is included but we accept tips"</b></p>
            <p style="margin-left:4em"><b style="font-size: 12px; margin-left:2em">"THANKS FOR VISITING US "</b></p>
        </div>
    </div>



    <div class="col-md-4">
        <div id="imp_francespasa" class="Imprime">
            -------------------------------------------------------------------------------------
            <div style="margin-left:7em"><b style='font-size: 12px'>  HACIENDA "LA CASONA" </b></div>  
            -------------------------------------------------------------------------------------<br>
            <p style="margin-left: 0.1em">
                Client: <?php
                echo $model->nombre;
                ?>  <br>
                Date : <?php echo $model->fecha ?><br>
            </p>


            <table  border='0'>
                <thead >
                    <tr>
                        <th width="120px" style="text-align: justify;text-decoration: underline;">SERVICE</th>
                        <th width="30px" style="text-decoration: underline;">QUANTITÉ</th>
                        <th style="text-decoration: underline;margin-left: 0.5em" width="30px">PRIX</th>
                        <th width="30px" style="text-decoration: underline;">MONTANT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cont = 0;
                    $imp = 0;
                    $resultado = array();

                    $command = $connection->createCommand('select servicio.id,servicio.frances as nombre FROM servicio,subservicios,pasadia_servicio,pasadia where servicio.id=subservicios.servicio and subservicios.id=pasadia_servicio.servicio and  pasadia_servicio.pasadia=pasadia.id and pasadia.id=:pasa and pasadia_servicio.incluir=0 GROUP BY servicio.frances ORDER BY servicio.prioridad');
                    $command->bindParam(':pasa', $id_pasadia);
                    $result = $command->queryAll();

                    for ($i = 0; $i < count($result); $i++) {
                        $command1 = $connection->createCommand('select subservicios.frances as nombre, SUM(pasadia_servicio.cant)as cant,pasadia_servicio.precio,SUM(pasadia_servicio.cant)*pasadia_servicio.precio as total  from subservicios,pasadia_servicio,servicio where servicio.id=:serv and subservicios.servicio=servicio.id and subservicios.id=pasadia_servicio.servicio and pasadia_servicio.pasadia=:pasa and pasadia_servicio.incluir=0 GROUP BY pasadia_servicio.servicio,pasadia_servicio.precio ORDER BY subservicios.nombre ');
                        $command1->bindParam(':serv', $result[$i]['id']);
                        $command1->bindParam(':pasa', $id_pasadia);
                        $subservicios = $command1->queryAll();


                        $resultado[$cont] = array(
                            'desc' => '<table  style="width: 120px;margin-left: -0.5em">
                                        <tr>
                                            <td style="width: 1px">

                                            </td>
                                            <td style="width: 119px">
                                                <b style="text-align: justify"> ' . $result[$i]['nombre'] . ' </b>
                                            </td>
                                        </tr>
                                    </table>',
                            'cant' => "",
                            'precio' => '',
                            'total' => ''
                        );
                        $cont++;

                        for ($k = 0; $k < count($subservicios); $k++) {
                            $resultado[$cont] = array(
                                'desc' => '<table  style="width: 120px;margin-left: -0.3em">
                                        <tr>
                                            <td style="width: 10px">

                                            </td>
                                            <td style="width: 110px">
                                                <p style="text-align: justify">' . $subservicios[$k]['nombre'] . '</p>
                                            </td>
                                        </tr>
                                    </table>',
                                'cant' => '<p style="margin-left:2em">' . $subservicios[$k]['cant'] . '</p>',
                                'precio' => '<p style="margin-left:1em">' . $subservicios[$k]['precio'] . '</p>',
                                'total' => '<p style="margin-left:1em">' . Yii::$app->formatter->asDecimal($subservicios[$k]['total'], 2) . '</p>'
                            );

                            $cont++;
                            $imp+=$subservicios[$k]['total'];
                        }
                    }

                    $resultado[$cont] = array(
                        'desc' => '',
                        'cant' => '<b style="text-decoration: underline;text-align: center">' . ' MONTANT TOTAL' . '</b>',
                        'precio' => '<b style="margin-left:1em;text-decoration: underline">' . '(CUC)' . '</b>',
                        'total' => '<b style="margin-left:1em;text-decoration: underline">' . Yii::$app->formatter->asDecimal($imp, 2) . '</b>'
                    );


                    for ($i = 0; $i < count($resultado); $i++) {
                        ?>
                        <tr>
                            <td><?php echo $resultado[$i]['desc'] ?></td>
                            <td><?php echo $resultado[$i]['cant'] ?></td>
                            <td><?php echo $resultado[$i]['precio'] ?></td>
                            <td><?php echo $resultado[$i]['total'] ?></td>
                        </tr>
                    <?php }
                    ?>

                </tbody>
            </table>
            <p style="margin-left:3.7em"><b style='font-size: 12px'>"Service inclus, mais acceptons pourboire"</b></p>
            <p style="margin-left:5.5em"><b style='font-size: 12px'>"MERCI DE VOTRE VISITE"</b></p>
        </div>
    </div>
</div>



</div>
</div>