<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookCover */

$this->title = $model->BOOK_TITLE;
$this->params['breadcrumbs'][] = ['label' => 'Book Covers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-book-cover-view">

    <h1>Book Information: <?= Html::encode($this->title) ?></h1>



    <p>
        <?= Html::a('Update Book Information', ['update', 'id' => $model->BOOKCOVER_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update Book Cover', ['update-image', 'id' => $model->BOOKCOVER_ID], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update Color', ['update-color', 'id' => $model->BOOKCOVER_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update Tags', ['update-tags', 'id' => $model->BOOKCOVER_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->BOOKCOVER_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

   

    <div class="row">
        <div class="col-sm-6">
             <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'label' => 'Category Title',
                            'value' => !empty($model->category->CATEGORY_TITLE) ? $model->category->CATEGORY_TITLE : "",
                        ],
                        // 'tblCategoryContent.CATEGORYCONTENT_NAME',
                        // 'COLOR_VALUE',
                        // [
                        //     'label' => 'Color Value',
                        //     'value' => function($model){
                        //         $myString = $model->color->COLOR_NAME;
                        //         $myArray = explode(',', $myString);
                        //         foreach ($myArray as $rowColor) {
                                    
                        //             echo $rowColor;
                        //         }


                        //     },
                            
                        // ],
                        'BOOK_TITLE',
                        'BOOK_AUTHOR',
                        'BOOK_ILLUSTRATOR',
                        'BOOK_PUBLISHER',
                        // 'LANGUAGE_ID',
                        [
                            'attribute' => 'LANGUAGE_ID',
                            'value' => $model->language->LANGUAGE,
                        ],
                        'BOOKCOUNT_PAGES',
                        
                    ],
                ]) ?>
        </div>
        <div class="col-sm-6">

            <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'BOOKCOVER_IMAGE',
                            'format' => 'html', 
                            'label' => false,
                            'value' => function ($data) {
                            return Html::img(Yii::getAlias('@web').'/upload_bookcover/'.$data['BOOKCOVER_IMAGE'],
                                ['width' => '200', 
                                 'height' => '300']);
                        },
                        ],
                    ],
                ]) ?>
                
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <p>
                <h3>Summary</h3>
                <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'BOOK_SUMMARY:ntext',
                            ],
                        ]) ?>
            </p>
        </div>
        <div class="col-sm-6">
            <p>
                <h3>Decription</h3>
                <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'BOOK_DESCRIPTION',
                            ],
                        ]) ?>
            </p>
        </div>
    </div>
    
    

    <br/>

    <?= Html::a('Delete All Pages', ['delete-pages', 'id' => $model->BOOKCOVER_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'BOOKCONTENT_ID',
            // [
            //     'attribute' => 'BOOKCOVER_ID',
            //     'value' => 'bookcover.BOOK_TITLE',
            // ],
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

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
