<?php

namespace app\controllers;

use Yii;
use app\models\RequestService;
use app\models\RequestServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * RequestServiceController implements the CRUD actions for RequestService model.
 */
class RequestServiceController extends Controller
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
					'actions' => ['index', 'view', 'create', 'update', 'delete'],
					'allow' => true,
					'roles' => ['@'],
					'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsManager || Yii::$app->user->identity->IsClient;
						}
					],
				],
			],				
			
        ];
    }

    /**
     * Lists all RequestService models.
     * @return mixed
     */
    public function actionIndex($id_request)
    {		
		$request = RequestController::findModel($id_request);	
        $searchModel = new RequestServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['id_request' => $request->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'request' => $request,
			'editable' => RequestController::RequestEditable ($request->id, false),
        ]);
    }

    /**
     * Displays a single RequestService model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$request = RequestController::findModel($model->id_request);	
        return $this->render('view', [
            'model' => $model,
			'request' => $request,
			'editable' => RequestController::RequestEditable ($request->id, false),
        ]);
    }

    /**
     * Creates a new RequestService model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
	public function actionCreate($id_request)
    {
		RequestController::RequestEditable ($id_request);
		$request = RequestController::findModel($id_request);	
        $model = new RequestService();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$model->id_request = $request->id;
			$model->registration_date = date ('Y-m-d H:i:s');
			$model->id_creator = Yii::$app->user->identity->id;
			if (empty ($model->idService) == false)
			{
				$model->cost = $model->idService->cost;	
				$model->total = $model->cost * $model->amount;
			}
			else
			{
				$model->cost = null;
				$model->total = null;				
			}
			$model->save();		
			$request->RecalculateCost();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'request' => $request,
            ]);
        }
    }

    /**
     * Updates an existing RequestService model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
	
	public function actionUpdate($id)
    {		
        $model = $this->findModel($id);
		RequestController::RequestEditable ($model->id_request);
		$request = RequestController::findModel($model->id_request);	
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if (empty ($model->idService) == false)
			{
				$model->cost = $model->idService->cost;	
				$model->total = $model->cost * $model->amount;
			}
			else
			{
				$model->cost = null;
				$model->total = null;				
			}
			$model->save();	
			$request->RecalculateCost();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'request' => $request,
            ]);
        }
    }

    /**
     * Deletes an existing RequestService model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {		
		$model = $this->findModel($id);
		RequestController::RequestEditable ($model->id_request);
		$request = RequestController::findModel($model->id_request);	
        $model->delete();
		$request->RecalculateCost();
        return $this->redirect(['index', 'id_request' => $request->id]);	
    }

    /**
     * Finds the RequestService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequestService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestService::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
