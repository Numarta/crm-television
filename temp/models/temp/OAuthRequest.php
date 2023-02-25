<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class OAuthRequest extends Model
{
    public $grant_type; 
	public $code;
	public $redirect_uri;
	public $client_id;
	public $client_secret;   

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['grant_type', 'code', 'redirect_uri', 'client_id', 'client_secret'], 'safe'],
       
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            //'answer' => Yii::t('app', 'Yes'),
		
        ];
    }

    
}
