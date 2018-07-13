;
(function($){
    'use strict';
    jQuery( document ).ready( function( ) {

        $( 'input.search-field' ).addClass( 'form-control' );

        // here for each comment reply link of wordpress
        $( '.comment-reply-link' ).addClass( 'btn btn-primary' );

        // here for the submit button of the comment reply form
        $( '#commentsubmit' ).addClass( 'btn btn-primary' );

        // The WordPress Default Widgets
        // Now we'll add some classes for the wordpress default widgets - let's go

        // the search widget
        $( 'input.search-field' ).addClass( 'form-control' );
        $( 'input.search-submit' ).addClass( 'btn btn-default' );

        $( '.widget_rss ul' ).addClass( 'media-list' );

        $( '.widget_meta ul, .widget_recent_entries ul, .widget_archive ul, .widget_categories ul, .widget_nav_menu ul, .widget_pages ul' ).addClass( 'nav' );

        $( '.widget_recent_comments ul#recentcomments' ).css( 'list-style', 'none').css( 'padding-left', '0' );
        $( '.widget_recent_comments ul#recentcomments li' ).css( 'padding', '5px 15px');

        $( 'table#wp-calendar' ).addClass( 'table table-striped');

        $('body').delegate('.ab-customizer-edit', 'click', function(e) {
            e.preventDefault();
            //$(this).closest('.ab-customizer-content').toggle();
            $($(this).attr('href')).toggle();
        });

        $(document).on('ap_after_ajax', function(e, data) {
            if (typeof data.action !== 'undefined' && data.action == 'ab_customizer_block_updatded' ) {
                var c = $('.ab-customizer[data-name="'+ data.block +'"]');
                c.find('.ab-customizer-content').toggle();
                c.find('.ab-customizer-inner').html(data.html);
                c.find('.ab-customizer-form').toggle();
            }
        });

        $('.btn-sidetoggle').click(function(e) {
            e.preventDefault();

            if($(this).is('.active')) {
                $(this).animate({'left': 10 }, 200);
                $('.ap-user-navigation').animate({'margin-left': -200 }, 200);
                $(this).removeClass('active');
            } else {
                $(this).animate({'left': 180 }, 200);
                $('.ap-user-navigation').animate({'margin-left': 0 }, 200);
                $(this).addClass('active');
            }

        });

        $('#search-toggle').click(function(){

            $('.site-nav').toggleClass('searchbar-show').addClass('ofcontrol').promise().done(function(el){
                if($('.site-nav').is('.searchbar-show'))
                    $('.site-nav').addClass('growing');
                else
                    $('.site-nav').removeClass('growing');
                setTimeout(function(){
                    $('.site-nav').toggleClass('ofcontrol');
                }, 500);
            });
        });
        $('#main-search').on('blur', function(){
            $('.site-nav').removeClass('searchbar-show');
        });
        $('#menu-toggle').click(function(e){
            e.preventDefault();
            $('.site-nav').toggleClass('collapse-menu');
        });

        $('[data-action="ab_upload_form"]').change(function() {
            $(this).closest('form').submit();
        });

        $('[data-action="ab_upload_form"]').submit(function() {
            var form = this;
            $(this).ajaxSubmit({
                success: function(data) {
                    var parsedData = AnsPress.ajaxResponse(data);
                    console.log(parsedData);
                    if(parsedData.snackbar){
                        AnsPress.trigger('snackbar', parsedData)
                    }
                    if(parsedData.success){
                        var type = parsedData.type;
                        $(form).closest('.ap-user-'+type).find('img').attr('src', parsedData.url +'?'+new Date().getTime()).removeAttr('srcset');
                    }
                },
                url: ajaxurl,
                context: form
            });
            return false
        });
    } );
})(jQuery);
