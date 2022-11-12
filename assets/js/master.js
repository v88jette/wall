$(document).ready(function(){
    $(document).on('submit', 'form#default-form', function(){
        const form = $(this);
        $.post(form.attr('action'), form.serialize(), function(output){
            $(form.attr('data-target')).after(output);
        }).always(function(){
            form.attr('action', '');
            form.attr('data-target', '');
            $('textarea').val('');
            $('.error').fadeOut(2000, function(){
                $('.error').remove();
            });
        });
        return false;
    });

    $(document).on('click', '.reply-form>button, .post-form>button', function(){
        const btn       = $(this);
        const form      = btn.parent();
        const action    = form.attr('data-action');
        let target      = '#';

        if(action === 'post'){
            target += 'posts';
        }else{
            target += form.prev().attr('id');
        }

        const default_form = $('form#default-form');
        default_form.attr('action', action);
        default_form.attr('data-target', target);
        default_form.children('textarea').val(form.children('textarea').val());
        default_form.submit();
    });
});