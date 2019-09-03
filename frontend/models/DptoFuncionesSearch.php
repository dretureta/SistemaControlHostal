<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\DptoFunciones;

/**
 * DptoFuncionesSearch represents the model behind the search form about `frontend\models\DptoFunciones`.
 */
class DptoFuncionesSearch extends DptoFunciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dpto', 'func'], 'integer'],
            [['precio'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = DptoFunciones::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'dpto' => $this->dpto,
            'func' => $this->func,
            'precio' => $this->precio,
        ]);

        return $dataProvider;
    }
}
