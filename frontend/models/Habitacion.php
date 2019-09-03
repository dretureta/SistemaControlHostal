<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "habitacion".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $color
 *  * @property integer $codigo

 *
 * @property OcupacionHab[] $ocupacionHabs
 * @property Reservacion[] $reservacions
 */
class Habitacion extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'habitacion';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nombre'], 'required','message'=>'Este campo no puede estar en blanco.'],
            ['nombre', 'unique', 'targetClass' => '\frontend\models\Habitacion', 'message' => 'Este nombre debe ser único.'],
            [['codigo'], 'integer'],
            [['nombre'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => ''
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOcupacionHabs() {
        return $this->hasMany(OcupacionHab::className(), ['hab' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacions() {
        return $this->hasMany(Reservacion::className(), ['hab' => 'id']);
    }

    /**
     * @inheritdoc
     * @return HabitacionQuery the active query used by this AR class.
     */
    public static function find() {
        return new HabitacionQuery(get_called_class());
    }

}
