<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblCategory */

$this->title = 'Create Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_create_category', [
        'model' => $model,
    ]) ?>

</div>
