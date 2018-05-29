<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookCover */

$this->title = 'Update Category Icon: ' . $model->CATEGORY_TITLE;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->CATEGORY_TITLE, 'url' => ['view', 'id' => $model->CATEGORY_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-book-cover-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update_image', [
        'model' => $model,
        
    ]) ?>

</div>
