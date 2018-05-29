<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblBatch */

$this->title = 'Import CSV (Book Information)';
// $this->params['breadcrumbs'][] = ['label' => 'Tbl Batches', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-batch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
