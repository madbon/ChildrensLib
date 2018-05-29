<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookCover */
/* @var $form yii\widgets\ActiveForm */
?>
<div>
    
</div>
<div class="tbl-book-cover-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="row">
        <div class="col-sm-6">
            <?php
                echo $form->field($model, 'CATEGORY_ID')->widget(Select2::classname(), [
                    'data' => $items,
                    'language' => 'de',
                    'options' => ['placeholder' => 'Select a category ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
            

            <?= $form->field($model, 'BOOK_TITLE')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'BOOK_AUTHOR')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'BOOK_ILLUSTRATOR')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'BOOK_PUBLISHER')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'BOOK_PUBLICATIONDATE')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'LANGUAGE_ID')->dropDownList($language) ?>
        </div>
        <div class="col-sm-6">
            

            <?= $form->field($model, 'BOOK_SUMMARY')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'BOOK_DESCRIPTION')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'ISBN')->textInput() ?>

            <?= $form->field($model, 'LOCATION')->textInput() ?>

            <?= $form->field($model, 'CODELIBRARY')->textInput() ?>

            <?= $form->field($model, 'BOOKCOUNT_PAGES')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
