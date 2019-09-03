<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "agencia".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $pago
 *
 * @property Reservacion[] $reservacions
 */
class Agencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'agencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required','message'=>'Este campo no puede estar en blanco.'],
            ['nombre', 'unique', 'targetClass' => '\frontend\models\Agencia', 'message' => 'Este nombre debe ser único.'],
            [['nombre'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => '',
            'pago' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacions()
    {
        return $this->hasMany(Reservacion::className(), ['agencia' => 'id']);
    }
}
