<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ocupacion".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property OcupacionHab[] $ocupacionHabs
 * @property Reservacion[] $reservacions
 */
class Ocupacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ocupacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required','message'=>'Este campo no puede estar en blanco.'],
            ['nombre', 'unique', 'targetClass' => '\frontend\models\Ocupacion', 'message' => 'Este nombre debe ser único.'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOcupacionHabs()
    {
        return $this->hasMany(OcupacionHab::className(), ['ocupacion' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacions()
    {
        return $this->hasMany(Reservacion::className(), ['ocupacion' => 'id']);
    }
}
