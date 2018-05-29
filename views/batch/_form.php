<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblBatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-batch-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'BATCH')->hiddenInput(['value' => 1])->label(false) ?>

    <?= $form->field($model, 'file')->fileInput() ?>
    <?php 
    	if($model->FILE_IMPORT){
    		echo Html::a('Delete Files', ['deleteimg', 'BATCH_ID'=>$model->BATCH_ID, 'field'=>'FILE_IMPORT']);
    	}
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
