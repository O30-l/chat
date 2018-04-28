<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title></title>
        @include('layout.cssjs');
        <style media="screen">
            .form{
                background: rgba(255,255,255,0.2);width:400px;margin:100px auto;
            }

            @media screen and (max-width: 400px) {
                .form{
                    width:100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="form row">
                <form class="bs-example bs-example-form" role="form" id='refister_form' action="{{url('/register/create')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <h3>Chat</h3>
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default
                            dropdown-toggle" data-toggle="dropdown" id='select_mode' style='width:44px;'>
                                <i class="far fa-envelope"></i>
                            </button>
                            <ul class="dropdown-menu pull-left" id='modes' style='width:44px;min-width:44px;'>
                                <li>
                                    <a href="javascript:" style='text-align:center;padding:0px;' id='mode_email'><i class="far fa-envelope"></i></a>
                                </li>
                                <li>
                                    <a href="javascript:" style='text-align:center;padding:0px;' id='mode_mobile'><i class="fas fa-mobile-alt"></i></a>
                                </li>
                            </ul>
                        </div><!-- /btn-group -->
                        <input type="text" class='form-control' placeholder="email" name='email' id='email_or_mobile'>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id='send' style="width:56px;">send</button>
                        </span>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-pencil-alt"></i></span>
                        <input type="text" class='form-control' placeholder="Verification Code" name='code'>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                        <input type="password" class='form-control' placeholder="password" name='password'>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class='fa fa-check fa-fw'></i></span>
                        <input type="password" class='form-control' placeholder="rePassword" name='repassword'>
                    </div>
                    <br>
                    <a href="{{url('/')}}"><button class='btn btn-info' type='button'>Back</button></a>
                    <button class='btn btn-success' style='float:right;'>register</button>
                </form>
            </div>
        </div>
        <script type="text/javascript">
        $(function(){

            //邮箱验证码发送剩余时间
            var email_time = 'send';

            //短信验证码发送剩余时间
            var mobile_time = 'send';

            var mode = 'email';
            $('#mode_email').click(function(){
                $('#select_mode').html('<i class="far fa-envelope"></i>').parent().next().attr('placeholder','email');
                $('#email_or_mobile').attr('name','email');
                $('#send').html(email_time);
                if(typeof email_time=='number'){
                    $('#send').attr('disabled',true);
                }else{
                    $('#send').attr('disabled',false);
                }
                mode = 'email';
            });
            $('#mode_mobile').click(function(){
                $('#select_mode').html('<i class="fas fa-mobile-alt"></i>').parent().next().attr('placeholder','mobile');
                $('#email_or_mobile').attr('name','mobile');
                $('#send').html(mobile_time);
                if(typeof mobile_time=='number'){
                    $('#send').attr('disabled',true);
                }else{
                    $('#send').attr('disabled',false);
                }
                mode = 'mobile';
            });

            $("#send").click(function(){
                $(this).html('<i class="fas fa-spinner fa-pulse"></i>');
                $(this).attr('disabled',true);
                $('#select_mode').attr('disabled',true);
                var to = $(this).parent().prev().val();
                if(to==''){
                    var error = '邮箱不能为空';
                    if(mode!='email'){
                        error='手机号不能为空';
                    }
                    swal("OMG!",error, "error");
                    $(this).html('send').attr('disabled',false);
                    $('#select_mode').attr('disabled',false);
                    return;
                }else if(!to.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/) && mode =='email'){
                    swal("OMG!",'请检查邮箱格式', "error");
                    $(this).html('send').attr('disabled',false);
                    $('#select_mode').attr('disabled',false);
                    return;
                }else if(to.length!=11 && mode == 'mobile'){
                    swal("OMG!",'请检查手机号', "error");
                    $(this).html('send').attr('disabled',false);
                    $('#select_mode').attr('disabled',false);
                    return;
                }
                var url = '{{url("/register/sendEmail")}}';
                if(mode=='mobile'){
                    url = '{{url("/register/sendMobile")}}';
                }
                $.ajax({
                    url:url,
                    type:'post',
                    data:{
                        to:to
                    },
                    dataType:'json',
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success:(r)=>{
                        console.log(r);
                        if(r.state){
                            swal("OK!", r.info, "success");
                            $('#select_mode').attr('disabled',false);
                            $(this).html('60');
                            if(mode=='email'){
                                email_time=60;
                            }else{
                                mobile_time=60;
                            }
                            var this_mode = mode;
                            var t = setInterval(()=>{
                                eval(this_mode+'_time-=1');
                                if(mode==this_mode){
                                    $(this).html(eval(this_mode+'_time'));
                                }
                                if(eval(this_mode+'_time')==0){
                                    eval(this_mode+'_time="send"');
                                    if(mode==this_mode){
                                        $('#send').attr('disabled',false);
                                        $(this).html(eval(this_mode+'_time'));
                                    }
                                    clearInterval(t);
                                }
                            },1000);
                        }else{
                            swal("OMG!", r.info, "error");
                            $(this).html('send').attr('disabled',false);
                        }
                    },
                    error:(r)=>{
                        swal("OMG!",'请稍后尝试', "error");
                        $(this).html('send');
                    }
                });
            });

            $('#refister_form').submit(function(){
                var to = $(this).find('#email_or_mobile').val();
                var code = $(this).find('input[name="code"]').val();
                if(!to){
                    swal("OMG!",'请填写好验证方式', "error");
                    return false;
                }

                //请求验证一下
                var bool = true;
                $.ajax({
                    url:'{{url("/register/verification")}}',
                    type:'post',
                    async:false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        to:{
                            to:to,
                            type:mode
                        },
                        code:code
                    },
                    dataType:'json',
                    success:(r)=>{
                        console.log(r);
                        if(!r.state){
                            swal("OMG!",r.info, "error");
                            bool= r.state;
                        }
                    },
                    error:()=>{
                        bool=false;
                        swal("OMG!",'请稍后尝试或者F5一下试试', "error");
                    }
                });

                if(!bool) return bool;

                //验证一下密码是否相同
                var password = $(this).find('input[name="password"]').val();
                if(!password){
                    swal("OMG!",'密码不能为空', "error");
                    return false;
                }
                var repassword = $(this).find('input[name="repassword"]').val();
                if(!repassword){
                    swal("OMG!",'请重复填写密码', "error");
                    return false;
                }

                if(password != repassword){
                    swal("OMG!",'确认密码不正确', "error");
                    return false;
                }


            });
        });
        </script>
        @include('layout.bird');
    </body>
</html>
