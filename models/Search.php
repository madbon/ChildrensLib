<?php 

namespace app\models;

use Yii;
use yii\base\Model;

class Search extends Model {

	private $result;

	public function getAllCategories() {
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("SELECT CATEGORY_ID AS id, CATEGORY_TITLE AS name, CATEGORY_IMAGE AS image FROM tbl_category WHERE IS_ACTIVE = 1");
		$this->result = $command->queryAll();
	}

	public function getResult() {
		return $this->result;
	}


	public function getBooks($offset = 0) {
		$connection = Yii::$app->getDb();
		$command = $connection->createCommand("SELECT BOOKCOVER_ID AS id, BOOK_TITLE AS title, BOOKCOVER_IMAGE AS image, BOOK_AUTHOR AS author FROM tbl_book_cover WHERE IS_ACTIVE = 1 LIMIT 6 OFFSET {$offset}");
		$this->result = $command->queryAll();
	}



}





 ?>