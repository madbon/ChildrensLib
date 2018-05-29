<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\TblBookCover;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\BookcontentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-book-content-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'BOOKCONTENT_ID') ?>

    <?php $data = ArrayHelper::map(TblBookCover::find()->all(), 'BOOKCOVER_ID', 'BOOK_TITLE');
            echo $form->field($model, 'BOOKCOVER_ID')->widget(Select2::classname(), [
                'data' => $data,
                'options' => ['placeholder' => 'Select Title of the Book'],
                'pluginOptions' => [
                    'allowClear' => true
            ],]);

     ?>

    <?php // $form->field($model, 'BOOKPAGES_IMAGE') ?>

    <?php // $form->field($model, 'IS_ACTIVE') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
