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
                <!-- <div class="photo" style='background-image:url("{{asset("update/photo/640.jpg")}}");width:40px;height:40px;background-size:40px 40px;'></div> -->
                <div  style='line-height:50px;height:50px;'>
                    <img class="photo" src="{{asset("update/photo/640.jpg")}}" alt="" style="width:40px;height:40px;">
                </div>
                <div id="app_head_add_btn"><i class="fas fa-plus"></i></div>
            </div>
            <div id="app_body">
                <div class="app_body_message">
                    <div  style='line-height:50px;height:50px;padding:0px 10px;' id='test'>
                        <img class="photo" src="{{asset("update/photo/640.jpg")}}" alt="" style="width:40px;height:40px;">
                    </div>
                    <div class="">
                        <div class="">PeopleSea</div>
                        <div class="">
                            你是傻子吗
                        </div>
                    </div>
                </div>
            </div>
            <div id="app_foot">
                <div class="app_foot_btn"><i class="far fa-comments"></i></div>
                <div class="app_foot_btn"><i class="far fa-user"></i></div>
                <div class="app_foot_btn"><i class="far fa-star"></i></div>
            </div>
        </div>
    </body>
</html>
