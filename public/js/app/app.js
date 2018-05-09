$(function(){
    set_window();
    $(window).resize(function(){
        set_window();
    });


    $('.app_foot_btn').click(function(){

    });
    
    function set_window(){
        $('#app_body').height($(window).height()-($('#app_head').height()+$('#app_foot').height())-3);
        $('#app').height($(window).height());
    }
});
