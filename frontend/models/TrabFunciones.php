<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trab_funciones".
 *
 * @property integer $id
 * @property integer $trab
 * @property integer $func
 * @property integer $cantidad
 * @property double $precio
 * @property integer $estado  
 * @property string $fecha
 *
 * @property Funciones $func0
 * @property Trabajador $trab0
 */
class TrabFunciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trab_funciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trab', 'func', 'cantidad', 'precio', 'estado','fecha'], 'required'],
            [['trab', 'func', 'cantidad', 'estado'], 'integer'],
            [['precio'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trab' => 'Trab',
            'func' => 'Func',
            'cantidad' => 'Cantidad',
            'precio' => 'Precio',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFunc0()
    {
        return $this->hasOne(Funciones::className(), ['id' => 'func']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrab0()
    {
        return $this->hasOne(Trabajador::className(), ['id' => 'trab']);
    }
}
