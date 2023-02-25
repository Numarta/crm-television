<?php

namespace app\controllers;

use Yii;
use app\models\Service;
use app\models\ServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class ServiceController extends Controller
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
					'actions' => ['index', 'view'],
					'allow' => true,
					'roles' => ['?'],					
					],
					
					[
					'actions' => ['index', 'view'],
					'allow' => true,
					'roles' => ['@'],					
					],
					
					[
					'actions' => ['index', 'view', 'create', 'update', 'delete'],
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
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->orderby (['title' => SORT_ASC]);
		
		$view_name = 'index';		
		if (empty (Yii::$app->user->identity) == false)
		{
			switch (Yii::$app->user->identity->id_user_type)
			{
				case \app\models\User::USER_TYPE_ADMIN :
				{
					$view_name = 'admin-index';
				} break;
			}
		}
		
        return $this->render($view_name, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Service model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		
		$view_name = 'view';		
		if (empty (Yii::$app->user->identity) == false)
		{
			switch (Yii::$app->user->identity->id_user_type)
			{
				case \app\models\User::USER_TYPE_ADMIN :
				{
					$view_name = 'admin-view';
				} break;
			}
		}
		
        return $this->render($view_name, [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Service model.
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
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public static function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
