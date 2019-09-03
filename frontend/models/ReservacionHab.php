<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reservacion_hab".
 *
 * @property integer $id
 * @property integer $reservacion
 * @property integer $hab
 * @property double $precio
 * @property integer $ocupacion
 * @property string $fecha_entrada
 * @property string $fecha_salida
 *
 * @property Habitacion $hab0
 * @property OcupacionHab $ocupacion0
 * @property Reservacion $reservacion0
 */
class ReservacionHab extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'reservacion_hab';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['reservacion', 'hab', 'ocupacion', 'agencia', 'plan', 'conjunto'], 'integer'],
            [['precio'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'reservacion' => 'Reservacion',
            'hab' => 'Hab',
            'precio' => 'Precio',
            'ocupacion' => 'Ocupacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHab0() {
        return $this->hasOne(Habitacion::className(), ['id' => 'hab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOcupacion0() {
        return $this->hasOne(OcupacionHab::className(), ['id' => 'ocupacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacion0() {
        return $this->hasOne(Reservacion::className(), ['id' => 'reservacion']);
    }

    public function getAgencia0() {
        return $this->hasOne(Agencia::className(), ['id' => 'agencia']);
    }

    public function getPlan0() {
        return $this->hasOne(Plan::className(), ['id' => 'plan']);
    }

}
