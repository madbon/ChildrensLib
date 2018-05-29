

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\TblBookContent */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Create Book Content';
$this->params['breadcrumbs'][] = ['label' => 'Book Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

/* $form->field($upload, 'BOOKCOVER_ID')->dropDownList($bookcover) */

?>

<div class="row">
	<div class="col-lg-6">
		<div class="tbl-book-content-form">
			<h1><?= Html::encode($this->title) ?></h1>
			<br/>

			<!-- <div class="tbl-book-content-index"> -->
		 	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

		    <?= $form->field($upload, 'BOOKCOVER_ID')->hiddenInput() ?>	

		    <h3 id="book-title"></h3>
		    <br/>

		    <?= $form->field($upload, 'BOOKPAGES_IMAGE[]')->fileInput(['multiple'=>true]) ?>

		    <div class="form-group">
		        <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
		    </div>
		    <?php ActiveForm::end(); ?>
			<!-- </div> -->
		</div>
	</div>
	<div class="col-lg-6">
		<?php Pjax::begin() ?>
			 <?= GridView::widget([
			        'dataProvider' => $dataProvider,
			        'filterModel' => $searchModel,
			        'tableOptions' => [
			        // 'class'=>'ekek',
			        'id' => 'multipletablebookcontent'
			        ],
			        'id' => 'multipleid',
			        'columns' => [
			            ['class' => 'yii\grid\SerialColumn'],
			           	'BOOKCOVER_ID',
			            'BOOK_TITLE',
			            'BOOK_AUTHOR',
			            [
			                'attribute' => 'BOOKCOVER_IMAGE',
			                'format' => 'html', 
			                'label' => 'Book Cover',
			                'value' => function ($data) {
			                return Html::img(Yii::getAlias('@web').'/upload_bookcover/'.$data['BOOKCOVER_IMAGE'],
			                    ['width' => '80', 
			                     'height' => '100']);
			            },
			            
			            ],

			            // ['class' => 'yii\grid\ActionColumn'],
			        ],
			    ]); ?>
		 <?php Pjax::end() ?>
	</div>
</div>


  
