<?php

class UserController extends AbstractController{
    public function actionRegister()
    {
        if(isset($_POST['submit'])){
            
            $name = $this->test_html($_POST['name']);
            if($name == ''){
                $errors = 'Name is empty';
                $this->render('register.html.php',compact('errors','email'));
            }
            
            $email = $this->test_html($_POST['email']);
            if($email == ''){
                $errors = 'Email is empty';
                $this->render('register.html.php',compact('errors','name'));
            }
            
                 
            $password = $this->test_html($_POST['password']);
            if($password == ''){
                $errors = 'Password is empty';
                $this->render('register.html.php',compact('errors','email','name'));
            }
                             
            
            $repeat = $this->test_html($_POST['repeat']);     
            if($repeat == ''){
                 $errors = 'Pepeat password is empty';
                 $this->render('register.html.php',compact('errors','name','email'));
            }
               
            
            // create new User
            $user = new User($name, $email,$password,$repeat);
            if(!$user->checkName()){
                $errors = 'Name length must be min 2 char';
                $this->render('register.html.php',compact('errors','name','email'));
            }
            if(!$user->checkEmail()){
                $errors = 'Email address is invalid';
                $this->render('register.html.php',compact('errors','name','email'));
                
            }
            if(!$user->checkPassword()){
                $errors = 'Password length must be min 6 char';
                $this->render('register.html.php',compact('errors','name','email'));
            }
            if(!$user->checkRepeat()){
                $errors = 'Password and Repeat password are not equal';
                $this->render('register.html.php',compact('errors','name','email'));
            }
            $login = Table::getRecordsByColumn($user->table, 'email', $user->email);
            if(count($login) > 0){
                $errors = 'This email is used';
                $this->render('register.html.php',compact('errors','name','email'));
            }
            
            Table::save($user);
            $this->render('success.html.php', ['user' => $user]);     
        }
        $this->render('register.html.php');
    }
    public function actionLogin()
    {
        if(isset($_POST['submit'])){
            $email = $this->test_html($_POST['email']);
            if($email == ''){
                $errors = 'Email is empty';
                $this->render('login.html.php',compact('errors'));
            }
            $password = $this->test_html($_POST['password']);
            if($password == ''){
                $errors = 'Password is empty';
                $this->render('login.html.php',compact('errors','email'));
            }
            $row = Table::getRecordsByColumn($this->tableName,'email', $email);
            if(count($row) == 0){
                $errors = "Login with email {$email} not found";
                $this->render('login.html.php', ['errors' => $errors]);
            }
            $user = new User($row[0]['name'], $row[0]['email'],
             $row[0]['password'], $row[0]['registration'] );
             $user->id = $row[0]['id'];
             if(!password_verify($password, $user->password)){
                 $errors = "Incorrect password";
                 $this->render('login.html.php',['errors' => $errors]);
             }
             $this->saveInCookie('user', $user->id);
             $this->redirect('/cabinet');
        }
        $this->render('login.html.php');
    }
    public function actionLogout()
    {
        $this->deleteFromCookie('user');
        $this->redirect('/home');
    }
    public function encodePassword($password)
    {
        
    }
    
}