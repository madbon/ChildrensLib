<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TblCategoryContent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-category-content-form">

	<p>
		<?= Html::a('Update Image', ['update-image', 'id' => $model->CATEGORYCONTENT_ID], ['class' => 'btn btn-success']) ?>
	</p>

    <?php $form = ActiveForm::begin(); ?>


    <?php
        echo $form->field($model, 'CATEGORY_ID')->widget(Select2::classname(), [
            'data' => $category,
            'language' => 'de',
            'options' => ['placeholder' => 'Select a state ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label("Category");
    ?>

    <?= $form->field($model, 'CATEGORYCONTENT_NAME')->textInput(['maxlength' => true])->label("Sub Category Name") ?>

    <?= $form->errorSummary($model); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
