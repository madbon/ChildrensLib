<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookCover */

$this->title = 'Update Book Cover: ' . $model->BOOK_TITLE;
$this->params['breadcrumbs'][] = ['label' => 'Book Covers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->BOOK_TITLE, 'url' => ['view', 'id' => $model->BOOKCOVER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-book-cover-update">

    <h4><?= Html::encode($this->title) ?></h4>
    <?= Html::a('Update Image', ['update-image', 'id' => $model->BOOKCOVER_ID], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Update Color', ['update-color', 'id' => $model->BOOKCOVER_ID], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Update Tags', ['update-tags', 'id' => $model->BOOKCOVER_ID], ['class' => 'btn btn-primary']) ?>
    

    <?= $this->render('_form', [
        'model' => $model,
        'items' => $items,
        // 'colors' => $colors,
        'language' => $language,
        'catecontent' => $catecontent,
    ]) ?>

</div>
