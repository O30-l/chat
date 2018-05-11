var app = {
    data:{
        app_body_index:0,
        app_head_title_arr:[
            '消息','联系人','动态'
        ]
    },
};
$(function(){

    //初始化调用一次设置窗口
    set_window();

    //窗口改变调用
    $(window).resize(function(){
        set_window();
    });

    //切换主页面
    $('.app_foot_btn').click(function(){
        // alert($(this).index());
        app.data.app_body_index = $(this).index();
        $("#app_body").animate({scrollLeft:$("#app_body").width() * app.data.app_body_index});
        $('#app_head_title').html(app.data.app_head_title_arr[app.data.app_body_index]);
        $('.app_foot_btn').css('color','');
        $(this).css('color','#1bb1e0');
    });

    $('.app_search_input').focus(function(){
        // console.log(1);
        $(this).html('');
    }).blur(function(){
        $(this).html('搜索 <i class="fas fa-search"></i>');
    });

    //定义窗口改变设置元素大小函数
    function set_window(){
        $('#app_body').height($(window).height()-($('#app_search').outerHeight()+$('#app_head').outerHeight()+$('#app_foot').outerHeight())-1);
        $('#app').height($(window).height());
    }
});
