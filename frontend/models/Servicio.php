<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "servicio".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $ingles
 * @property string $frances
 * @property integer $prioridad
 * @property integer $estado
 *
 * @property Subservicios[] $subservicios
 */
class Servicio extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'servicio';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nombre','ingles','frances','prioridad'], 'required', 'message' => 'Este campo no puede estar en blanco.'],
            ['nombre', 'unique', 'targetClass' => '\frontend\models\Servicio', 'message' => 'Este nombre debe ser único.'],
            [['nombre'], 'string', 'max' => 255],
            [['prioridad','estado'], 'integer', 'message' => 'Este campo es numero.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => '',
            'ingles' => '',
            'frances' => '',
            'prioridad' => '',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubservicios() {
        return $this->hasMany(Subservicios::className(), ['servicio' => 'id']);
    }

}
