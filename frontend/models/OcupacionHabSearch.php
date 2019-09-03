<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\OcupacionHab;

/**
 * OcupacionHabSearch represents the model behind the search form about `frontend\models\OcupacionHab`.
 */
class OcupacionHabSearch extends OcupacionHab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ocupacion', 'hab'], 'integer'],
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
        $query = OcupacionHab::find();

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
            'ocupacion' => $this->ocupacion,
            'hab' => $this->hab,
            'precio' => $this->precio,
        ]);

        return $dataProvider;
    }
}
