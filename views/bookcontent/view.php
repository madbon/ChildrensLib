<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookContent */

$this->title = $model->BOOKCONTENT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Book Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-book-content-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->BOOKCONTENT_ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->BOOKCONTENT_ID], [
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
            'BOOKCONTENT_ID',
            'BOOKCOVER_ID',
            'BOOKPAGES_IMAGE',
            'IS_ACTIVE',
        ],
    ]) ?>

</div>
