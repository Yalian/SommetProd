// metisMenu
require('metismenu');

// theme
require('./theme');

// frontend
require('./frontend');


let ns = {};
(function(ctx) {
    ctx.ajax = function(options, callback){
        let defaults = {
            success: function (response) {
                if (response.message) {
                    switch (response.message.type) {
                        case 'success':
                            toastr.success(response.message.text);
                            break;
                        case 'error':
                            toastr.error(response.message.text, 'Error!');
                            break;
                    }
                }
                if (response) {
                    callback(data);
                }
                if (response.modal){
                    $('#myModal').html(response.modal)
                }
            }
        };
        $.extend(options, defaults);
        $.ajax(options);
    };
})(ns);
