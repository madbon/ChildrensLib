<?php 

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Search;
 use yii\helpers\Url;




class SearchbookController extends Controller {



    
	public function actionIndex()
    {
    	$this->layout = 'levislayout';
        return $this->render('search');
    }


    public function actionCategories() {
    	$request = Yii::$app->request;
    	$model = new Search();
    	$model->getAllCategories();
    	$array = array();
    	foreach ($model->getResult() as $value) {
    		array_push($array, array(
    								 'id' => $value['id'],
    								 'name' => $value['name'],
    								 'image' => Url::to('@web/upload_categoryimages/') . $value['image']
    								));
    	}

    	echo json_encode($array);
    }


    public function actionFirstbooks() {
        $request = Yii::$app->request;
        $model = new Search();
        $model->getBooks();
        $array = array();
        foreach ($model->getResult() as $value) {
            array_push($array, array(
                                     'id' => $value['id'],
                                     'title' => $value['title'],
                                     'image' => Url::to('@web/upload_bookcover/') . $value['image'],
                                     'author' => $value['author']
                                    ));
        }

        echo json_encode($array);
    
    } 

    public function actionGetbooksbyoffset() {
        $request = Yii::$app->request;
        $offset = $request->get('offset');
        $model = new Search();
        $model->getBooks($offset);
        $array = array();
        foreach ($model->getResult() as $value) {
            array_push($array, array(
                                     'id' => $value['id'],
                                     'title' => $value['title'],
                                     'image' => Url::to('@web/upload_bookcover/') . $value['image'],
                                     'author' => $value['author']
                                    ));
        }

        echo json_encode($array);
    
    } 

}


 ?>