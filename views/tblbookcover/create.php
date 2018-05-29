<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblBookCover */

$this->title = 'Create book cover';
$this->params['breadcrumbs'][] = ['label' => 'Book Covers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-book-cover-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_insert_text', [
        'model' => $model,
         'items' => $items,
         'colors' => $colors,
         'language' => $language,
         'catecontent' => $catecontent,
        
    ]) ?>

</div>
