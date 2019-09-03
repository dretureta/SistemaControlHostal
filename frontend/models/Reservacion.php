<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reservacion".
 *
 * @property integer $id
 * @property string $nombre_cliente
 * @property string $fecha_entrada
 * @property string $fecha_salida
 * @property integer $agencia
 * @property integer $estado
 * @property string $obs
 * @property integer $conjunto
 * @property string $codigo
 * @property integer $plan
 * @property integer $canthab
 *
 * @property Agencia $agencia0
 * @property Plan $plan0
 * @property ReservacionHab[] $reservacionHabs
 * @property ReservacionServicios[] $reservacionServicios
 */
class Reservacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reservacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_cliente', 'fecha_entrada', 'fecha_salida', 'agencia', 'estado', 'plan'], 'required'],
            [['fecha_entrada', 'fecha_salida'], 'safe'],
            [['agencia', 'estado', 'conjunto', 'plan','canthab'], 'integer'],
            [['nombre_cliente', 'obs', 'codigo'], 'string', 'max' => 255]
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
            'fecha_entrada' => 'Fecha Entrada',
            'fecha_salida' => 'Fecha Salida',
            'agencia' => 'Agencia',
            'estado' => 'Estado',
            'obs' => 'Obs',
            'conjunto' => 'Conjunto',
            'codigo' => 'Codigo',
            'plan' => 'Plan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAgencia0()
    {
        return $this->hasOne(Agencia::className(), ['id' => 'agencia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan0()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacionHabs()
    {
        return $this->hasMany(ReservacionHab::className(), ['reservacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacionServicios()
    {
        return $this->hasMany(ReservacionServicios::className(), ['reservacion' => 'id']);
    }
}
