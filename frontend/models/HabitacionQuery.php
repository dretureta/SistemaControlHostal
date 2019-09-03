<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Habitacion]].
 *
 * @see Habitacion
 */
class HabitacionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Habitacion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Habitacion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}