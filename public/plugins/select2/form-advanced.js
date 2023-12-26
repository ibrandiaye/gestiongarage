/*
 Template Name: Zoter - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: Form Advanced components
 */


!function($) {
    "use strict";

    var AdvancedForm = function() {};

    AdvancedForm.prototype.init = function() {
        //creating various controls
// Select2
$(".select2").select2({
    width: '100%'
});







    },
    //init
    $.AdvancedForm = new AdvancedForm, $.AdvancedForm.Constructor = AdvancedForm
}(window.jQuery),

//initializing
function ($) {
    "use strict";
    $.AdvancedForm.init();
}(window.jQuery);
