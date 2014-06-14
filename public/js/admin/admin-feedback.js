(function(){
    'use strict';

    $(document).ready(function(){

        $('.show-feedback-btn').click(function(){

            $(this).parent().children("ul").slideToggle();

        });

    });

})(window);