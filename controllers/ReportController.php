<?php


namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;	
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

// Класс-контроллер для отчетов системы
// http://nix-tips.ru/yii2-api-guides/guide-ru-structure-controllers.html
class ReportController extends \yii\web\Controller
{
	// Настройка поведения контроллера (права доступа)
	public function behaviors()
    {
        return [
			// права доступа
			'access' => [
				// класс, который реализует проверку прав доступа
				'class' => AccessControl::className(),
				// правила проверки прав доступа
				'rules' => 
				[	
					[
						// публичные действия контроллера, на которые распространяются правила
						'actions' => ['request', 'price-list', 'manager-work', 'request-journal', 'client-stat'],						
						// разрешающее правило
						'allow' => true,
						// Могут просматривать только авторизованные пользователи
						'roles' => ['@'],
						// функция определяет, пользователи с какой ролью могут вызывать данные действия
						
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsManager;
						}
						
					],				

					[
						// публичные действия контроллера, на которые распространяются правила
						'actions' => ['request'],						
						// разрешающее правило
						'allow' => true,
						// Могут просматривать только авторизованные пользователи
						'roles' => ['@'],
						// функция определяет, пользователи с какой ролью могут вызывать данные действия
						
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsClient;
						}
						
					],			
				],
			],					
        ];
    }
	
	// Метод настройки заголовка http-ответа (чтобы брайзер пользователя не открывал файл отчета (т.к. это должен делать Excel), а згружал его)
	public function SetHeader ($filename)
	{
		// содержимое и кодировка данных
		header('Content-Type: text/x-csv; charset=utf-8');
		// имя файла
		header('Content-Disposition: attachment;filename=' . $filename);
		// способ передачи
		header('Content-Transfer-Encoding: binary');		
	}
	
	
	
	public function actionRequest($id_request)
	{
		
		$request = RequestController::findModel($id_request);		
		$request_services = \app\models\RequestService::find()->where(['id_request' => $id_request])->all();
		
		$this->SetHeader ('Заявка #' . $request->id . '.xls');		

		return $this->renderPartial('request', [			
            'request' => $request,
			'request_services' => $request_services,			
        ]);		  
		
	}

	public function actionPriceList()
	{
		
		$services = \app\models\Service::find()->all();		

		$this->SetHeader ('Прайс-лист.xls');		
		
		return $this->renderPartial('price-list', [			
            'services' => $services,				
        ]);		  		
	}
	
	public function actionRequestJournal()
	{
		
		$requests = \app\models\Request::find()->all();		

		$this->SetHeader ('Журнал учета заявок.xls');		
		
		return $this->renderPartial('request-journal', [			
            'requests' => $requests,				
        ]);		  		
	}
	
	public function actionManagerWork()
	{
		
		$users = \app\models\User::find()->andWhere(['id_user_type' => [1, 2]])->all();		
		$this->SetHeader ('Работа сотрудников.xls');	
		return $this->renderPartial('manager-work', [			
            'users' => $users,				
        ]);		  		
	}	
	
	public function actionClientStat()
	{
		
		$users = \app\models\User::find()->andWhere(['id_user_type' => [3]])->all();		
		$this->SetHeader ('Статистика по клиентам.xls');	
		return $this->renderPartial('client-stat', [			
            'users' => $users,				
        ]);		  		
	}	
	

}
