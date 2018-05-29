<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TblBookContent */

$this->title = 'Create Tbl Book Content';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Book Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-book-content-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        
        
    ]) ?>

</div>
