<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('app', 'Please fill out the following fields to signup:') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
			
			<?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
	
			<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
	
			<?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
	
			<?= $form->field($model, 'birthday')->textInput(['maxlength' => true]) ?>	
	
			<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
	
		
	
	
	<?php 
		
			echo $form->field($model, 'id_department')->dropDownList(ArrayHelper::map(app\models\Department::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title')) 
	?>
	
	<?php		
			echo $form->field($model, 'id_user_function')->dropDownList(ArrayHelper::map(app\models\UserFunction::find()->orderby(['title'=>'title asc'])->all(), 'id', 'title'), ['prompt'=>Yii::t('app','Not selected')]); 
	?>		
    	
	
			
			
			
	
				<?= $form->field($model, 'email') ?>				
			
                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
				
				<?= $form->field($model, 'password_confirmation')->passwordInput() ?>
				
				

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
