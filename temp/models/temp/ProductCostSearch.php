<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProductCost;

/**
 * ProductCostSearch represents the model behind the search form of `app\models\ProductCost`.
 */
class ProductCostSearch extends ProductCost
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_product', 'amount_min', 'amount_max'], 'integer'],
            [['cost'], 'number'],
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
        $query = ProductCost::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_product' => $this->id_product,
            'amount_min' => $this->amount_min,
            'amount_max' => $this->amount_max,
            'cost' => $this->cost,
        ]);

        return $dataProvider;
    }
}
