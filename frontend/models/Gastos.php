<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "gastos".
 *
 * @property integer $id
 * @property string $nombre
 */
class Gastos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gastos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required','message'=>'Este campo no puede estar en blanco.'],
            ['nombre', 'unique', 'targetClass' => '\frontend\models\Gastos', 'message' => 'Este nombre debe ser único.'],
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
     * @inheritdoc
     * @return GastosQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GastosQuery(get_called_class());
    }
}
