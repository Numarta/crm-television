<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Booking;

/**
 * BookingSearch represents the model behind the search form of `app\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_booking_status', 'id_delivery_time'], 'integer'],
            [['registration_date', 'delivery_address', 'delivery_date', 'note'], 'safe'],
            [['total_cost'], 'number'],
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
        $query = Booking::find();

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
            'registration_date' => $this->registration_date,
            'total_cost' => $this->total_cost,
            'delivery_date' => $this->delivery_date,
            'id_user' => $this->id_user,
            'id_booking_status' => $this->id_booking_status,
			'id_delivery_time' => $this->id_delivery_time,
        ]);

        $query->andFilterWhere(['like', 'delivery_address', $this->delivery_address])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
