<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{config('app.name')}} - login</title>

        @include('layout.cssjs')
        <style media="screen">
        .form{
            background: rgba(255,255,255,0.2);width:400px;margin:100px auto;
        }
/*            #login_form{
            display: block;
        }
        .fa{display: inline-block;top: 27px;left: 6px;position: relative;color: #ccc;}
        input[type="text"],input[type="password"]{padding-left:26px;}
        .checkbox{padding-left:21px;}*/
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
                <!-- <button id='button'>1</button> -->
                <form class="bs-example bs-example-form" role="form" action='{{url("/login/validation")}}' method="post" id='login_form'>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <h3>{{config('app.name')}}</h3>
                    <div class="input-group">
                        <!-- <span class="input-group-addon"></span> -->
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-default
                            dropdown-toggle" data-toggle="dropdown" id='select_user'>
                                <i class='fa fa-user fa-lg'></i>
                            </button>
                            <ul class="dropdown-menu pull-left" id='users'>
                                <li>
                                    <a href="#">功能</a>
                                </li>
                                <li>
                                    <a href="#">另一个功能</a>
                                </li>
                                <li>
                                    <a href="#">其他</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="#">分离的链接</a>
                                </li>
                            </ul>
                        </div><!-- /btn-group -->
                        <input type="text" class="form-control" placeholder="account / email / mobile" value='' name='account'>
                    </div><!-- /input-group -->
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><i class='fa fa-lock fa-lg'></i></span>
                        <input type="password" class='form-control' placeholder="password" name='password'>
                    </div>
                    <br>
                    <a href="{{url('/register/index')}}">Register</a>
                    <!-- <div class="input-group"> -->
                        <button class='btn btn-success' style='float:right;'>login</button>
                    <!-- </div> -->
                </form>
            </div>
        </div>
        @include('layout.bird')
    </body>
</html>
