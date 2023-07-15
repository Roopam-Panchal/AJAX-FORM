//Ajax call:
jQuery(document).ready(function($) {
    $('form#lowerdebt_form').on('submit', function(e) {
        e.preventDefault();
        
        jQuery('#lowerdebt_form button').text('Please wait...');
        jQuery('#lowerdebt_form button').attr('disable','disabled');

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var eml = $('#eml').val();
        var phn = $('#phn').val();
        var estimate_debt = $('#estimate_debt').val();
        var current_pay = $('#current_pay').val();
        // calling ajax
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                'action': 'add_new_user',
                'fname': fname,
                'lname': lname,
                'eml': eml,
                'phn': phn,
                'estimate_debt': estimate_debt,
                'current_pay': current_pay,
            },
            success: function(data) {
                var obj = JSON.parse(data);
                if (obj.res == true) {
                    alert(obj.message); // success message
                    $('#fname').val('');
                    $('#lname').val('');
        $('#eml').val('');
        $('#phn').val('');
         $('#estimate_debt').val('');
         $('#current_pay').val('');
         
         jQuery('#lowerdebt_form button').text('Submit');
        jQuery('#lowerdebt_form button').attr('disable','');
         
                } else {
                    alert(obj.message); // fail
                }
            }
        });
    });
});
