<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dpto".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $gastos
 *
 * @property Gastos $gastos0
 * @property DptoFunciones[] $dptoFunciones
 * @property Trabajador[] $trabajadors
 */
class Dpto extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'dpto';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nombre', 'gastos'], 'required'],
            ['nombre', 'unique', 'targetClass' => '\frontend\models\Dpto', 'message' => 'Este nombre debe ser único.'],
            [['gastos'], 'integer'],
            [['nombre'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'gastos' => 'Gastos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGastos0() {
        return $this->hasOne(Gastos::className(), ['id' => 'gastos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDptoFunciones() {
        return $this->hasMany(DptoFunciones::className(), ['dpto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabajadors() {
        return $this->hasMany(Trabajador::className(), ['dpto' => 'id']);
    }

}
