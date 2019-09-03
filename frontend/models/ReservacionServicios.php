<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "reservacion_servicios".
 *
 * @property integer $id
 * @property integer $reservacion
 * @property integer $servicio
 * @property integer $cant
 * @property double $precio  
 * @property integer $hab
 * @property integer $estado
 *
 * @property Reservacion $reservacion0
 * @property Subservicios $servicio0
 * @property Habitacion $hab0
 */
class ReservacionServicios extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'reservacion_servicios';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['reservacion', 'servicio', 'cant', 'precio', 'hab'], 'required', 'message' => 'Este campo no puede estar en blanco.'],
            [['reservacion', 'servicio', 'cant'], 'integer', 'message' => 'Este campo tiene que ser número.'],
            [['precio'], 'number', 'message' => 'Este campo tiene que ser número.'],
            [['estado'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'reservacion' => '',
            'servicio' => '',
            'cant' => '',
            'precio' => '',
            'hab' => '',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservacion0() {
        return $this->hasOne(Reservacion::className(), ['id' => 'reservacion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicio0() {
        return $this->hasOne(Subservicios::className(), ['id' => 'servicio']);
    }

    public function getHab0() {
        return $this->hasOne(Habitacion::className(), ['id' => 'hab']);
    }

}
