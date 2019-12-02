window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//Custom.. 


$(document).ready(function(){

    $('#capture').on('click', function() { 
        $('#spinner').slideDown('fast');
        $(this).addClass('disabled');
    });
    
    $('.article-remover').on('submit', function(event) {
    
        event.preventDefault();
        event.stopPropagation();
    
        var form = $(this).closest('form');
        $.ajax({
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            url: form.attr('action'),
            method: 'DELETE',
            data: form.serialize(),
        }).done(function(response) {
            $(form).closest('.article').remove();
        }).fail(function(error){
            console.error(error);
        })
    });
});