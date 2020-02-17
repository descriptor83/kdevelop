<?php

class Cart{
    public static function getCart()
    {
        if(!isset($_COOKIE['cart'])) {
            return '0';
        }
        return urldecode($_COOKIE['cart']);
    }
    public static function countCart()
    {
        $cookie = self::getCart();
        if($cookie == '0') return 0;
        $arr = explode(',', $cookie);
        return count($arr);
    }
    public static function addToCart($id)
    {
        $cookie = self::getCart();
        if($cookie == '0'){
            setcookie('cart', $id,time()+60*60);
        } else {
            $cookie.= ",".$id;
            setcookie('cart', $cookie,time()+60*60);
        }
    }
    public static function getFromCart()
    {
        $cookie = self::getCart();
        if($cookie == '0'){
            return [];
        }
        $arr = explode(',', $cookie);
        return $arr;
    }
    public static function clearCart()
    {
        setcookie('cart','', time()-60);
    }
    public static function deleteFromCart($id)
    {
        $cookie = self::getCart();
        $pos = strpos($cookie,$id);
        $str1 = substr($cookie,0,$pos);
        $str2 = substr($cookie, $pos+2);
        $str3 = rtrim($str1.$str2, ',');
        setcookie('cart',$str3,time()+60*60);
    }
}