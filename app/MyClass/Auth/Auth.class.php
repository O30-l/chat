<?php
namespace App\MyClass;
 class Auth{
    static public function user(){
        // return 'test';
    }
    static public function check(){
        return isset($_SESSION['user']);
    }
}
?>
