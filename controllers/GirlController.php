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
            $rows = [];
            $girls = Table::getRecordsByColumn($this->tableName, 'category', $cat);
            foreach ($girls as $girl) {
                $country = Table::getRecordById('countries', $girl['country']);
                $girl['country'] = $country['name'];
                $category = Table::getRecordById('categories', $girl['category']);
                $girl['category'] = $category['name'];
                $rows[] = $girl;
            }
            $this->render('girls.html.php', ['girls' => $rows,
            'categories' => $categories, 'cat' => $cat]);
        } else {
            $rows = [];
		        $girls = Table::getAllRecords($this->tableName, $start, $numPerPage);
        foreach ($girls as $girl) {
              $country = Table::getRecordById('countries', $girl['country']);
              $girl['country'] = $country['name'];
              $category = Table::getRecordById('categories', $girl['category']);
              $girl['category'] = $category['name'];
              $rows[] = $girl;
        }
            $pagination = $this->pagination($page, $totalPages);
            $this->render('girls.html.php', ['girls' => $rows,
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
