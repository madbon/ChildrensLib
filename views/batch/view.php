<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblBatch */

$this->title = $model->BATCH_ID;
$this->params['breadcrumbs'][] = ['label' => 'Import CSV', 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-batch-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'BATCH_ID',
            'BATCH',
            'FILE_IMPORT',
        ],
    ]) ?>

</div>
