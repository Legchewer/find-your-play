(function(){
    'use strict';

    $(document).ready(function()
    {
        alert("Hello world!");
    });

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

})(window);