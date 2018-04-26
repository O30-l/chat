<?php

//创建验证码
function create_code(){
    return substr(md5(uniqid()),rand(0,28),4);
}
?>
