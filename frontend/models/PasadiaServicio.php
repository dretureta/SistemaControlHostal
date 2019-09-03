<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pasadia_servicio".
 *
 * @property integer $id
 * @property integer $pasadia
 * @property integer $servicio
 * @property integer $cant
 * @property double $precio
 * @property integer $incluir
 *
 * @property Pasadia $pasadia0
 * @property Subservicios $servicio0
 */
class PasadiaServicio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pasadia_servicio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pasadia', 'servicio', 'cant', 'precio'], 'required'],
            [['pasadia', 'servicio', 'cant'], 'integer'],
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
            'pasadia' => 'Pasadia',
            'servicio' => 'Servicio',
            'cant' => 'Cant',
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasadia0()
    {
        return $this->hasOne(Pasadia::className(), ['id' => 'pasadia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio0()
    {
        return $this->hasOne(Subservicios::className(), ['id' => 'servicio']);
    }
}
