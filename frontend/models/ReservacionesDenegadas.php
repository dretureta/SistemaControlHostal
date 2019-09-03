<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reservaciones_denegadas".
 *
 * @property integer $id
 * @property string $nombre_cliente
 * @property string $fecha_solicitud
 * @property string $fecha_entrada
 * @property string $fecha_salida
 * @property integer $simple
 * @property integer $doble
 * @property integer $twins
 * @property integer $triple
 * @property integer $agencia
 * @property string $obs
 *
 * @property Agencia $agencia0
 */
class ReservacionesDenegadas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservaciones_denegadas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_cliente', 'fecha_solicitud', 'fecha_entrada', 'fecha_salida', 'agencia'], 'required'],
            [['fecha_solicitud', 'fecha_entrada', 'fecha_salida'], 'safe'],
            [['simple', 'doble', 'twins', 'triple', 'agencia'], 'integer'],
            [['nombre_cliente', 'obs'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_cliente' => 'Nombre Cliente',
            'fecha_solicitud' => 'Fecha Solicitud',
            'fecha_entrada' => 'Fecha Entrada',
            'fecha_salida' => 'Fecha Salida',
            'simple' => 'Simple',
            'doble' => 'Doble',
            'twins' => 'Twins',
            'triple' => 'Triple',
            'agencia' => 'Agencia',
            'obs' => 'Obs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencia0()
    {
        return $this->hasOne(Agencia::className(), ['id' => 'agencia']);
    }
}
