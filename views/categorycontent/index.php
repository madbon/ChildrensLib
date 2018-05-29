<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorycontentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sub Categories';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-category-content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sub Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'CATEGORYCONTENT_ID',
            [
                'label' => 'Category',
                'attribute' => 'CATEGORY_ID',
                'value' => 'category.CATEGORY_TITLE',
            ],
            [
                'label' => 'Sub Category',
                'attribute' => 'CATEGORYCONTENT_NAME',
            ],
            [
                'attribute' => 'CATEGORYCONTENT_IMAGE',
                'format' => 'html', 
                'label' => 'Sub Category Image',
                'value' => function ($data) {
                return Html::img(Yii::getAlias('@web').'/upload_categorycontentimages/'.$data['CATEGORYCONTENT_IMAGE'],
                    ['width' => '100', 
                     'height' => '70']);
            },
            
            ],
            

            ['class' => 'kartik\grid\ActionColumn', 
                'template' => '{view} {update} {updateimage} {delete} ', 
                'buttons'=>
                [    
                    'view' => function($url, $model){
                             return Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 
                                'id' => $model->CATEGORYCONTENT_ID], ['class'=>'btn btn-info btn-xs btn-block']);
                    },
                    'update' => function($url, $model){
                         return Html::a('<span class="glyphicon glyphicon-edit"></span> Edit', ['update', 
                            'id' => $model->CATEGORYCONTENT_ID], ['class'=>'btn btn-primary btn-xs btn-block']);
                    },
                    'updateimage' => function($url, $model){
                         return Html::a('<span class="glyphicon glyphicon-picture" style="color:black;"></span> Update Icon', ['update-image', 
                            'id' => $model->CATEGORYCONTENT_ID], ['class'=>'btn btn-default btn-xs btn-block']);
                    },
                    'delete'=>function ($url, $model) 
                    {
                          return Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', 
                            [
                              'categorycontent/delete', 'id' => $model->CATEGORYCONTENT_ID
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
</div>
