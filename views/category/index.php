<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'CATEGORY_ID',
            'CATEGORY_TITLE',
            [
                'attribute' => 'CATEGORY_IMAGE',
                'format' => 'html', 
                'label' => 'Icon',
                'value' => function ($data) {
                return Html::img(Yii::getAlias('@web').'/upload_categoryimages/'.$data['CATEGORY_IMAGE'],
                    ['width' => '100', 
                     'height' => '100']);
            },
            
            ],
            'CATEGORY_DESCRIPTION:ntext',
            

            ['class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {update} {updateimage} {delete} ', 
                'buttons'=>
                [    
                    'view' => function($url, $model){
                             return Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 
                                'id' => $model->CATEGORY_ID], ['class'=>'btn btn-info btn-xs btn-block']);
                    },
                    'update' => function($url, $model){
                         return Html::a('<span class="glyphicon glyphicon-edit"></span> Edit', ['update', 
                            'id' => $model->CATEGORY_ID], ['class'=>'btn btn-primary btn-xs btn-block']);
                    },
                    'updateimage' => function($url, $model){
                         return Html::a('<span class="glyphicon glyphicon-picture" style="color:black;"></span> Update Icon', ['update-image', 
                            'id' => $model->CATEGORY_ID], ['class'=>'btn btn-default btn-xs btn-block']);
                    },
                    'delete'=>function ($url, $model) 
                    {
                          return Html::a('<i class="glyphicon glyphicon-trash"></i> Delete', 
                            [
                              'category/delete', 'id' => $model->CATEGORY_ID
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
