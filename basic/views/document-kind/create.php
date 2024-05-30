<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DocumentKind */

$this->title = Yii::t('app', 'Create Document Kind');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Document Kinds'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-kind-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
