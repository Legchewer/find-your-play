(function(){
    'use strict';

    /*
     * FOUNDATION MODAL WARNING EVENTS
     */
    var route;

    $('.confirm').click(function(e) {
        e.preventDefault();
        route = this.href;
    });

    $('#warning-accept').click(function(e) {
        location.href = route;
    });

    $('#add_game').hide();
    $('.margintopfix button').click(function(){
        $('#add_game').slideDown();
    });
})(window);