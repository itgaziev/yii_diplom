<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartitionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Partitions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partition-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Partition'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		
		'columns' => [
            [
				'class' => 'yii\grid\SerialColumn',
				'options' => ['width' => '70'],
			],
            
			//'id',
            'title',

            [
				'class' => 'yii\grid\ActionColumn', 				
				'options' => ['width' => '70'],
			],
        ],		
       
    ]); ?>
</div>
