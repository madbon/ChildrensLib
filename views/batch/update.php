<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBatch */

$this->title = 'Update Tbl Batch: ' . $model->BATCH_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->BATCH_ID, 'url' => ['view', 'id' => $model->BATCH_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-batch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
