<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequestService;

/**
 * RequestServiceSearch represents the model behind the search form about `app\models\RequestService`.
 */
class RequestServiceSearch extends RequestService
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_request', 'id_service'], 'integer'],
            [['registration_date', 'description'], 'safe'],
            [['amount', 'cost', 'total'], 'number'],
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
        $query = RequestService::find();

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
            'id_request' => $this->id_request,
            'registration_date' => $this->registration_date,
            'id_service' => $this->id_service,
            'amount' => $this->amount,
            'cost' => $this->cost,
			'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
