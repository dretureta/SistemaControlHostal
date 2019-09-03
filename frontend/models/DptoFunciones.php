<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dpto_funciones".
 *
 * @property integer $id
 * @property integer $dpto
 * @property integer $func
 * @property double $precio
 */
class DptoFunciones extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'dpto_funciones';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['dpto', 'func', 'precio'], 'required'],
            [['dpto', 'func'], 'integer'],
            [['precio'], 'number']
        ];
    }

    public function getDpto0() {
        return $this->hasOne(Dpto::className(), ['id' => 'dpto']);
    }

    public function getFunc0() {
        return $this->hasOne(Funciones::className(), ['id' => 'func']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'dpto' => 'Dpto',
            'func' => 'Func',
            'precio' => 'Precio',
        ];
    }

}
