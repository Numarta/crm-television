<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ConfirmForm extends Model
{
    public $answer;
   

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
           
            [['answer'], 'required'],
      
            ['answer', 'boolean'],
       
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'answer' => Yii::t('app', 'Yes'),
		
        ];
    }

    
}
