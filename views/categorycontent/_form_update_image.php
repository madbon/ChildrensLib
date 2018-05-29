<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TblCategoryContent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-category-content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'CATEGORYCONTENT_IMAGE')->fileInput()->label("Upload Image") ?>   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
