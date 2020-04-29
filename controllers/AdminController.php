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
        $this->render('admin/girls.html.php', ['girls' => $girls]);
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
    public function actionGirledit()
    {
        $countries = Table::getAllRecords('countries');
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
             ['girl' => $girl, 'countries' => $countries]);
        }
        $id = (int) $_GET['id'];
        $girl = Table::getRecordById('girls',$id);
        $this->render('admin/editgirl.html.php',
         ['girl' => $girl, 'countries' => $countries]);
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
    	if(isset($_POST['submit'])){
    		$name = $this->test_html($_POST['name']);
			if($name == ''){
				$error = 'Name is empty';
				$this->render('admin/editgirl.html.php', compact('error','countries'));
			}

            $age = (int) $_POST['age'];
			if($age == 0){
				$error = 'Age is empty';
				$this->render('admin/editgirl.html.php', compact('error','countries'));
			}
            $country = $this->test_html($_POST['country']);
			if($country == ''){
				$error = 'Country is empty';
				$this->render('admin/editgirl.html.php', compact('error','countries'));
			}
            $category = (int) $_POST['category'];
			if($category == 0){
				$error = 'Category is empty';
				$this->render('admin/editgirl.html.php', compact('error','countries'));
			}

            $price = (float)$_POST['price'];
			if($price == 0){
				$error = 'Price is empty';
				$this->render('admin/editgirl.html.php', compact('error','countries'));
			}
            $girl = new Girl($name,$age,$country,$category,$price);

            if(isset($_FILES['image']) and $_FILES['image']['size'] > 0){
                if(Table::uploadImage($_FILES['image'])){
                    $girl->img = $_FILES['image']['name'];
                    if(!Table::uploadThumbnail($_FILES['image']['name'])){
                        $error = "Error creating thumbnail";
                        $this->render('admin/editgirl.html.php', compact('error'));
                    }
                } else {
                    $error = 'Error loading iamge';
                    $this->render('admin/editgirl.html.php', compact('error'));
                }
            }
            $id = Table::save($girl);
            $this->redirect('/editgirl?id='.$id);

    	}
        $this->render('admin/editgirl.html.php', ['countries' => $countries]);
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
