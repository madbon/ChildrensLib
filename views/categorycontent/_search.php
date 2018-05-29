<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TblCategory;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\CategorycontentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-category-content-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?php 
                    $data = ArrayHelper::map(TblCategory::find()->all(), 'CATEGORY_ID', 'CATEGORY_TITLE');
                    echo $form->field($model, 'CATEGORY_ID')->widget(Select2::classname(), [
                        'data' => $data,
                        'options' => ['placeholder' => 'Select Category'],
                        'pluginOptions' => [
                            'allowClear' => true
                    ],])->label("Category"); 
            ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'CATEGORYCONTENT_NAME')->label('Sub Category') ?>
        </div>
    </div>


    <?php // $form->field($model, 'CATEGORYCONTENT_ID')->label('Category') ?>    

    

    
    <?php // $form->field($model, 'IS_ACTIVE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
