<?php

namespace app\controllers;

use Yii;
use app\models\Request;
use app\models\RequestSearch;
use app\models\RequestService;
use app\models\RequestServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	
use yii\base\UserException;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
{
    public function behaviors()
    {	
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
			
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					
					
					[
					'actions' => ['index', 'view', 'create', 'delete', 'add-service', 'request-full'],
					'allow' => true,
					'roles' => ['@'],
					'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsClient;
						}
					],
					
					[
					'actions' => ['index', 'view', 'create', 'delete', 'add-service', 'request-select', 'request-paid', 'request-performing', 'request-performed'],
					'allow' => true,
					'roles' => ['@'],
					'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsManager;
						}
					],
					
					[
					'actions' => ['index', 'view', 'create', 'update', 'delete', 'add-service', 'request-select', 'request-paid', 'request-performing', 'request-performed'],
					'allow' => true,
					'roles' => ['@'],
					'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin;
						}
					],
				],
			],				
			
        ];
    }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$view_name = '';		
		switch (Yii::$app->user->identity->id_user_type)
		{
			case \app\models\User::USER_TYPE_CLIENT :
			{
				$view_name = 'client-index';
				$dataProvider->query->andWhere(['id_creator' => Yii::$app->user->identity->id]);				
			} break;
			
			case \app\models\User::USER_TYPE_MANAGER :
			{				
				$view_name = 'manager-index';
				$dataProvider->query->andWhere(['id_executor' => Yii::$app->user->identity->id])->orWhere('id_executor IS NULL')->andWhere('id_request_status > ' . \app\models\Request::REQUEST_STATUS_OPEN);				
			} break;
			
			case \app\models\User::USER_TYPE_ADMIN :
			{
				$view_name = 'admin-index';
			} break;
		}
					
		
        return $this->render($view_name, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$view_name = '';		
		switch (Yii::$app->user->identity->id_user_type)
		{
			case \app\models\User::USER_TYPE_CLIENT :
			{
				$view_name = 'client-view';				
			} break;
			
			case \app\models\User::USER_TYPE_MANAGER :
			{				
				$view_name = 'manager-view';				
			} break;
			
			case \app\models\User::USER_TYPE_ADMIN :
			{
				$view_name = 'admin-view';
			} break;
		}
		
	    return $this->render($view_name, [
            'model' => $this->findModel($id),
			'editable' => RequestController::RequestEditable ($id, false),
        ]);
    }
	

	public static function RequestGetCurrent ()
	{
		$models = Request::find()->andWhere (
			['id_request_status' => Request::REQUEST_STATUS_OPEN,
			 'id_creator' => Yii::$app->user->identity->id])->orderby(['id' => SORT_ASC])->all();
			 
		if (count ($models) == 0)
		{
			return null;
		}
		else
		{
			return $models[0]->id;
		}
	}
	
	public static function RequestCreate ()
	{
		$model = new Request();
		$model->registration_date = date ('Y-m-d H:i:s');
		$model->id_creator = Yii::$app->user->identity->id;
		$model->id_request_status = Request::REQUEST_STATUS_OPEN;
		$model->save();
		return $model->id;
	}
	
	public function actionAddService ($id_service)
	{
		$id = RequestController::RequestGetCurrent ();
		if ($id == NULL)
			$id = RequestController::RequestCreate ();
			
		$request = RequestController::findModel($id);
		
		$model = RequestService::find()->andWhere (['id_request' => $request->id, 'id_service' => $id_service])->one();
		if (empty ($model) == true)
		{
			$model = new RequestService();
			$model->id_request = $id;
			$model->registration_date = date ('Y-m-d H:i:s');
			$model->id_creator = Yii::$app->user->identity->id;
			$model->id_service = $id_service;
			$model->amount = 1;
			$model->cost = $model->idService->cost;	
			$model->total = $model->cost * $model->amount;
			$model->save();		
		}
		else
		{
			$model->amount += 1;
			$model->cost = $model->idService->cost;	
			$model->total = $model->cost * $model->amount;
			$model->save();	
		}					
		$request->RecalculateCost();		
		$this->redirect(['request-service/index', 'id_request' => $request->id]);
	}
	
	public function actionRequestFull ($id_request)
	{	
		$request = RequestController::findModel($id_request);
		if ($request->id_request_status != Request::REQUEST_STATUS_OPEN)
			throw new UserException (Yii::t('app', 'Bad Request Status'));		
		$request->id_request_status = Request::REQUEST_STATUS_FULL;
		$request->save();
		return $this->redirect(Yii::$app->request->referrer);
	}
	
	public function actionRequestPaid ($id_request)
	{	
		$request = RequestController::findModel($id_request);	
		if ($request->id_request_status != Request::REQUEST_STATUS_FULL)
			throw new UserException (Yii::t('app', 'Bad Request Status'));	
		$request->id_executor = Yii::$app->user->identity->id;
		$request->paid = true;
		$request->save();
		return $this->redirect(Yii::$app->request->referrer);
	}
	
	public function actionRequestPerforming ($id_request)
	{	
		$request = RequestController::findModel($id_request);		
		if ($request->id_request_status != Request::REQUEST_STATUS_FULL)
			throw new UserException (Yii::t('app', 'Bad Request Status'));	
		if ($request->paid != true)
			throw new UserException (Yii::t('app', 'Request Not Paid'));
		$request->id_request_status = Request::REQUEST_STATUS_PERFORMING;
		$request->save();
		return $this->redirect(Yii::$app->request->referrer);
	}
	
	public function actionRequestPerformed ($id_request)
	{	
		$request = RequestController::findModel($id_request);	
		if ($request->id_request_status != Request::REQUEST_STATUS_PERFORMING)
			throw new UserException (Yii::t('app', 'Bad Request Status'));		
		$request->id_request_status = Request::REQUEST_STATUS_PERFORMED;
		$request->save();
		return $this->redirect(Yii::$app->request->referrer);
	}
	
	public static function RequestEditable ($id_request, $exception = true)
	{
		$result = false;
		$model = RequestController::findModel($id_request);		
		switch (Yii::$app->user->identity->id_user_type)
		{
			case \app\models\User::USER_TYPE_CLIENT :
			{
				$result = $model->id_request_status == Request::REQUEST_STATUS_OPEN;
			} break;
			
			case \app\models\User::USER_TYPE_MANAGER :
			{				
				$result = $model->id_request_status == Request::REQUEST_STATUS_FULL && $model->paid == false;
			} break;
			
			case \app\models\User::USER_TYPE_ADMIN :
			{
				$result = $model->id_request_status == Request::REQUEST_STATUS_FULL;
			} break;
		}		
		if ($exception)
		{
			if ($result == false)			
				throw new UserException (Yii::t('app', 'Request Is Not Editable'));
		}
		else 
			return $result;
	}
	
		
	
    /**
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {   
		return $this->redirect(['view', 'id' => RequestController::RequestCreate ()]);        
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	 
	
	 
    public function actionDelete($id)
    {
        RequestController::RequestEditable ($id);
		$model = $this->findModel($id);		
		$model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
		$model = Request::findOne($id);
        if (($model) !== null) 
		{
			/*
			if (Yii::$app->user->identity->IsAdmin == false)
			{			
				if ($model->id_executor != Yii::$app->user->identity->id)
				{
					throw new UserException (Yii::t('app', 'Access denied'));
				}
			}
			*/
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
