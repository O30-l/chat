<?php

//创建验证码
function create_code(){
    return substr(md5(uniqid()),rand(0,28),4);
}


function swal($data=['type'=>'info','title'=>'系统提示','content'=>'你需要传递一个数组进去']){
    $_SESSION['sweetalert']['type']=$data['type'];
    $_SESSION['sweetalert']['title']=$data['title'];
    $_SESSION['sweetalert']['content']=$data['content'];
}
?>
