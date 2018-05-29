<?php
/**
 * Created by PhpStorm.
 * User: levibeverly
 * Date: 28/10/2017
 * Time: 11:15 AM
 */

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\helpers\Url;
use app\models\TblColor;
use app\models\TblCategory;
use app\models\TblBookCover;
use app\models\TblCategoryContent;
use app\models\TblBookContent;


class BrowsebookController extends Controller
{
    public function actionIndex()
     {
         Yii::$app->view->title = "Childrens Library";
         $this->layout = "browsebooklayout";
         // $colors = TblColor::find()->select([
         //                                        "id" => "COLOR_ID",
         //                                      "name" =>"COLOR_NAME",
         //                                     "value" => "COLOR_VALUE"
         //                                    ])
         //                           ->where(["IS_ACTIVE" => 1])
         //                           ->all();
         $category = TblCategory::find()->select([
                                                      "id" => "CATEGORY_ID",
                                                   "title" => "CATEGORY_TITLE",
                                                   "image" => "CATEGORY_IMAGE",
                                             "description" => "CATEGORY_DESCRIPTION"
                                                 ])
                                        ->where(["IS_ACTIVE" => 1])
                                        ->all();

         array_unshift($category, (object) [           "id" => 0,
                                                    "title" => "Colors",
                                                    "image" => "color", 
                                              "description" => ""
                                  ]);                           
         return $this->render("browse", [ "categories"  => $category ]);
     }

     function actionSearchbytitle() {
      $search = Yii::$app->request->get("search");
      $query = TblBookCover::find()->select([
                                                     "id" => "BOOKCOVER_ID",
                                                  "image" => "BOOKCOVER_IMAGE",
                                                  "title" => "BOOK_TITLE",
                                                 "author" => "BOOK_AUTHOR",
                                               "colorTag" => "COLOR_VALUE",
                                            "categoryTag" => "CATEGORYCONTENT_ID"
                                               ])
                                     ->where(["=", "IS_ACTIVE", 1])
                                     ->where(["like", "BOOK_TITLE", $search])->all();

      echo json_encode($query);
     }



     function actionPaginatebook()
     {
         $request = Yii::$app->request;
         $query = TblBookCover::find()->select([
                                                     "id" => "BOOKCOVER_ID",
                                                  "image" => "BOOKCOVER_IMAGE",
                                                  "title" => "BOOK_TITLE",
                                                 "author" => "BOOK_AUTHOR",
                                               "colorTag" => "COLOR_VALUE",
                                            "categoryTag" => "CATEGORYCONTENT_ID"
                                               ])
                                     ->where(["IS_ACTIVE" => 1]);
         $countQuery = clone $query;
         $pages = new Pagination(['totalCount' => $countQuery->count()]);
         $pages->pageSize = 6;
         $offset = count($request->get()) > 0 ? $request->get("offset") : 0;
         $models = $query->offset($offset)->limit($pages->limit)->all();
         echo json_encode($models);
     }


     function actionBookdescription() {
        Yii::$app->view->title = "Childrens Library";
        $this->layout = "bookdescriptionlayout";
        $id = Yii::$app->request->get("id");
        $data = TblBookCover::findOne($id);
        $boocontent = TblBookContent::find()->where(["BOOKCOVER_ID" => $id])->all();
        return $this->render("description", ["description" => $data, "bookcontent" => $boocontent]);
        
     }


     function actionQueryfilterbycolor() {
        $id = Yii::$app->request->get("id");
        $query = "SELECT * FROM tbl_book_cover WHERE COLOR_VALUE LIKE '%". $id ."%'";
        $this->findInBookCoverTbl($query, "COLOR_VALUE", $id);
     }

     function actionQueryfilterbycategory() {
       $id = Yii::$app->request->get("id");
       $query = "SELECT * FROM tbl_book_cover WHERE CATEGORYCONTENT_ID LIKE '%". $id ."%'";
       $this->findInBookCoverTbl($query, "CATEGORYCONTENT_ID", $id);
     }

     function actionGetsubcategories() {


        $id = Yii::$app->request->get("id");
        $query = null;
        switch ($id) {
          case 0:
            $query = TblColor::find()->select([
                                                "id" => "COLOR_ID",
                                              "name" =>"COLOR_NAME",
                                             "value" => "COLOR_VALUE"
                                            ])
                                   ->where(["IS_ACTIVE" => 1])
                                   ->all();
            break;
          default:
            $query = TblCategoryContent::find()->select([
                                                      "id" => "CATEGORYCONTENT_ID",
                                                    "name" => "CATEGORYCONTENT_NAME",
                                                   "image" => "CATEGORYCONTENT_IMAGE"
                                                    ])
                                                  ->where(["IS_ACTIVE" => 1, "CATEGORY_ID" => $id])->all();
            break;
        }

        echo json_encode($query);
     }


     function actionQueryfilterwhenremove() {
        $count = false;
        $query = "SELECT * FROM tbl_book_cover WHERE ";
        if(Yii::$app->request->get("idOfCat")) {
            $count = true;
            $query .= "CATEGORYCONTENT_ID LIKE '%". Yii::$app->request->get("idOfCat") ."%'";
        }

        if(Yii::$app->request->get("idOfColor")) {
           if($count) {
              $query .= " AND ";
           }
           $query .= "COLOR_VALUE LIKE '". Yii::$app->request->get("idOfColor") ."%'";
        }

      
        $data = TblBookCover::findBySql($query)->all();
        $newData = array();
        foreach ($data as $value) {
          array_push($newData, [
                                     "id" => $value->BOOKCOVER_ID,
                                  "image" => $value->BOOKCOVER_IMAGE,
                                  "title" => $value->BOOK_TITLE,
                                 "author" => $value->BOOK_AUTHOR,
                               "colorTag" => $value->COLOR_VALUE,
                            "categoryTag" => $value->CATEGORYCONTENT_ID
                                 ]);
        }

        echo json_encode($newData);
     }

     private function findInBookCoverTbl($query, $column, $id) {
      $data = TblBookCover::findBySql($query)->all();
       $newData = array();
       foreach ($data as $value) {
         $temp = explode(',', $value->$column);
         if(in_array($id, $temp)) {
            array_push($newData, [
                                     "id" => $value->BOOKCOVER_ID,
                                  "image" => $value->BOOKCOVER_IMAGE,
                                  "title" => $value->BOOK_TITLE,
                                 "author" => $value->BOOK_AUTHOR,
                               "colorTag" => $value->COLOR_VALUE,
                            "categoryTag" => $value->CATEGORYCONTENT_ID
                                 ]);
         }
       }

       echo json_encode($newData);
     }
}



