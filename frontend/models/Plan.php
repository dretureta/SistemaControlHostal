<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property Reservacion[] $reservacions
 */
class Plan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
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
            'nombre' => 'Nombre',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacions()
    {
        return $this->hasMany(Reservacion::className(), ['plan' => 'id']);
    }
}
