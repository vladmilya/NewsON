jQuery(document).ready(function (){ 

    if(navigator.userAgent.indexOf('Mac')>1){
        jQuery('.search-sidebar').addClass('macOS');
    }
    
    menuWidthCorrection();
    
    jQuery('.mobile-menu').find('.icon').click(function(){ 
        var clicker = jQuery(this);
        if(clicker.hasClass('close-icon')){
            clicker.removeClass('close-icon');
            clicker.addClass('open-icon');
            jQuery('.mobile-menu').css('right','0');
        }else{
            clicker.removeClass('open-icon');
            clicker.addClass('close-icon');
            jQuery('.mobile-menu').css('right','-200px');
        }
    });
    
    if(jQuery(window).scrollTop() > 0){
        jQuery('.mobile-menu').addClass('menu-scrolled');
    }else{
        jQuery('.mobile-menu').removeClass('menu-scrolled');
    }
    jQuery(window).scroll(function(){
        menuWidthCorrection();
        if(jQuery(window).scrollTop() > 0){
            jQuery('.mobile-menu').addClass('menu-scrolled');
        }else{
            jQuery('.mobile-menu').removeClass('menu-scrolled');
        }
    });
    jQuery('#map2').css('height', jQuery(window).height()-jQuery('.modal-header').height()-35);
    
    //scrolling
    jQuery('.arrow-down').each(function(){
        var arrow = jQuery(this);
        arrow.click(function(){
            var screenWidth = jQuery(window).width();
            
            if(screenWidth >= 768){
                var adjustment = 50;
                if(arrow.hasClass('mapsection')){
                    var nextBlock = arrow.parent().next().next();
                }else{
                    var nextBlock = arrow.parent().next();
                }
            }else{
                var adjustment = 45;
                if(arrow.hasClass('aboutsection')){
                    var nextBlock = arrow.parent().next().next();
                }else{
                    var nextBlock = arrow.parent().next();
                }
            }           
            
            var offset = nextBlock.offset().top - adjustment
            jQuery('body, html').animate({ scrollTop: offset}, 600);
            return false;
        });
    });
    
});

jQuery('body').on('click', '.wpgmp_infowindow a', function(){
    jQuery(this).attr('target', '_blank');
})

jQuery(window).resize(function(){
    menuWidthCorrection();
});

function menuWidthCorrection(){
    var windowWidth = jQuery(window).width();
    if(windowWidth > 767 && jQuery(window).scrollTop() > 0){
        jQuery('.navbar-fixed-top').css('margin-top','-70px');
        jQuery('.navbar-brand').addClass('navbar-brand-scroll');
        jQuery('.navbar-fixed-top').addClass('scrolled');
    }else{
        if(jQuery(window).scrollTop() > 0){
             jQuery('.navbar-fixed-top').css('margin-top', '-35px');
        }else{
            jQuery('.navbar-fixed-top').css('margin-top', '0');
        }        
        jQuery('.navbar-brand').removeClass('navbar-brand-scroll');
         jQuery('.navbar-fixed-top').removeClass('scrolled');
    }
}