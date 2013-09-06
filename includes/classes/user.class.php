<?php
class User{
    function isUsernamePresent($username){
        $sql="SELECT * FROM users WHERE user_name ='$username'";
        if(Sql::executeQuery($sql,4)) {
            return true;
        }
        return false;
    }
    
    function checkUser($username,$password){
        $sql="SELECT * FROM users WHERE user_name ='$username' AND password = '".md5($password)."'";
        if(Sql::executeQuery($sql,4)) {
            return true;
        }
        return false;
    }
    function checkCurrentUserPassword($password){
        $sql="SELECT * FROM ".TABLE_USER." WHERE id ='$_SESSION[user_id]' AND password = '".md5($password)."'";
        //echo $sql;
        if(Sql::executeQuery($sql,4)) {
            return true;
        }
        return false;
    }
    
    function isLogin(){
        if(isset($_SESSION['user_name']) && $_SESSION['user_name']!=""){
            return true;
        }
        return false;
    }
    function getCurrentUser(){
        $sql="SELECT * FROM ".TABLE_USER." WHERE id = $_SESSION[user_id]";
        if(Sql::executeQuery($sql,4)) {
            $result = Sql::executeQuery($sql,2);
            return $result;
        }
        return false;
    }
    
    function getUsernameById($id){
        $sql="SELECT * FROM ".TABLE_USER." WHERE id = $id";
        $result = Sql::executeQuery($sql,2);
        return $result['user_name'];
    }
    
}
