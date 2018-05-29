<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'CATEGORY_ID') ?>

    <div class="row">
        <div class="col-sm-6">
             <?= $form->field($model, 'CATEGORY_TITLE') ?>
        </div>
        <div class="col-sm-6">
             <?= $form->field($model, 'CATEGORY_DESCRIPTION') ?>
        </div>
    </div>
   

    <?php // $form->field($model, 'CATEGORY_IMAGE') ?>

   

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<br/>
