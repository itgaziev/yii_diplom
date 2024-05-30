<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Partition */

$this->title = Yii::t('app', 'Create Partition');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partitions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partition-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
