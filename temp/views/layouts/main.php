<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->params['projectName'],
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
	
	
	//$items[] = ['label' => Yii::t('app', 'Products'), 'url' => ['/product/index']];	
	

	
		
	if (empty(Yii::$app->user->identity) == false)
	{	
			
		
	
		if (Yii::$app->user->identity->IsAdmin)
		{	
	
		
	
			$menu = [];			
			$menu[] = ['label' => Yii::t('app', 'Clients'), 'url' => ['/client/index']];			
			$menu[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];			
			$items[] = ['label' => Yii::t('app', 'Admin Panel'), 'items'=>$menu];		
		}		
		

		$menu = [];						
		$menu[] = ['label' => Yii::t('app', 'User Data'), 'url' => ['user/view', 'id' => Yii::$app->user->identity->id]];			
		$menu[] = [ 'label' => Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];			
		$items[] = ['label' => Yii::$app->user->identity->username, 'items'=>$menu];					
		
	}
	else
	{
		
		
		
		//$items[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
		//$items[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];	
		$items[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
	}
	
	
	
	
	
	
	
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items
    ]);
    NavBar::end();
    ?>

    <div class="container">
		<?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
		<?php
	
			foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
				echo '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
			}
		?>
        
        <?= $content ?>
    </div>
	
	
	
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->params['companyName'] ?> <?= date('Y') ?></p>
        <p class="pull-right">
		</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
