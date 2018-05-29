<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblbookcoverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Book Covers and Information';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-book-cover-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Book Cover', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            // 'BOOKCOVER_ID',

            'BOOK_TITLE',
            // 'BOOK_AUTHOR',
            [
                'attribute' => 'CATEGORY_ID',
                'value' => 'category.CATEGORY_TITLE',
            ],
            // [
            //     'attribute' => 'CATEGORYCONTENT_ID',
            //     'value' => 'tblCategoryContent.CATEGORYCONTENT_NAME',
            // ],
            // [
            //     'attribute' => 'COLOR_VALUE',
            //     'value' => 'color.COLOR_NAME',
            // ],
            // 'COLOR_VALUE',
            
            [
                'attribute' => 'BOOKCOVER_IMAGE',
                'format' => 'html', 
                'label' => 'Book Cover',
                'value' => function ($data) {
                return Html::img(Yii::getAlias('@web').'/upload_bookcover/'.$data['BOOKCOVER_IMAGE'],
                    ['width' => '80', 
                     'height' => '100']);
            },
            
            ],
            // 'BOOK_ILLUSTRATOR',
            // 'BOOK_PUBLISHER',
            // 'BOOK_LANGUAGE',
            // 'BOOK_SUMMARY:ntext',
            // 'BOOK_DESCRIPTION:ntext',
            // 'BOOKCOUNT_PAGES',
            // 'IS_ACTIVE',

            ['class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {update}  {updatecolor} {updatetags} {updateimage} {delete} ', 
                'buttons'=>
                [    
                    'view' => function($url, $model){
                             return Html::a('<span class="glyphicon glyphicon-eye-open"></span> View Details', ['view', 
                                'id' => $model->BOOKCOVER_ID], ['class'=>'btn btn-info btn-xs btn-block']);
                    },
                    'update' => function($url, $model){
                         return Html::a('<span class="glyphicon glyphicon-edit"></span> Edit Details', ['update', 
                            'id' => $model->BOOKCOVER_ID], ['class'=>'btn btn-primary btn-xs btn-block']);
                    },
                    'updatecolor' => function($url, $model){
                         return Html::a('<span class="glyphicon glyphicon-edit""></span> Edit Color', ['update-color', 
                            'id' => $model->BOOKCOVER_ID], ['class'=>'btn btn-primary btn-xs btn-block']);
                    },
                    'updatetags' => function($url, $model){
                         return Html::a('<span class="glyphicon glyphicon-edit"></span> Edit Tags', ['update-tags', 
                            'id' => $model->BOOKCOVER_ID], ['class'=>'btn btn-primary btn-xs btn-block']);
                    },
                    'updateimage' => function($url, $model){
                         return Html::a('<span class="glyphicon glyphicon-picture" style="color:black;"></span> Update Book Cover Image', ['update-image', 
                            'id' => $model->BOOKCOVER_ID], ['class'=>'btn btn-default btn-xs btn-block']);
                    },
                    
                    'delete'=>function ($url, $model) 
                    {
                          return Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', 
                            [
                              'tblbookcover/delete', 'id' => $model->BOOKCOVER_ID
                            ], 
                            [
                              'class' => 'btn btn-danger btn-xs btn-block',
                              'data' => [
                                  'confirm' => 'Are you sure you want to delete this?',
                                  'method' => 'post']
                            ]);
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
