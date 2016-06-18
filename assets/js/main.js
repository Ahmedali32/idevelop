NProgress.start();
$(window).load(function(){
    // PAGE IS FULLY LOADED
    // FADE OUT YOUR OVERLAYING DIV
    idevelop_runner();
});

// the main runner of the application
function idevelop_runner(){

    // close nprogress and start animation
    close_nprogress_start_tween();

    // run typeist
    start_typeist();

    // add event listener to window resize
    $(window).resize(detect_width_change);

    detect_width_change();

    add_hover_over_post_column();

    instantiate_on_scroll_send_request();

    run_click_event_over_pin_button();
}

function instantiate_on_scroll_send_request(){
    var ready = true;

    $(window).on('scroll',function(){
        if(!ready){
            return ;
        }
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 700){
            ready = false;
            $(".loader").slideDown();
            var link = $('#send_ajax').val();
            var number = $("#loaded_posts");
            var category_available = $("#category_available");
            $.post(
                link, {
                    action               : 'idevelop_get_posts_home',
                    number               : number.val(),
                    cat                  : category_available.val()
                }, function (response) {
                    $(".loader").slideUp();
                    if(response.success == true){
                        var data = JSON.parse(response.data[0]);
                        $('.posts_inner_row').append(data);
                        number.val(response.data[1]);
                        add_hover_over_post_column();
                        detect_width_change();

                        ready = true ;
                    }else{
                        ready = false ;
                    }
                }
            )
        }
    });
}


////////////////////////////////////////////////////////////////////////////////////////////////////////
// add hover over columns
function add_hover_over_post_column(){
    var post_column = $(".post-column");

    post_column.hover(function(){
        var element =  $(this) ;
        var bg_color = element.find('.post-cat').css('backgroundColor');
        element.find('.post-cat').css('top','-10px');
        element.css('background-color',bg_color);
        element.css('margin-top','12px');
        element.parent().css('background-color','white');
        element.parent().css('border-radius','5px 50px');
    },function(){
        var element =  $(this) ;
        element.find('.post-cat').css('top','-2px');
        element.css('background-color','white');
        element.parent().css('background-color','transparent');
        element.parent().css('border-radius','none');
        element.css('margin-top','0px');
    });
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
// twinmax animations
function close_nprogress_start_tween(){
    setTimeout(function(){
        NProgress.done();
        setTimeout(function(){
            run_tweenmax_header_line();
        },500);
    },1000);
}


function run_tweenmax_header_line(){
    var animation = new TimelineMax({onComplete:run_tweenmax_right_line}) ;
    var body_line = $( ".body_line" ) ;
    animation.to(body_line ,2 , {width:'100%' ,ease:Power2.easeOut});
}

function run_tweenmax_right_line(){
    var body_line_right = $( ".body_line_right" ) ;
    TweenLite.to(body_line_right ,2 , {height:'100%' ,ease:Bounce.easeOut});

    var body_line_left = $( ".body_line_left" ) ;
    TweenLite.to(body_line_left ,2 , {height:'100%' ,ease:Bounce.easeOut});
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
// start typeist
function start_typeist(){
    typist = $("#changing-text")[0];
    new Typist(typist, {
        letterInterval: 60,
        textInterval:   3000
    });

    typer = $("#changing-text-mobile")[0];
    new Typist(typer, {
        letterInterval: 60,
        textInterval:   3000
    });
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
// width changer detector
function detect_width_change(){
    var maxHeight = 0;
    $('.idevelop-col').each(function() {
            if ( $(this).find('.post-column').height() > maxHeight ){
                maxHeight = $(this).find('.post-column').height() ;
            }
    });
    maxHeight = maxHeight + 50 ;

    $('.idevelop-col').each(function(){
        $(this).css('height',maxHeight+"px");
    });
}
////////////////////////////////////////////////////////////////////////////////////////////////////////

function run_click_event_over_pin_button(){
    var element_text = 0 ;
    if (localStorage.getItem("pin") == 1) {
        element_text = 1 ;
        $(this).find('p').text('un pin');
        collapse_menu();
    }

    $(".pin_button").click(function() {
       if(element_text == 0){
           element_text = 1 ;
            $(this).find('p').text('un pin');
            collapse_menu();
       }else{
           element_text = 0 ;
           $(this).find('p').text('pin');
           uncollabse_menu();
       }
    });

    $('.header-wrap').hover(function(){
        $('.pin_button').find('p').text('pin');
        element_text = 0 ;
        uncollabse_menu();
    });
}

function collapse_menu(){
    $('.site-content').addClass('site-content-light-margin');
    $('.header-wrap').addClass('header-wrap-light-margin');
    $('.pin_button').addClass('pin_button_margin-left-light');
    $('.header-wrap .site-title').addClass('make_display_none');
    $('.header-wrap ul').addClass('make_display_none');
    $('.burger-button').css('display','block');
    localStorage.setItem("pin",1);
}

function uncollabse_menu(){
    $('.site-content').removeClass('site-content-light-margin');
    $('.header-wrap').removeClass('header-wrap-light-margin');
    $('.pin_button').removeClass('pin_button_margin-left-light');
    $('.header-wrap .site-title').removeClass('make_display_none');
    $('.header-wrap ul').removeClass('make_display_none');
    $('.burger-button').css('display','none');
    localStorage.setItem("pin",0);
}