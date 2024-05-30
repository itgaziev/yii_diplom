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
	
	
	
	$items = [];
	if (empty(Yii::$app->user->identity) == false)
	{		
		$items[] = ['label' => Yii::t('app', 'Folders'), 'url' => ['/folder/index']];
		
		$menu = [];	
		$menu[] = ['label' => Yii::t('app', 'Report Archive'), 'url' => ['/report/archive']];
		$menu[] = ['label' => Yii::t('app', 'Report User List'), 'url' => ['/report/user-list']];	
		$menu[] = ['label' => Yii::t('app', 'Report Document List By Kind'), 'url' => ['/report/document-list-by-kind']];	
		$menu[] = ['label' => Yii::t('app', 'Report Nomenclature'), 'url' => ['/report/nomenclature']];
		
		$items[] = ['label' => Yii::t('app', 'Reports'), 'items'=>$menu];		
		
		if (Yii::$app->user->identity->IsAdmin)
		{			
			$menu = [];	
			$menu[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
			$menu[] = ['label' => Yii::t('app', 'User Functions'), 'url' => ['/user-function/index']];
			$menu[] = ['label' => Yii::t('app', 'Departments'), 'url' => ['/department/index']];
			$menu[] = ['label' => Yii::t('app', 'Partitions'), 'url' => ['/partition/index']];			
			$menu[] = ['label' => Yii::t('app', 'Document Kinds'), 'url' => ['/document-kind/index']];			
			$items[] = ['label' => Yii::t('app', 'Modules'), 'items'=>$menu];							
		}
		else						
		{
			/*
			$menu = [];	
			$menu[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/user/index']];
			$menu[] = ['label' => Yii::t('app', 'User Functions'), 'url' => ['/user-function/index']];
			$menu[] = ['label' => Yii::t('app', 'Departments'), 'url' => ['/department/index']];
			$menu[] = ['label' => Yii::t('app', 'Partitions'), 'url' => ['/partition/index']];			
			$menu[] = ['label' => Yii::t('app', 'Document Kinds'), 'url' => ['/document-kind/index']];			
			$items[] = ['label' => Yii::t('app', 'Modules'), 'items'=>$menu];								
			*/
		}			
	}
	
	
	//$items[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
	//$items[] = ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']];
	
	$items[] = Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']] :
                [
                    'label' => Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
	
	
	
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
