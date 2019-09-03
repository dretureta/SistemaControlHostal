<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Agencia;
use frontend\models\ReservacionHab;
use frontend\models\Subservicios;
use frontend\models\Gastos;
use frontend\models\Servicio;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reservacion */

$this->title = 'REPORTES DE GASTOS';
$this->params['breadcrumbs'][] = ['label' => 'REPORTES', 'url' => ['gastos']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

include 'lib/PHPExcel.php';
include 'lib/PHPExcel/Writer/Excel2007.php';

$objPHPExcel = new PHPExcel();

define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

//$rutaExcel = 'D:/DOCUMENTOS KENIA/ALQUILER/REPORTE SISTEMA/Gastos.xlsx';
$rutaExcel = '//reservas/D/DOCUMENTOS KENIA/ALQUILER/REPORTE SISTEMA/Gastos'." ".date("d-m-Y").'.xlsx';
//$rutaExcel = 'E:/Gastos.xlsx';
// Set document properties

$objPHPExcel->getProperties()->setCreator("Sistema de Reservas")
        ->setLastModifiedBy("Sistema de Reservas")
        ->setTitle("Generated by Sistema de Reservas v1.0")
        ->setSubject("Office 2007 XLSX Test Document")
        ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
        ->setKeywords("office 2007 openxml php")
        ->setCategory("Test result file");

// Create a first sheet, representing sales data

$fecha = explode("-", $entrada);
$entrada = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

$fecha = explode("-", $salida);
$salida = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

$imp_gastos = 0;

if ($id_gastos != '') {
    $nom = Gastos::findAll(['id' => $id_gastos]);
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'GASTOS DE' . $nom[0]->nombre);
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'FECHA INICIAL: ' . $entrada);
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'FECHA FINAL: ' . $salida);
    $objPHPExcel->getActiveSheet()->getStyle('F1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);

    $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Fecha');
    $objPHPExcel->getActiveSheet()->setCellValue('B3', 'U/M');
    $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Cantidad');
    $objPHPExcel->getActiveSheet()->setCellValue('D3', 'Importe');

    $row = 4;

//echo count($alojamientos); die;
    for ($i = 0; $i < count($gastos); $i++) {

        $nom = frontend\models\Unidad::findAll(['id' => $gastos[$i]['unidad']]);

        $fecha = explode('-', $gastos[$i]['fecha']);
        $entrada = $fecha[2] . '-' . $fecha[1] . '-' . $fecha[0];

        $dpto = frontend\models\Dpto::find()->where(['gastos' => $gastos[$i]['gastos']])->all();
        if (count($dpto) != 0) {
            $nom[0]->nombre = 'PAGO';
        }

        $imp_gastos+=Yii::$app->formatter->asDecimal($gastos[$i]['importe'], 2);

        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $entrada);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $nom[0]->nombre);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $gastos[$i]['cant']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, Yii::$app->formatter->asDecimal($gastos[$i]['importe'], 2));
        $row++;
    }
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "");
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, "");
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, "TOTAL");
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $imp_gastos);
    $row++;
} else {
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'GASTOS');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'FECHA INICIAL: ' . $entrada);
    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'FECHA FINAL: ' . $salida);
    $objPHPExcel->getActiveSheet()->getStyle('F1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);

    $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Producto');
    $objPHPExcel->getActiveSheet()->setCellValue('B3', 'U/M');
    $objPHPExcel->getActiveSheet()->setCellValue('C3', 'Cantidad');
    $objPHPExcel->getActiveSheet()->setCellValue('D3', 'Importe');

    $row = 4;
    // print_r($gastos);die;
    for ($i = 0; $i < count($gastos); $i++) {

        $dpto = frontend\models\Dpto::find()->where(['gastos' => $gastos[$i]['gastos']])->all();
        if (count($dpto) != 0) {
            $gastos[$i]['unidad'] = 'PAGO';
        }

        $imp_gastos+=Yii::$app->formatter->asDecimal($gastos[$i]['imp'], 2);

        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $gastos[$i]['servicio']);
        $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $gastos[$i]['unidad']);
        $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $gastos[$i]['cant']);
        $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, Yii::$app->formatter->asDecimal($gastos[$i]['imp'], 2));

        $row++;
    }
    $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, "");
    $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, "");
    $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, "TOTAL");
    $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $imp_gastos);
    $row++;
}




//Header de la tabla habria que personalizarlo en depencia del reporte



/*
  $objPHPExcel->getActiveSheet()->setCellValue('H'.($row), 'Total excl.:');
  $objPHPExcel->getActiveSheet()->setCellValue('I'.($row), '=SUM(I4:I'.($row-1).')');

  $objPHPExcel->getActiveSheet()->setCellValue('H'.($row+1), 'VAT:');
  $objPHPExcel->getActiveSheet()->setCellValue('I'.($row+1), '=I'. ($row) .'*0.21');

  $objPHPExcel->getActiveSheet()->setCellValue('H'.($row+2), 'Total incl.:');
  $objPHPExcel->getActiveSheet()->setCellValue('I'.($row+2), '=I'.($row).'+I'.($row+1).'');
 */
// Protect cells

$objPHPExcel->getActiveSheet()->getProtection()->setSheet(false);    // Needs to be set to true in order to enable any worksheet protection!
$objPHPExcel->getActiveSheet()->protectCells('A3:D' . $row, 'PHPExcel');

// Set cell number formats

$objPHPExcel->getActiveSheet()->getStyle('I4:J' . ($row + 2))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

$objPHPExcel->getActiveSheet()->getStyle('D4:D' . ($row + 2))->getNumberFormat()->setFormatCode('#,##0.00');

// Set column widths

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

// Set fonts

$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setName('Candara');
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
$objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

$objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);
$objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->getColor()->setARGB(PHPExcel_Style_Color::COLOR_WHITE);

$objPHPExcel->getActiveSheet()->getStyle('D' . ($row + 2))->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('D' . ($row + 2))->getFont()->setBold(true);

// Set thin black border outline around column

$styleThinBlackBorderOutline = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('argb' => 'FF000000'),
        ),
    ),
);
$objPHPExcel->getActiveSheet()->getStyle('A4:D' . ($row - 1))->applyFromArray($styleThinBlackBorderOutline);

// Set thick brown border outline around "Total"
/*
  $styleThickBrownBorderOutline = array(
  'borders' => array(
  'outline' => array(
  'style' => PHPExcel_Style_Border::BORDER_THICK,
  'color' => array('argb' => 'FF993300'),
  ),
  ),
  );
  $objPHPExcel->getActiveSheet()->getStyle('H'.($row+2).':I'.($row+2))->applyFromArray($styleThickBrownBorderOutline);
 */
// Set fills

$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()->getStartColor()->setARGB('FF808080');

// Set style for header row using alternative method

$objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray(
        array(
            'font' => array(
                'bold' => true
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startcolor' => array(
                    'argb' => 'FFA0A0A0'
                ),
                'endcolor' => array(
                    'argb' => 'FFFFFFFF'
                )
            )
        )
);

$objPHPExcel->getActiveSheet()->getStyle('A3')->applyFromArray(
        array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
            'borders' => array(
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        )
);

$objPHPExcel->getActiveSheet()->getStyle('B3')->applyFromArray(
        array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        )
);

$objPHPExcel->getActiveSheet()->getStyle('D3')->applyFromArray(
        array(
            'borders' => array(
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        )
);

// Add a drawing to the worksheet

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath('./images/logo.png');
$objDrawing->setHeight(36);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Add a drawing to the worksheet

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Paid');
$objDrawing->setDescription('Paid');
$objDrawing->setPath('./images/paid.png');
$objDrawing->setCoordinates('F' . ($row + 2));
$objDrawing->setOffsetX(110);
$objDrawing->setRotation(25);
$objDrawing->getShadow()->setVisible(true);
$objDrawing->getShadow()->setDirection(45);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Set header and footer. When no different headers for odd/even are used, odd header is assumed.

$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BInvoice&RPrinted on &D');
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

// Set page orientation and size

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

// Rename first worksheet







$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save($rutaExcel);

echo ' <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                Se ha creado el Excel de Reporte Gastos en la siguiente Ruta <strong>' . $rutaExcel . '</strong><br>
                                <a style="color:white;" href="' . Yii::$app->urlManager->createAbsoluteUrl('reportes/gastos') . '"><strong>Volver a Resportes Gastos</strong></a>
                            </div> ', EOL;
?>