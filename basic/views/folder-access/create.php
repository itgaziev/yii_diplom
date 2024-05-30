<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FolderAccess */

$this->title = Yii::t('app', 'Create Folder Access');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Folder Accesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="folder-access-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
