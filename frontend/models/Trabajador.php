<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "trabajador".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $dpto
 *
 * @property TrabFunciones[] $trabFunciones
 * @property Dpto $dpto0
 */
class Trabajador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trabajador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'dpto'], 'required'],
            [['dpto'], 'integer'],
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
            'dpto' => 'Departamento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrabFunciones()
    {
        return $this->hasMany(TrabFunciones::className(), ['trab' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDpto0()
    {
        return $this->hasOne(Dpto::className(), ['id' => 'dpto']);
    }
}
