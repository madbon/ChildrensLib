<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\TblCategory */

$this->title = $model->CATEGORY_TITLE;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-category-view">

    <h1>Details: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->CATEGORY_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update Image', ['update-image', 'id' => $model->CATEGORY_ID], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->CATEGORY_ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'CATEGORY_ID',
            'CATEGORY_TITLE',
            [
                'attribute' => 'CATEGORY_IMAGE',
                'format' => 'html', 
                'label' => 'Category Image',
                'value' => function ($data) {
                return Html::img(Yii::getAlias('@web').'/upload_categoryimages/'.$data['CATEGORY_IMAGE'],
                    ['width' => '100', 
                     'height' => '100']);
            },

            ],
            'CATEGORY_DESCRIPTION:ntext',
            
        ],
    ]) ?>
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CATEGORYCONTENT_ID',
            'category.CATEGORY_TITLE',
            'CATEGORYCONTENT_NAME',
            'CATEGORYCONTENT_IMAGE',
            // 'IS_ACTIVE',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
