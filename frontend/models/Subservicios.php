<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "subservicios".
 *
 * @property integer $id
 * @property integer $servicio
 * @property string $nombre
 * @property string $ingles
 * @property string $frances
 * @property double $precio
 *  @property integer $estado
 *
 * @property Servicio $servicio0
 */
class Subservicios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subservicios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['servicio', 'nombre','ingles','frances', 'precio'], 'required','message'=>'Este campo no puede estar en blanco.'],
            //['nombre', 'unique', 'targetClass' => '\frontend\models\Subservicios', 'message' => 'Este nombre debe ser único.'],
            [['servicio','estado'], 'integer','message'=>'Este campo no puede estar en blanco.'],
            [['precio'], 'double','message' => 'Este campo tiene que ser número'],
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
            'servicio' => '',
            'nombre' => '',
            'ingles' => '',
            'frances' => '',
            'precio' => '',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio0()
    {
        return $this->hasOne(Servicio::className(), ['id' => 'servicio']);
    }
}
