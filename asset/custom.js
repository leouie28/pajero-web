$('.bar').click(function() {
    if($('.sidenav').css('left')=='0px'){
        $('.sidenav').css('left','-280px');
        $('.main').css('width','100%');
    }else {
        $('.sidenav').css('left','0px');
        $('.main').css('width','calc(100% - 280px)');
    }
})