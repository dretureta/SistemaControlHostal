<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ReservacionServicios;

/**
 * ReservacionServiciosSearch represents the model behind the search form about `frontend\models\ReservacionServicios`.
 */
class ReservacionServiciosSearch extends ReservacionServicios
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'reservacion', 'servicio', 'cant','hab','estado'], 'integer'],
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
        $query = ReservacionServicios::find();

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
            'reservacion' => $this->reservacion,
            'servicio' => $this->servicio,
            'cant' => $this->cant,
            'precio' => $this->precio,
            'hab' => $this->hab,
            'estado' => $this->estado,
        ]);

        return $dataProvider;
    }
}
