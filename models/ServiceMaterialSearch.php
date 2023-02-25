<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceMaterial;

/**
 * ServiceMaterialSearch represents the model behind the search form of `app\models\ServiceMaterial`.
 */
class ServiceMaterialSearch extends ServiceMaterial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_service', 'id_material'], 'integer'],
            [['amount'], 'number'],
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
        $query = ServiceMaterial::find();

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
            'id_service' => $this->id_service,
            'id_material' => $this->id_material,
            'amount' => $this->amount,
        ]);

        return $dataProvider;
    }
}
