function navScript(trigger) {
    var btn = trigger;
    if ($(window).width() <= 960){
        $(btn).click(function() {
            if($('.sidenav').css('left')=='0px'){
                $('.sidenav').css('left','-280px');
                $('.content-block').css('display','none');
                $('.sidenav').css('box-shadow','none');
            }else {
                $('.sidenav').css('left','0px');
                $('.sidenav').css('box-shadow','5px 5px 20px #222');
                $('.content-block').css('display','block');
            }
        })
    }else {
        $(btn).click(function() {
            if($('.sidenav').css('left')=='0px'){
                $('.sidenav').css('left','-280px');
                $('.main').css('width','100%');
            }else {
                $('.sidenav').css('left','0px');
                $('.main').css('width','calc(100% - 280px)');
            }
        })
    }
}

$(window).ready(function() {
    var trigger = '.bar';
    navScript(trigger);
})

$(window).resize(function() {
    location.reload();
})

$('.content-block').click(function() {
    if($('.sidenav').css('left')=='0px'){
        $('.sidenav').css('left','-280px');
        $('.content-block').css('display','none');
        $('.sidenav').css('box-shadow','none');
    }else {
        $('.sidenav').css('left','0px');
        $('.sidenav').css('box-shadow','5px 5px 20px #222');
        $('.content-block').css('display','block');
    }
});

$('.btn-cl').click(function() {
    $('.cus-modal').css('display','none');
});
