// metisMenu
require('metismenu');

// theme
require('./theme');

// frontend
require('./frontend');


var ajaxDefaults = {
    success: function (response) {
        if (response.message){
            switch (response.message.type){
                case 'error':
                    toastr.error(response.message.text, 'Error!');
                    break;
                case 'success':
                    toastr.success(response.message.text);
                    break;
            }

        }
    }
};
