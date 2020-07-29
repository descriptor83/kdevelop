<?php

class AdminController extends AbstractController{
    public function actionIndex()
    {
        if(!User::isLogged()){
            $this->redirect('/login');
        }
        if(!User::isAdmin()){
            $this->render('error.html.php', ['access' => 0]);
        }
        $this->render('admin/admin.html.php');
    }
    public function actionPosts()
    {
        $posts = Table::getAllRecords('posts');
        $this->render('admin/posts.html.php', array('posts' => $posts));
    }
    public function actionGirls()
    {
        $girls = Table::getAllRecords('girls');
        $rows = [];
        foreach ($girls as $girl) {
          $country = Table::getRecordById('countries', $girl['country']);
          $girl['country'] = $country['name'];
          $category = Table::getRecordById('categories', $girl['category']);
          $girl['category'] = $category['name'];
          $rows[] = $girl;
        }
        $this->render('admin/girls.html.php', ['girls' => $rows]);
    }
    public function actionUsers()
    {
        $users = Table::getAllRecords('users');
        $this->render('admin.html.php', ['users' => $users]);
    }
    public function actionCountries()
    {
        $countries = Table::getAllRecords('countries');
        $this->render('admin/countries.html.php', ['countries' => $countries]);
    }
    public function actionCategories()
    {
        $categories = Table::getAllRecords('categories');
        $this->render('admin/categories.html.php', ['categories' => $categories]);
    }
    public function actionGirledit()
    {
        $countries = Table::getAllRecords('countries');
        $categories = Table::getAllRecords('categories');
        if(isset($_POST['submit'])){
            $id = (int) $_POST['id'];
            $name = $this->test_html($_POST['name']);
            $age = (int) $_POST['age'];
            $country = $this->test_html($_POST['country']);
            $category = (int) $_POST['category'];
            $price = (float)$_POST['price'];
            $img = $_POST['img'];

            $girl = new Girl($name, $age, $country, $category,$price, $img);
            $girl->id = $id;

            if(isset($_FILES['image']) and $_FILES['image']['size'] > 0){
                if(Table::uploadImage($_FILES['image'])){
                    $girl->img = $_FILES['image']['name'];
                    if(!Table::uploadThumbnail($_FILES['image']['name'])){
                        $error = "Error creating thumbnail";
                        $this->render('admin/editgirl.html.php', compact('error'));
                    }
                }
            }
            Table::update($girl);
            $girl = Table::getRecordById('girls', $id);

            $this->render('admin/editgirl.html.php',
             ['girl' => $girl, 'countries' => $countries, 'categories' => $categories]);
        }
        $id = (int) $_GET['id'];
        $girl = Table::getRecordById('girls',$id);
        $this->render('admin/editgirl.html.php',
         ['girl' => $girl, 'countries' => $countries, 'categories' => $categories]);
    }
    public function actionPostedit()
    {
        if(isset($_POST['submit'])){
            $id = (int)$_POST['id'];
            $title = $this->test_html($_POST['title']);
            $body = $this->test_html($_POST['body']);
            $created = $_POST['created'];
            $post = new Post($title,$body);
            $post->id = $id;
            $post->created = $created;
            Table::update($post);
            $this->redirect('/editpost?id='.$id);
        }
        $id = (int)$_GET['id'];
        $post = Table::getRecordById('posts', $id);
        $this->render('admin/editpost.html.php', array('post' => $post));
    }
    public function actionGirladd()
    {
        $countries = Table::getAllRecords('countries');
        $categories = Table::getAllRecords('categories');
    	if(isset($_POST['submit'])){
    		$name = $this->test_html($_POST['name']);
			if($name == ''){
				$error = 'Name is empty';
				$this->render('admin/addgirl.html.php', compact('error','countries','categories'));
			}

            $age = (int) $_POST['age'];
			if($age == 0){
				$error = 'Age is empty';
				$this->render('admin/addgirl.html.php', compact('error','countries','categories'));
			}
            $country = $this->test_html($_POST['country']);
			if($country == ''){
				$error = 'Country is empty';
				$this->render('admin/addgirl.html.php', compact('error','countries','categories'));
			}
            $category = (int) $_POST['category'];
			if($category == 0){
				$error = 'Category is empty';
				$this->render('admin/addgirl.html.php', compact('error','countries','categories'));
			}

            $price = (float)$_POST['price'];
			if($price == 0){
				$error = 'Price is empty';
				$this->render('admin/addgirl.html.php', compact('error','countries','categories'));
			}
            $girl = new Girl($name,$age,$country,$category,$price);

            if(isset($_FILES['image']) and $_FILES['image']['size'] > 0){
                if(Table::uploadImage($_FILES['image'])){
                    $girl->img = $_FILES['image']['name'];
                    if(!Table::uploadThumbnail($_FILES['image']['name'])){
                        $error = "Error creating thumbnail";
                        $this->render('admin/addgirl.html.php', compact('error','countries','categories'));
                    }
                } else {
                    $error = 'Error loading iamge';
                    $this->render('admin/addgirl.html.php', compact('error','countries','categories'));
                }
            }
            $id = Table::save($girl);
            $this->redirect('/admingirls');

    	}
        $this->render('admin/addgirl.html.php', compact('countries','categories'));
    }
    public function actionPostadd()
    {
        if(isset($_POST['submit'])){
            $title = $this->test_html($_POST['title']);
            if(empty($title)){
                $error = 'Title is empty';
                $this->render('editpost.html.php', array('error' => $error));
            }
            $body = $this->test_html($_POST['body']);
            if(empty($body)){
                $error = 'Body is empty';
                $this->render('editpost.html.php', array('error' => $error));
            }
            $created = $this->test_html($_POST['created']);
            if(!$this->isDateValid($created)){
                $error = 'Date is not valid';
                $this->render('editpost.html.php', array('error' => $error));
            }
            $post = new Post($title, $body, $created);
            $id = Table::save($post);
            $this->redirect('/editpost?id='.$id);


        }
        $this->render('editpost.html.php');
    }
    public function actionCountryadd()
    {
        if(isset($_POST['submit'])){
            $id = $this->test_html($_POST['id']);
            $name = $this->test_html($_POST['name']);
            if(empty($id) or empty($name)){
                $this->render('admin/countries.html.php', ['error' => 'Field is empty']);
            }
            $country = new Country($id, $name);
            try{
                Table::save($country);
             } catch(PDOException $e){
                 session_start();
                 $_SESSION['error'] = $e->getMessage();
                 $this->redirect('/admincountries');
             }
            $this->redirect('/admincountries');
        }
    }
    public function actionCategoryadd()
    {
        if(isset($_POST['submit'])){

            $name = $this->test_html($_POST['name']);
            $cat = Table::getRecordsByColumn('categories','name',$name);
            if(empty($name)){
                $this->saveInSession('Empty name field','/admincategories');
            }

            if($cat){
                $this->saveInSession('Category already exists', '/admincategories');
            }
            $category = new Category($name);
            try{
                Table::save($category);
             } catch(PDOException $e){
                 $this->saveInSession($e->getMessage(),'/admincategories');
             }
            $this->redirect('/admincategories');

        }
    }
    public function actionCategoryedit()
    {

        if(isset($_POST['submit'])){
            $id = (int)$_POST['id'];
            $name = $this->test_html($_POST['name']);
            if(empty($name)){
                $this->saveInSession('Name is empty', '/editcategory?id='.$id);
            }
            $category = new Category($name);
            $category->id = $id;
        try {
            Table::update($category);
        } catch (PDOException $e) {
            $this->saveInSession($e->getMessage(), '/editcategory?id='.$id);
        }
        $this->redirect('/admincategories');
        }
        $id = (int)$_GET['id'];
        $category = Table::getRecordById('categories', $id);
        $this->render('admin/editcategory.html.php', ['category' => $category]);
    }
    public function actionCategorydelete()
    {
        $id = (int)$_GET['id'];
        $category = new Category('name');
        $category->id = $id;
        Table::delete($category);
        $this->redirect('/admincategories');
    }
	public function actionGirldelete()
    {
        $id = (int) $_GET['id'];
        $row = Table::getRecordById('girls', $id);
        $girl = new Girl($row['name'], $row['age'], $row['country'],
        $row['category'], $row['price'], $row['img']);
        $girl->id = $id;
        if($girl->img != 'noimage.jpg'){
            $path = ROOT.'/img/'.$girl->img;
            if(file_exists($path)){
                unlink($path);
            }
        }
        Table::delete($girl);
        $this->redirect('/admingirls');
    }
    public function actionPostdelete()
    {
        $id = (int) $_GET['id'];
        $row = Table::getRecordById('posts', $id);
        $post = new Post($row['title'], $row['body']);
        $post->id = $id;

        Table::delete($post);
        $this->redirect('/adminposts');
    }





















}
