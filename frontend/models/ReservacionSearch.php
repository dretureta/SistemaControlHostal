<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Reservacion;

/**
 * ReservacionSearch represents the model behind the search form about `frontend\models\Reservacion`.
 */
class ReservacionSearch extends Reservacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'agencia'], 'integer'],
            [['nombre_cliente', 'fecha_entrada', 'fecha_salida'], 'safe'],
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
        $query = Reservacion::find();

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
            'fecha_entrada' => $this->fecha_entrada,
            'fecha_salida' => $this->fecha_salida,
            'agencia' => $this->agencia,
        ]);

        $query->andFilterWhere(['like', 'nombre_cliente', $this->nombre_cliente]);

        return $dataProvider;
    }
}
