<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property string $password_reset_token
 * @property string $activation_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $nikname
 * @property integer $id_user_type
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $phone
 * @property string $report_date_1
 * @property string $report_date_2
 *
 * @property Request[] $requests
 * @property Request[] $requests0
 * @property Request[] $requests1
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report_date_1', 'report_date_2'], 'safe'],
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),            
            'report_date_1' => Yii::t('app', 'Report Date 1'),
            'report_date_2' => Yii::t('app', 'Report Date 2'),
        ];
    }
    
}
