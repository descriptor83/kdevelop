<?php

class AbstractController{
    protected $tableName;
    public function __construct($tableName)
    {
        $this->tableName = $tableName.'s';
    }
    protected function test_html($data)
    {
		$data = trim($data);
		$data = filter_var($data, FILTER_SANITIZE_STRING);
		return $data;
    }
    public function redirect($location = null)
    {
        if($location === null){
            $location = $_SESSION['HTTP_REFERER'];
        }
        header("Location: ".$location);
    }
    public function render($template, $values = [])
    {
        extract($values);
        ob_start();
        include  ROOT.'/../templates/'.$template;
        $output = ob_get_clean();
        include ROOT.'/../templates/output.php';
        exit();
    }
    public function pagination($page, $total)
    {
        $prevPage = $nextPage = $page2left = $page1left = $page2right = $page1right = '';
        if($page != 1){
            $prevPage = "<a class='btn btn-default' href='".$this->tableName."?page=1'><<</a>";
            $prevPage.= "<a class='btn btn-default' href='".$this->tableName."?page=".($page - 1)."'><</a>";
        }    
        if($page != $total){
                $nextPage = "<a class='btn btn-default' href='".$this->tableName."?page=".($page + 1)."'>></a>";
                $nextPage .= "<a class='btn btn-default' href='".$this->tableName."?page=".$total."'>>></a>";
            
        }
        if($page - 2 > 0){
            $page2left = "<a class='btn btn-default' href='".$this->tableName."?page=".($page - 2)."'>".($page - 2)."</a> ";
        }
        if($page - 1 > 0){
            $page1left = "<a class='btn btn-default' href='".$this->tableName."?page=".($page - 1)."'>".($page - 1)."</a> ";
        }
        if($page + 2 <= $total){
            $page2right = " <a class='btn btn-default' href='".$this->tableName."?page=".($page + 2)."'>".($page + 2)."</a>";
        }
        if($page + 1 <= $total){
            $page1right = " <a class='btn btn-default' href='".$this->tableName."?page=".($page + 1)."'>".($page + 1)."</a>";
        }
        return $prevPage.'&nbsp;'.$page2left.'&nbsp;'.$page1left.'&nbsp;'
        .'<strong>'.$page.'</strong>'.'&nbsp;'.
        $page1right.'&nbsp;'.$page2right.'&nbsp;'.$nextPage;
    }
    public function saveInCookie($name, $value)
    {
        setcookie($name,$value, time()+60*60);
    }
    public function saveInSession(string $message, string $route, string $key = 'error')
    {
        session_start();
        $_SESSION[$key] = $message;
        $this->redirect($route); exit;
    }
    public function deleteFromCookie($name)
    {
        setcookie($name, '', time()-60);
    }
    public function isDateValid($date)
    {
        $regExp = '/^(\d{4})-(\d{1,2})-(\d{1,2})$/i';
        if(preg_match($regExp, $date, $p )){
            if(checkdate($p[2], $p[3], $p[1]))
                return true;
            return false;
        } else {
            return false;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   
   
}