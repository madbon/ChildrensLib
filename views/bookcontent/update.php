<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookContent */

$this->title = 'Update Tbl Book Content: ' . $model->BOOKCONTENT_ID;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Book Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->BOOKCONTENT_ID, 'url' => ['view', 'id' => $model->BOOKCONTENT_ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-book-content-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
