<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Gastos]].
 *
 * @see Gastos
 */
class GastosQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Gastos[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Gastos|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}