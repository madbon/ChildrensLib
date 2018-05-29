<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblCategoryContent */

$this->title = 'Update Sub Category Image: ' . $model->CATEGORYCONTENT_NAME;
$this->params['breadcrumbs'][] = ['label' => 'Sub Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CATEGORYCONTENT_NAME, 'url' => ['view', 'id' => $model->CATEGORYCONTENT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-category-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update_image', [
        'model' => $model,
        
    ]) ?>

</div>
