<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ocupacion_hab".
 *
 * @property integer $id
 * @property integer $ocupacion
 * @property integer $hab
 * @property double $precio
 *
 * @property Habitacion $hab0
 * @property Ocupacion $ocupacion0
 */
class OcupacionHab extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ocupacion_hab';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ocupacion', 'hab', 'precio'], 'required','message'=>'Este campo no puede estar en blanco.'],
            [['ocupacion', 'hab'], 'integer','message'=>'Este campo no puede estar en blanco.'],
            [['precio'], 'number','message' => 'Este campo tiene que ser número.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ocupacion' => '',
            'hab' => '',
            'precio' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHab0()
    {
        return $this->hasOne(Habitacion::className(), ['id' => 'hab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOcupacion0()
    {
        return $this->hasOne(Ocupacion::className(), ['id' => 'ocupacion']);
    }
}
