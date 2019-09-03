<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    
        'assets/uikit/css/uikit.docs.min.css',
        'css/font-awesome/css/font-awesome.css',

        'css/uikitdocs.css',
        'assets/Responsive-Tabs/css/responsive-tabs.css',
        'assets/Responsive-Tabs/css/style.css',
        'assets/select2/dist/css/select2.css',


        'assets/BSBMaterialDesign/iconfont/material-icons.css',
        'assets/BSBMaterialDesign/plugins/node-waves/waves.css',
        'assets/BSBMaterialDesign/plugins/animate-css/animate.css',
        'assets/BSBMaterialDesign/css/style.css',
        'assets/BSBMaterialDesign/css/themes/all-themes.css',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css',

        'assets/BSBMaterialDesign/plugins/sweetalert/sweetalert.css',
        'assets/BSBMaterialDesign/plugins/waitme/waitMe.css',
        'assets/BSBMaterialDesign/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css',
       
        'css/calendario/AdminLTE.css',
	    'css/calendario/fullcalendar.min.css',

        'css/datetimepicker personalizado/datetimepicker.css',
        
    ];
    public $js = [

        'assets/uikit/js/uikit.min.js',
        'assets/uikit/js/core/modal.js',

        'assets/uikit/js/components/notify.js',

        'js/bootstrap-typeahead.js',




        'assets/Responsive-Tabs/js/jquery.responsiveTabs.js',
        'assets/select2/dist/js/select2.full.js',

        'assets/BSBMaterialDesign/plugins/jquery-slimscroll/jquery.slimscroll.js',
        'assets/BSBMaterialDesign/plugins/node-waves/waves.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/jquery.dataTables.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/extensions/export/buttons.flash.min.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/extensions/export/jszip.min.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/extensions/export/pdfmake.min.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/extensions/export/vfs_fonts.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/extensions/export/buttons.html5.min.js',
        'assets/BSBMaterialDesign/plugins/jquery-datatable/extensions/export/buttons.print.min.js',
    
        'assets/BSBMaterialDesign/plugins/jquery-validation/jquery.validate.js',
        'assets/BSBMaterialDesign/plugins/sweetalert/sweetalert.min.js',
        'assets/BSBMaterialDesign/plugins/waitme/waitMe.js',
        'assets/BSBMaterialDesign/plugins/autosize/autosize.js',
        'assets/BSBMaterialDesign/plugins/momentjs/moment-with-locales.min.js',
        'assets/BSBMaterialDesign/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js',
        'assets/BSBMaterialDesign/plugins/jquery-countto/jquery.countTo.js',
        'assets/BSBMaterialDesign/plugins/jquery-sparkline/jquery.sparkline.js',
        'assets/BSBMaterialDesign/js/admin.js',
        'assets/BSBMaterialDesign/js/demo.js',

        'js/datetimepicker personalizado/datetimepicker.js',

        'js/codes.js',
        

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapFontawesomeAsset',
    ];

}
