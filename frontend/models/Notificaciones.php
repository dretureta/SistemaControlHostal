<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "notificaciones".
 *
 * @property integer $id
 * @property string $tipo
 * @property string $titulo
 * @property string $notificacion
 * @property integer $estado
 * @property string $fecha
 */
class Notificaciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notificaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'titulo', 'notificacion', 'fecha'], 'required'],
            [['estado'], 'integer'],
            [['tipo', 'titulo', 'notificacion', 'fecha'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'titulo' => 'Titulo',
            'notificacion' => 'Notificacion',
            'estado' => 'Estado',
            'fecha' => 'Fecha',
        ];
    }

    /**
     * @inheritdoc
     * @return NotificacionesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotificacionesQuery(get_called_class());
    }
}
