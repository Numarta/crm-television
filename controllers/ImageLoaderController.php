<?php


namespace app\controllers;

use Yii;
use yii\base\ErrorException;
use yii\filters\AccessControl;	
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use PHPThumb\GD;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

class ImageLoaderController extends \yii\web\Controller
{
	
	public function behaviors()
    {	
        return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => 
				[	
					[
						'actions' => ['index', 'load', 'result'],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) 
						{
							return Yii::$app->user->identity->IsAdmin || Yii::$app->user->identity->IsManager;
						}
					],					
				],
			],			
		
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'image-loader-method' => ['post'],
                ],
            ],
        ];
    }
	
   
	
	public function ImageIsUnique ($width, $height, $check_sum)
	{
		//
		$result = \app\models\Image::find()->where(['height' => $height, 'width' => $width, 'check_sum' => $check_sum])->all();
		return count($result) == 0;		
	}	
	
	public function ImageAdd ($full_name)
	{
		//
		$image_size = getimagesize ($full_name);		
		$check_sum = crc32 ($full_name);		
		/*
		if ($this->ImageIsUnique ($image_size[0], $image_size[1], $check_sum) == false)
		{
			//
			throw new \Exception (Yii::t('app', 'Image already loaded'));
		}
		*/
		$image = new \app\models\Image();	
		$image->loading_date = date('Y.m.d H:i:s');		
		$image->file_name = basename ($full_name);		
		$image->title = $image->file_name;	
		$image->size = filesize($full_name);
		$image->height = $image_size[1];
		$image->width = $image_size[0];
		$image->check_sum = $check_sum;
		$image->id_user = Yii::$app->user->identity->id;					
		if ($image->save())
		{
			return $image->id;
		}
		else
		{
			//
			throw new \Exception (Yii::t('app', 'Could not load image'));
		}		
	}
	
	public function CreateThumb ($source, $dest)
	{	
		$thumb = new GD($source);
        $thumb->Resize(100, 100);
        //FileHelper::createDirectory(pathinfo($thumbPath, PATHINFO_DIRNAME), 0775, true);
        $thumb->save($dest);
	}
	
	public function ImageServiceAdd ($id_service, $id_image)
	{
		$model = new \app\models\ServiceImage();
		$model->id_service = $id_service;
		$model->id_image = $id_image;		
		$model->save();
	}
	
	
	
	public function actionLoad($id_service = null)
    {		
		$model = new \app\models\ImageLoader();
		
		if (empty ($id_service) == false)
			$model->id_service = $id_service;
		
		if ($model->load(Yii::$app->request->post()))
		{
			$model->images = UploadedFile::getInstances($model, 'images');					
			if ($model->validate())
			{
				$result = [];
				if (count ($model->images) > 0)
				{	
					$ImageDirectory = Yii::$app->params['ImageDirectory'] . '/';				
					if (file_exists($ImageDirectory) == false)			
						mkdir ($ImageDirectory, 0777, true);	
					
					$ThumbImageDirectory = Yii::$app->params['ThumbImageDirectory'] . '/';				
					if (file_exists($ThumbImageDirectory) == false)			
						mkdir ($ThumbImageDirectory, 0777, true);
					
					foreach ($model->images as $image) 
					{					
						$current = [];
						$current['file_name'] = $image->baseName . '.' . $image->extension;
						try 
						{						
							$file_name = $ImageDirectory . $image->baseName . '.' . $image->extension;							
							$thumb_file_name = $ThumbImageDirectory . $image->baseName . '.' . $image->extension;							
							
							if (file_exists ($file_name))
							{
								// throw new \Exception (Yii::t('app', 'File already exists'));
								
								$image_model = \app\models\Image::find()->where(['file_name' => basename ($file_name)])->one();
								if (empty ($model->id_service) == false && empty ($image_model) == false)
								{									
									$current['id'] = $image_model->id;
									$current['success'] = true;
									$current['message'] = Yii::t('app', 'Image successfully loaded');	
									$this->ImageServiceAdd ($model->id_service, $image_model->id);
								}
								else
								{
									throw new \Exception (Yii::t('app', 'File already exists'));
								}																									
							}
							else
							{
							
								if ($image->saveAs ($file_name)) 
								{									
									$id_image = $this->ImageAdd ($file_name);
									$this->CreateThumb($file_name, $thumb_file_name);
								
									$current['id'] = $id_image;
									$current['success'] = true;
									$current['message'] = Yii::t('app', 'Image successfully loaded');	
									if (empty ($model->id_service) == false)
									{
										$this->ImageServiceAdd ($model->id_service, $id_image);
									}
								} 	
							}
						}
						catch (\Exception $e)
						{							
								$current['success'] = false;
								$current['message'] = $e->getMessage();
						}
						$result[] = $current;
					}					
					$session = new yii\web\Session;
					$session->open();
					$session['loader_result'] = $result;
			
					return $this->redirect(['image-loader/result', 'id_service' => $model->id_service]);	
				}		
			}
		}
		
		
		return $this->render('load', ['model' => $model]);		
    }
	
	public function actionResult($id_service = null)
    {		
		$service = null;
		if (empty ($id_service) == false)
			$service = ServiceController::findModel($id_service);
		
		$session = new yii\web\Session;
		$session->open();		
		return $this->render('result', ['result' => $session['loader_result'], 'service' => $service]);
	}	
	
}
