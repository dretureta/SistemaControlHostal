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

$asset = AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>



        <!-- Bootstrap Core Css -->
        <link href="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/iconfont/material-icons.css'?>" rel="stylesheet">
        <!-- Bootstrap Core Css -->
        <link href="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/plugins/bootstrap/css/bootstrap.css'?>" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/plugins/node-waves/waves.css'?>" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/plugins/animate-css/animate.css'?>" rel="stylesheet" />

        <!-- Custom Css -->
        <link href="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/css/style.css'?>" rel="stylesheet">





    </head>









    <body class="login-page">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
            <div class="loader">
                <div class="preloader">
                    <div class="spinner-layer pl-red">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div>
                        <div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
                <p>Please wait...</p>
            </div>
        </div>
        <!-- #END# Page Loader -->


        <div class="login-box">
            <div class="logo">
                <a href="javascript:void(0);">Control de <b>Reservas</b></a>
                <small>Admin BootStrap Based - Material Design</small>
            </div>
            <div class="card">
                <div class="body">

                  <?= $content ?>

                    <form class="hidden" id="sign_in" method="POST">
                        <div class="msg">Sign in to start your session</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
                                <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-indigo">
                                <label for="rememberme">Remember Me</label>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-indigo waves-effect waves-light" type="submit"><i class="material-icons">done</i> SIGN IN </button>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b--20">
                            <div class="col-xs-6">
                                <a href="sign-up.html">Register Now!</a>
                            </div>
                            <div class="col-xs-6 align-right">
                                <a href="forgot-password.html">Forgot Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/plugins/jquery/jquery.min.js'?>"></script>

        <!-- Bootstrap Core Js -->
        <script src="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/plugins/bootstrap/js/bootstrap.js'?>"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/plugins/node-waves/waves.js'?>"></script>

        <!-- Validation Plugin Js -->
        <script src="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/plugins/jquery-validation/jquery.validate.js'?>"></script>

        <!-- Custom Js -->
        <script src="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/js/admin.js'?>"></script>
        <script src="<?= $asset->baseUrl . '/assets/BSBMaterialDesign/js/pages/examples/sign-in.js'?>"></script>
    </body>



</body>


</html>
<?php $this->endPage() ?>
