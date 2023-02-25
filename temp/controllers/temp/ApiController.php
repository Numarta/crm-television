<?php

namespace app\controllers;

use Yii;

use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	
use yii\data\ArrayDataProvider;
use app\models\User;
use app\models\Client;
use app\models\Token;	
use app\models\TokenType;

ini_set("error_log", "C:\WEB\Sites\htdocs\temp\php-error.log");

/**
 * Класс "ApiController" реализует API для мобильного приложения.
 */
class ApiController extends Controller
{
	
	/**
     * Метод, определяющий поведение контроллера (правила доступа к действиям контроллера)
     */
	public function behaviors()
    {
        return [
		
			'access' => [
				'class' => AccessControl::className(),
				'rules' => 
				[		
					[
                        'actions' => ['token', 'userinfo'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
					
					[
                        'actions' => ['authorize', 'token', 'userinfo'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
				],
			],			
		
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'token' => ['post'],
					
                ],
            ],
        ];
    }
	
	public function WriteLog ($msg) {
		file_put_contents('C:\WEB\Sites\2912_server\log.txt', print_r ($msg, true), FILE_APPEND | LOCK_EX);
	}
	
	public function actionUserinfo () {		
		
		try
		{
			/*
			HEADER
			
			[Host] => myoauth20server.ru:7087
			[Accept-Encoding] => deflate, gzip
			[Authorization] => Bearer C-yCr79aqdIPFTWov6tOUaoJcMsnl2SQ
			[Accept] => application/json
			[User-Agent] => MoodleBot/3.8 (+http://localhost:7088)
			*/
			
			
			$header = getallheaders();
			$acces_token_str = explode (' ', $header['Authorization'])[1];
			$acces_token = $this->findToken($acces_token_str, TokenType::TOKEN_TYPE_ACCESS_TOKEN);
			$user = $acces_token->user;
			$result = 
				[
					'email' => $user->email,
					'username' => $user->username,
					'firstname' => $user->first_name,
					'lastname' => $user->last_name,					
					'phone1' => $user->phone,
					
				];			

			$this->WriteLog($result);
			
			return $this->JsonResponse($result);
			
			
			print_r ($acces_token);
			print_r ($_POST);
			print_r (Yii::$app->session->get('code')+1);
			print_r (Yii::$app->request->url);
			print_r (Yii::$app->request->referrer);
			throw new \Exception (1);	
			/*
			exit();
			*/
			/*
			$loaded = false;
			$model = new \app\models\OAuthRequest();
			if (Yii::$app->request->getIsPost())
				$loaded = $model->load(Yii::$app->request->post(), '');
			if (Yii::$app->request->getIsGet())
				$loaded = $model->load(Yii::$app->request->get(), '');
			if ($loaded) 
			{
				
			}
			else
			{
				throw new \Exception ($this->getModelsErrors([$model]));	
			}*/
		
			
		
		}
		catch (\Exception $e)
		{
			return $this->JsonResponse(
				[
					'error' => $e->getCode(), 
					'error_description' => $e->getMessage(),
				],
			);
		}
		
	}
	
	public function actionToken () {		
		
		try
		{
			
			$loaded = false;
			$model = new \app\models\OAuthRequest();
			if (Yii::$app->request->getIsPost())
				$loaded = $model->load(Yii::$app->request->post(), '');
			if (Yii::$app->request->getIsGet())
				$loaded = $model->load(Yii::$app->request->get(), '');
			if ($loaded) 
			{				
		
				$this->WriteLog(Yii::$app->request->post());
				$this->WriteLog(Yii::$app->request->get());
		
				if ($model->grant_type == 'authorization_code') {				
					$client = $this->findClient($model->client_id);					
					$authorization_code = $this->findToken($model->code, TokenType::TOKEN_TYPE_AUTHORIZATION_CODE);							
					$access_token = \app\models\Token::Generate($client->id, TokenType::TOKEN_TYPE_ACCESS_TOKEN, $authorization_code->id_user);
					$refresh_token = \app\models\Token::Generate($client->id, TokenType::TOKEN_TYPE_REFRESH_TOKEN, $authorization_code->id_user);
					return $this->JsonResponse(
						[
							'access_token' => $access_token->token,
							'expires_in' => $access_token->life_time,
							'refresh_token' => $refresh_token->token,
						],
					);
				}		

				if ($model->grant_type == 'refresh_token') {
					
				}
				
				throw new \Exception (Yii::t('api', 'Incorrect "grand_type"'));	
			}
			else
			{
				
				throw new \Exception ($this->getModelsErrors([$model]));	
			}
		
		}
		catch (\Exception $e)
		{
			return $this->JsonResponse(
				[
					'error' => $e->getCode(), 
					'error_description' => $e->getMessage(),
				],
			);
		}
		
	}


	public function actionAuthorize($client_id, $redirect_uri = null, $response_type = null)
    {
        $client = $this->findClient($client_id); 
		$model = new \app\models\ConfirmForm ();			
        if ($model->load(Yii::$app->request->post())) 
		{
			if ($model->answer) 
			{
				$token = \app\models\Token::Generate($client->id, TokenType::TOKEN_TYPE_AUTHORIZATION_CODE, Yii::$app->user->identity->id);
				return $this->redirect($client->redirect_uri . '?' . http_build_query (['code' => $token->token, 'state' => $_GET['state']]));
			}
			else
			{
				Yii::$app->session->setFlash('success', Yii::t('api', 'Permission denied'));
				return $this->goHome();
			}
			
        } else {
            return $this->render('grant-access', [
                'model' => $model,
				'client' => $client,
            ]);
        }		
    }
	
	
	protected function findClient($client_id)
    {
		$model = Client::find()->where(['client_id' => $client_id])->one();
        if (($model) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('api', 'Client does not exist.'));
        }
    }
	
	protected function findToken($token, $id_token_type)
    {
		$model = Token::find()->where(['token' => $token, 'id_token_type' => $id_token_type])->one();
        if (($model) !== null) {
			if (!$model->isValidToken()) {
				throw new \Exception (Yii::t('api', 'Token expired'));	
			}
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('api', 'Token does not exist.'));
        }
    }
	
	public function beforeAction($action)
	{             
		$this->enableCsrfValidation = false;
		return parent::beforeAction($action);
	}
	
	public function JsonResponse ($data = []) {
		// Yii::$app->response->setStatusCode(200);
		return json_encode(array_merge ($data));
	}
	
	public function getModelsErrors ($models) {			
			$result = '';
			foreach ($models as $model) {
				$errors = $model->getErrors();
				$fields = array_keys ($errors);
				foreach ($fields as $field) {
					
					foreach ($errors[$field] as $error) {						
						if ($result != '')
							$result .= "\n";
						$result .= $model->getAttributeLabel ($field) . ': ' . $error;
					}
				}
			}
			return $result;
			
		}
	
}
