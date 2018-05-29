<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookCover */

$this->title = 'Update Tags of this Book: ' . $model->BOOK_TITLE;
$this->params['breadcrumbs'][] = ['label' => ' Book Covers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Details : ".$model->BOOK_TITLE, 'url' => ['view', 'id' => $model->BOOKCOVER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-book-cover-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_update_tags', [
        'model' => $model,
        'colors' => $colors,
        // 'varColor' => $varColor,
        
    ]) ?>

</div>
