<?php

class CabinetController extends AbstractController{
    public function actionIndex()
    {
        if(!$user = User::getUser()){
            $this->redirect('/login');
        }
        $this->render('cabinet.html.php', ['user' => $user]);
    }
    public function actionAllorders()
    {
        if(!$user_id = User::getUser('id')){
            $this->redirect('/login');
        }
        $orders = Table::getRecordsByColumn('orders', 'user_id', $user_id);
        $this->render('cabinet.html.php', ['orders' => $orders]);
    }
    public function actionOrderdetails()
    {
        $order_id = (int) $_GET['id'];
        $product_ids = Table::getRecordsByColumn('order_product', 'order_id', $order_id);
        $products = array();
        foreach ($product_ids as $product_id) {
            $products[] = Table::getRecordById('girls', $product_id['product_id']);
        }
        $this->render('cabinet.html.php', array('products' => $products));
    }
    
}