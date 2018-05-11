<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>{{config('app.name')}}</title>
        @include('layout.cssjs')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app/app.css')}}">
        <script type="text/javascript" src="{{asset('js/app/app.js')}}"></script>
    </head>
    <body>
        <div id='app'>
            <div id="app_head">
                <div  style='line-height:50px;height:50px;'>
                    <img class="photo" src="{{asset("update/photo/640.jpg")}}" alt="" style="width:40px;height:40px;">
                </div>
                <div id="app_head_title">消息</div>
                <div id="app_head_add_btn"><i class="fas fa-plus"></i></div>
            </div>
            <div id="app_search">
                <!-- <input type="text" name="app_search_message" value="搜索" class="app_search_input"> -->
                <div class="app_search_input" contenteditable='true' spellcheck='false'>搜索 <i class="fas fa-search"></i></div>
                <!-- <i class="fas fa-search"></i> -->
            </div>
            <div id="app_body">
                <div id="app_body_box">
                    <div id="app_body_message_box" class="app_body_box_s">
                        <div class="app_body_message">
                            <div  style='line-height:50px;height:50px;padding:0px 10px;' id='test'>
                                <img class="photo" src="{{asset("update/photo/640.jpg")}}" alt="" style="width:40px;height:40px;">
                            </div>
                            <div>
                                <div>PeopleSea</div><br />
                                <div>
                                    你是傻子吗阿斯顿发送到发送到
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="app_body_user_box" class="app_body_box_s">
2
                    </div>
                    <div id="app_body_act_box" class="app_body_box_s">
3
                    </div>
                </div>
            </div>
            <div id="app_foot">
                <div class="app_foot_btn" style='color:#1bb1e0;'><i class="far fa-comments"></i></div>
                <div class="app_foot_btn"><i class="far fa-user"></i></div>
                <div class="app_foot_btn"><i class="far fa-star"></i></div>
            </div>
        </div>
    </body>
</html>
