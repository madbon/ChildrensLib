<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookCover */

$this->title = 'Update Book Cover: ' . $model->BOOK_TITLE;
$this->params['breadcrumbs'][] = ['label' => 'Book Covers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->BOOK_TITLE, 'url' => ['view', 'id' => $model->BOOKCOVER_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-book-cover-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'BOOKCOVER_IMAGE',
                            'format' => 'html', 
                            'label' => 'Book Cover',
                            'value' => function ($data) {
                            return Html::img(Yii::getAlias('@web').'/upload_bookcover/'.$data['BOOKCOVER_IMAGE'],
                                ['width' => '200', 
                                 'height' => '300']);
                        },
                        ],
                    ],
                ]) ?>

    <?= $this->render('_form_update_image', [
        'model' => $model,
        
    ]) ?>

</div>
