<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookcontentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Book Contents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-book-content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Upload Book Content', ['multiple'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'BOOKCONTENT_ID',
            [
                'attribute' => 'BOOKCOVER_ID',
                'value' => 'bookcover.BOOK_TITLE',
            ],
            [
                'attribute' => 'BOOKPAGES_IMAGE',
                'format' => 'html', 
                'label' => 'Book Cover',
                'value' => function ($data) {
                return Html::img(Yii::getAlias('@web').'/upload_bookcontentimages/'.$data['BOOKPAGES_IMAGE'],
                    ['width' => '80', 
                     'height' => '100']);
            },
            
            ],
            // 'IS_ACTIVE',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
