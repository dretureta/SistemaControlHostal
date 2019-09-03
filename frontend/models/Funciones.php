<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "funciones".
 *
 * @property integer $id
 * @property string $nombre
 * @property double $precio
 *
 * @property TrabFunciones[] $trabFunciones
 */
class Funciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'precio'], 'required'],
            [['precio'], 'number'],
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
            'precio' => 'Precio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabFunciones()
    {
        return $this->hasMany(TrabFunciones::className(), ['func' => 'id']);
    }
}
