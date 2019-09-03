<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "addgastos".
 *
 * @property integer $id
 * @property integer $gastos
 * @property integer $unidad
 * @property double $cant
 * @property double $importe
 * @property string $fecha
 *
 * @property Gastos $gastos0
 * @property Unidad $unidad0
 */
class Addgastos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'addgastos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gastos', 'importe', 'fecha','cant','unidad'], 'required','message'=>'Este campo no puede estar en blanco.'],
            [['gastos','unidad'], 'integer','message'=>'Este campo no puede estar en blanco.'],
            [['importe','cant'], 'number'],
            [['fecha'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '',
            'gastos' => '',
            'cant' => '',
            'importe' => '',
            'fecha' => '',
            'unidad' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGastos0()
    {
        return $this->hasOne(Gastos::className(), ['id' => 'gastos']);
    }
    
       public function getUnidad0()
    {
        return $this->hasOne(Unidad::className(), ['id' => 'unidad']);
    }
}
