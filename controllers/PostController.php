<?php

class PostController extends AbstractController {
 
	public function actionList(){
		$numPerPage = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $countRecords = Table::getCountRecords($this->tableName);
        $totalPages = intval(($countRecords - 1)/$numPerPage)+1;
        if(empty($page) or $page < 0) $page = 1;
        if($page > $totalPages) $page = $totalPages;
		$start = $page*$numPerPage - $numPerPage;
		$rows = Table::getAllRecords($this->tableName, $start, $numPerPage);
		$pagination = $this->pagination($page, $totalPages);
    	$this->render('jokes.html.php', ['rows' => $rows, 'pagination' => $pagination]);	
	}
	public function actionAdd(){
		if(isset($_POST['submit'])){
		  $title = $this->test_html($_POST['title']);
		  $body = $this->test_html($_POST['body']);
		  if($title == '' || $body == ''){
		  	$form_error = "Requied fields are empty";
			$this->render('add.html.php');
		   }
		   $post = new Post($title,$body);
		   Table::save($post);
		   
		  $this->redirect('/posts');
		  exit();

		}
		$this->render('add.html.php', ['class' => $this->tableName]);

	}
	public function actionFind()
	{
		global $pdo;
		if(isset($_POST['find'])){
			$find = $this->test_html($_POST['find']);
			$rows = Table::getFindRecords('posts','title', $find);
			if(count($rows) == 0){
				$find = "По вашему запросу &quot;$find&quot; ничего не найдено";
				$this->render('jokes.html.php', ['find' => $find]);
			}
			$this->render('jokes.html.php', ['rows' => $rows, 'find' => $find]);
		} 
	}
}
