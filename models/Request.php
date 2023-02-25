<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property string $registration_date
 * @property integer $id_creator
 * @property integer $id_request_status
 * @property string $order_date
 * @property integer $order_number
 * @property double $cost
 * @property string $description
 * @property integer $id_executor
 *
 * @property User $idCreator
 * @property User $idExecutor
 * @property RequestStatus $idRequestStatus
 * @property RequestService[] $requestServices
 */
class Request extends \yii\db\ActiveRecord
{
	const REQUEST_STATUS_OPEN = 1;
	const REQUEST_STATUS_FULL = 2;
	const REQUEST_STATUS_PERFORMING = 3;
	const REQUEST_STATUS_PERFORMED = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }
	
	public function getTitle ()
	{
		
		return 'Заказ #' . $this->id;
	}
	
	public function RecalculateCost ()
	{
		$s = RequestService::find()->where (['id_request' => $this->id]);
		if (empty ($s) == false)
		{
			$this->cost = $s->sum('total');
		}
		$this->save();
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['registration_date', 'order_date'], 'safe'],
            [['id_creator', 'id_request_status', 'order_number', 'id_executor', 'id_client'], 'integer'],
            [['cost'], 'number'],
            [['description'], 'string'],
			[['paid'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'registration_date' => Yii::t('app', 'Registration Date'),
            'id_creator' => Yii::t('app', 'Id Creator'),
            'id_request_status' => Yii::t('app', 'Id Request Status'),
            'order_date' => Yii::t('app', 'Order Date'),
            'order_number' => Yii::t('app', 'Order Number'),
            'cost' => Yii::t('app', 'Cost'),
            'description' => Yii::t('app', 'Description'),
            'id_executor' => Yii::t('app', 'Id Executor'),
			'id_client' => Yii::t('app', 'Id Client'),
			'paid' => Yii::t('app', 'Paid'),
        ];
    }

	/**
     * @return \yii\db\ActiveQuery
     */
    public function getIdClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'id_client']);
    }

	
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'id_creator']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdExecutor()
    {
        return $this->hasOne(User::className(), ['id' => 'id_executor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRequestStatus()
    {
        return $this->hasOne(RequestStatus::className(), ['id' => 'id_request_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestServices()
    {
        return $this->hasMany(RequestService::className(), ['id_request' => 'id']);
    }
}
