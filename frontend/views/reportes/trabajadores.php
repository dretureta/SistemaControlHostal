

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Trabajador;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */

$this->title = 'REPORTES DE TRABAJADORES';
$this->params['breadcrumbs'][] = ['label' => 'REPORTES', 'url' => ['trabajadores']];
$this->params['breadcrumbs'][] = $this->title;


$agencia = Trabajador::find()->orderBy("nombre")->all();
$mes = array();
$mes[count($mes)] = array('id' => '01', 'mes' => 'Enero');
$mes[count($mes)] = array('id' => '02', 'mes' => 'Febrero');
$mes[count($mes)] = array('id' => '03', 'mes' => 'Marzo');
$mes[count($mes)] = array('id' => '04', 'mes' => 'Abril');
$mes[count($mes)] = array('id' => '05', 'mes' => 'Mayo');
$mes[count($mes)] = array('id' => '06', 'mes' => 'Junio');
$mes[count($mes)] = array('id' => '07', 'mes' => 'Julio');
$mes[count($mes)] = array('id' => '08', 'mes' => 'Agosto');
$mes[count($mes)] = array('id' => '09', 'mes' => 'Septiembre');
$mes[count($mes)] = array('id' => '10', 'mes' => 'Octubre');
$mes[count($mes)] = array('id' => '11', 'mes' => 'Noviembre');
$mes[count($mes)] = array('id' => '12', 'mes' => 'Diciembre');
?>



<div class="panel panel-default">
    <div class="panel-heading">
       <h6 class="panel-title">BUSCAR TRABAJADORES </h6>
    </div>
    <div class="panel-body">
        <form method="post" id="repagencia_validar" action="<?= \Yii::$app->urlManager->createUrl(['reportes/infotrab']); ?>">
            <input type="hidden" name="_csrf" value="WUl1UFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">
            <div class="row">


                <div class="col-md-3">
                    <b>Fecha Inicial</b>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line">
                            <input type="text" id="rep_inicial" class="form-control" name="rep_inicial" placeholder="Fecha Inicial" value="" required="required">
                        </div>
                    </div>
                </div>


                <div class="col-md-5">
                    <b>Trabajadores</b>


                    <div class="form-group form-float input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">settings</i>
                        </span>
                        <div class="form-line">
                            <select id="rep_agencia" class="form-control" name="rep_agencia"  aria-required="true" >
                                <option value="">Seleccione Trabajadores</option>
                                <?php for ($i = 0; $i < count($agencia); $i++) { ?>
                                    <option value="<?php echo $agencia[$i]->id ?>"><?php echo $agencia[$i]->nombre ?></option> 
                                <?php }
                                ?>
                            </select>                                                  
                        </div>
                    </div>



                </div>




                <div class="col-md-2">  


                    <button class="btn-success" style= 'height:33px;width: 100%'><i class="fa fa-search">  </i> Buscar</button>  


                </div>
            </div>
        </form>

        <form method="post" id="exportarexcel" action="<?= \Yii::$app->urlManager->createUrl(['reportes/trab-excel']); ?>">
            <input type="hidden" name="_csrf" value="WUlQWFFidG8zHjkYHQkbBA8mPQBiIwA9OyAXYSsLDDhgBSInFRsYBQ==">

            <input type="hidden" id="mesexcel" name="mesexcel" value="<?= $meses ?>">
            <input type="hidden" id="agenciaexcel" name="trabexcel" value="<?= $trab ?>">            

            <button class="btn-primary" style= 'height:33px;width: 100%'><i class="fa fa-print">  </i> Exportar a Excel</button>
        </form>
    </div>
</div>




<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bed fa-2x"></i>  </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!-- Nav tabs -->

                <table  class="table table-striped table-bordered" id="traba">

                    <thead class="bg-primary">
                        <tr>
                            <th class="">NOMBRE</th>
                            <th class="text-center">DEPARTAMENTO</th>
                            <th class="text-center">SALARIO DEL MES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $suma=0;
                        for ($i = 0; $i < count($trabajador); $i++) {
                            $suma+=$trabajador[$i]['salario'];
                            ?>
                            <tr>
                                <th class=""><?php echo $trabajador[$i]['nombre']?></th>
                                <th class="text-center"><?php echo $trabajador[$i]['dpto']?></th>
                                <th class="text-center"><?php echo Yii::$app->formatter->asDecimal($trabajador[$i]['salario'], 2)?></th>
                            </tr>
                        <?php }
                        ?>
                            <tr>
                                <th class=""></th>
                                <th class="text-center"><b>TOTAL</b></th>
                                <th class="text-center"><b><?php echo Yii::$app->formatter->asDecimal($suma, 2)?></b></th>
                            </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>







