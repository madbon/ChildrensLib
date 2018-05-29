<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\TblCategory;
use app\models\TblCategoryContent;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookCover */
/* @var $form yii\widgets\ActiveForm */
?>
<div>
    
</div>

<div class="tbl-book-cover-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); 
        // $catecontent=ArrayHelper::map( TblCategoryContent::find()->all(), 'CATEGORYCONTENT_ID','CATEGORYCONTENT_NAME' );
    ?>


 <?php
    echo $form->field($model, 'COLOR_VALUE')->widget(Select2::classname(), [
            'name' => 'COLOR_VALUE',
            'data' => $colors,
            'maintainOrder' => true, 
            'options' => ['placeholder' => 'Select ... ','multiple' => true /* true if multi-signatories */, 'required' => true],
            'pluginOptions' => [
                'tags' => true,
                'multiple' => true,
                'maximumInputLength' => 10 /* 2 or more if multi-signatories */
            ],
      ]);
 ?>
   

  

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
