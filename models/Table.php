<?php

class Table{
    public static function getAllRecords($table, $start = null, $num = null)
    {
        global $pdo;
        $postList = [];
       
        
        if($start !== null){
            $sql = "SELECT * FROM `{$table}` LIMIT $start, $num";
        }
        else{
            $sql = "SELECT * FROM `{$table}`";

        }    
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            $postList[] = $row;
        }
        return $postList;
    }
    public static function getRecordById($table, $id){
        global $pdo;
        $sql = "SELECT * FROM `{$table}` WHERE `id` = {$id}";
        $result = $pdo->query($sql);
        $row = $result->fetch();
        return $row;
    }
    public static function getCountRecords($table)
    {
        global $pdo;
        $sql = "SELECT COUNT(*) FROM `{$table}`";
        $result = $pdo->query($sql);
        $row = $result->fetch();
        return (int)$row[0];
    }
    public static function getFindRecords($table, $column, $find)
    {
        global $pdo;
        $list = [];
        $sql = "SELECT * FROM `{$table}` WHERE `{$column}` LIKE '%{$find}%' ";
        $result = $pdo->query($sql);
        if($result){
        while ($row = $result->fetch()) {
            $list[] = $row;
            }
            return $list;
        }
        return []; 
    }
    public static function getRecordsByColumn($table, $where, $param)
    {
        global $pdo;
        
        if(is_int($where))
            $sql = "SELECT * FROM `{$table}` WHERE `{$where}` = {$param}";
        else
            $sql = "SELECT * FROM `{$table}` WHERE `{$where}` = '{$param}'";    
        $result = $pdo->query($sql);
        if($result){
             $list = $result->fetchAll();
             return $list;
            }
            return [];
    }
    public static function save(Model $obj)
    {
        global $pdo;
        $values = $obj->exchangeArray();
        $sql = "INSERT INTO `{$obj->table}` SET ";
        foreach($values as $key => $value){
            $sql.= $key." = :{$key},";
        }
        $sql = rtrim($sql,',');
        $stmt = $pdo->prepare($sql);
        foreach($values as $key => $value){
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->execute();
        return $pdo->lastInsertId();
        
    }
    public static function update(Model $obj)
    {
        global $pdo;
        $values = $obj->exchangeArray();
        $sql = "UPDATE `{$obj->table}` SET ";
        foreach($values as $key => $value){
            $sql.= $key." = :{$key},";
        }
        $sql = rtrim($sql,',');
        $sql.= " WHERE `id`= :id";
        $stmt = $pdo->prepare($sql);
        foreach($values as $key => $value){
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->bindValue(':id', $obj->id);
        $stmt->execute();
        
    }
    public static function uploadImage(array $data){
        $tmp = $data['tmp_name'];
        
        if($data['error'] != 0) {
            return false;
        }
        if(is_uploaded_file($tmp)){
            $info = getimagesize($tmp);
            if(preg_match('{image/(.*)}is', $info['mime'], $p)){
                if($p[1] == 'jpeg' or $p[1] == 'png'){
                    move_uploaded_file($tmp, IMG.$data['name']);
                    return true;
                }
                return false;
            } else {
                return false;
            }
        }
        return false;
    }
    public static function delete(Model $obj)
    {
        global $pdo;
        $sql = "DELETE FROM `{$obj->table}` WHERE `id`=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $obj->id);
        $stmt->execute();
    }
    public static function uploadThumbnail($fileName, $height = 180, $width = 120, $path = ''){
        $thumbFile = $path == '' ? IMG.'thumb_'.$fileName : $path.'thumb_'.$fileName;
        $src_im = imagecreatefromjpeg(IMG.$fileName);
        $dst_im = imagecreatetruecolor($width,$height);
        imagecopyresampled($dst_im, $src_im, 0, 0, 0, 0, $width, $height,
        imagesx($src_im) , imagesy($src_im));
        if(imagejpeg($dst_im, $thumbFile)){
            return true;
        } else {
            return false;
        }
    }
   
}