<?php

class GirlController extends AbstractController{
    public function actionList()
    {
        $numPerPage = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $countRecords = Table::getCountRecords($this->tableName);
        $totalPages = intval(($countRecords - 1)/$numPerPage)+1;
        if(empty($page) or $page < 0) $page = 1;
        if($page > $totalPages) $page = $totalPages;
        $start = $page*$numPerPage - $numPerPage;
        $rows = [];
        $categories = Table::getAllRecords('categories');

        if(isset($_GET['cat'])){
            $cat = (int) $_GET['cat'];
            $rows = Table::getRecordsByColumn($this->tableName, 'category', $cat);
            $this->render('girls.html.php', ['rows' => $rows,
            'categories' => $categories, 'cat' => $cat]);
        } else {
		    $rows = Table::getAllRecords($this->tableName, $start, $numPerPage);
            $pagination = $this->pagination($page, $totalPages);
            $this->render('girls.html.php', ['rows' => $rows,
            'pagination' => $pagination, 'categories' => $categories]);
        }
    }
    public function actionDetail()
    {
        $img = $_GET['img'];
        if(file_exists('img/'.$img)){
        $image = imagecreatefromjpeg('img/'.$img);
        header("Content-type: image/jpeg");
        imagejpeg($image);
        imagedestroy($image);
        } else {
          $this->render('detail.html.php', ['img' => $img]);
       }
    }
}