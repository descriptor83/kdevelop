<?php

class CartController extends AbstractController{
    public function actionAdd()
    {
        $id = $_GET['id'];
        Cart::addToCart($id);
        //$this->redirect('/girls');
        echo Cart::countCart()+1;
        
    }
    public function actionIndex()
    {
        $cart = Cart::getFromCart();
        $list = []; $total = 0;
        foreach($cart as $id){
            $girl = Table::getRecordById('girls', $id);
            $list[] = $girl;
            $total += $girl['price'];
        }
        $this->render('cart.html.php', ['cart' => $list, 'total' => $total]);
    }
    public function actionDelete()
    {
        $id = $_GET['id'];
        Cart::deleteFromCart($id);
        $this->redirect('/cart');
    }
    public function actionClear()
    {
        Cart::clearCart();
        $this->redirect('/cart');
    }
    public function actionOrder()
    {
        $products_id = Cart::getFromCart();
        if(count($products_id) == 0){
            $this->redirect('/cart');
        }
        $user_id = (int) $_COOKIE['user'];
        if($user_id == 0){
            $this->redirect('/login');
        }
        $total = 0; $products = [];
        foreach ($products_id as $product_id) {
            $product = Table::getRecordById('girls',$product_id);
            $total += $product['price'];
            $products[] = $product;
        }
         $user = Table::getRecordById('users', $user_id);
         $order = new Order($user_id, $total);
         $order_id = Table::save($order);
         $order->id = $order_id;
         $user_order = new UserOrder($user_id, $order_id);
         Table::save($user_order);
         foreach ($products_id as $product_id) {
             $order_product = new OrderProduct($order_id, $product_id);
             Table::save($order_product);
         }
         Cart::clearCart();
         $this->render('order.html.php', ['order' => $order,
          'user' => $user, 'products' => $products]);
       
    }
    
}















