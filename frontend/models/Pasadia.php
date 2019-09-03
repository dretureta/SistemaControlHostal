<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pasadia".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $fecha
 * @property integer $estado
 * @property integer $agencia
 * @property string $obs
 *
 * @property PasadiaServicio[] $pasadiaServicios
 */
class Pasadia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pasadia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'fecha', 'estado','agencia'], 'required'],
            [['fecha'], 'safe'],
            [['estado'], 'integer'],
            [['nombre','obs'], 'string', 'max' => 255]
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
            'fecha' => 'Fecha',
            'estado' => 'Estado',
            'agencia' => 'Agencia',
            'obs' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasadiaServicios()
    {
        return $this->hasMany(PasadiaServicio::className(), ['pasadia' => 'id']);
    }
}
