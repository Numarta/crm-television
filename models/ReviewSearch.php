<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Review;

/**
 * ReviewSearch represents the model behind the search form of `\app\models\Review`.
 */
class ReviewSearch extends Review
{
	
	public $my_review = false;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_review_status'], 'integer'],
            [['registration_date', 'description'], 'safe'],
			[['my_review'], 'boolean'],
			
        ];
    }
	
	/**
     * Метод, определяет текстовые метки для полей данных.
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'registration_date' => Yii::t('app', 'Registration Date'),
            'description' => Yii::t('app', 'Content'),
            'id_user' => Yii::t('app', 'Id User'),
            'id_review_status' => Yii::t('app', 'Id Review Status'),
			'my_review' => Yii::t('app', 'My Review'),
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
        $query = Review::find();

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
            'id_user' => $this->id_user,
            'id_review_status' => $this->id_review_status,
        ]);
		
		if ($this->my_review == true && !empty (Yii::$app->user->identity)) {		
			$query->andFilterWhere([
				'id_user' => Yii::$app->user->identity->id,
			]);
		}

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
