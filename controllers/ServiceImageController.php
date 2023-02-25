<?php

namespace app\controllers;

use Yii;
use app\models\ServiceImage;
use app\models\ServiceImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * ServiceImageController implements the CRUD actions for ServiceImage model.
 */
class ServiceImageController extends Controller
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
							return Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsManager;
						}
					],
				],
			],				
			
        ];
    }

    /**
     * Lists all ServiceImage models.
     * @return mixed
     */
    public function actionIndex($id_service)
    {
		$service = ServiceController::findModel($id_service);	
        $searchModel = new ServiceImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['id_service' => $service->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'service' => $service,
        ]);
    }

    /**
     * Displays a single ServiceImage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$service = ServiceController::findModel($model->id_service);	
        return $this->render('view', [
            'model' => $this->findModel($id),
			'service' => $service,
        ]);
    }

    /**
     * Creates a new ServiceImage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_service)
    {
		$service = ServiceController::findModel($id_service);	
        $model = new ServiceImage();
		$model->id_service = $service->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'service' => $service,
            ]);
        }
    }

    /**
     * Updates an existing ServiceImage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$service = ServiceController::findModel($model->id_service);	
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'service' => $service,
            ]);
        }
    }

    /**
     * Deletes an existing ServiceImage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$service = ServiceController::findModel($model->id_service);	
        $model->delete();		
        return $this->redirect(['index', 'id_service' => $service->id]);	
    }

    /**
     * Finds the ServiceImage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceImage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceImage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
