<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "addgastos".
 *
 * @property integer $id
 * @property integer $nombre
 * @property integer $fecha_entrada
 * @property integer $fecha_salida
 * @property double $agencia
 * @property string $obs
 * @property string $codigo
 *
 * @property Gastos $agencia
 */
class Auxiliar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aux';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['fecha_entrada', 'fecha_salida'], 'safe'],
            [['agencia',], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '',
            'nombre' => '',
            'fecha_entrada' => '',
            'fecha_salida' => '',
            'agencia' => '',
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