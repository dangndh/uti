/**************** check if html form is edited ****************/
/**
* @author   Nguyen Duong Hai Dang
* @since    May 12th 2015
* check if html form is edited
*/
$.fn.extend({
    trackChanges: function() {
        $(":input",this).change(function() {
            $(this.form).data("changed", true);
        });
    }
    ,
    isChanged: function() { 
        return this.data("changed"); 
    }
});

// usage:
// show bootstrap modal and check if the form in modal is changed
$('#add_modal_update').on('shown.bs.modal', function () {
    $('#add_modal_update #create-address-form').trackChanges();
});

// reload the page if the form has changed   
$('#add_modal_update').on('hidden.bs.modal', function () {
    if ($("#add_modal_update #create-address-form").isChanged()) {
        showLoading();
        document.location.reload(); 
    }
});

/************************************************************/