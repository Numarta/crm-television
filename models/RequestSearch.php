<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Request;

/**
 * RequestSearch represents the model behind the search form about `app\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_creator', 'id_request_status', 'order_number', 'id_executor', 'id_client'], 'integer'],
            [['registration_date', 'order_date', 'description'], 'safe'],
            [['cost'], 'number'],
			[['paid'], 'boolean'],
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
        $query = Request::find();

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
            'registration_date' => $this->registration_date,
            'id_creator' => $this->id_creator,
            'id_request_status' => $this->id_request_status,
            'order_date' => $this->order_date,
            'order_number' => $this->order_number,
            'cost' => $this->cost,
            'id_executor' => $this->id_executor,
			'id_client' => $this->id_client, 
			'paid' => $this->paid, 
			
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
