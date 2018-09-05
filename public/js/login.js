/**
 * Created by PHUNGTRAN on 09/03/2018.
 */
// jQuery(document).ready(function(){
//     jQuery('#login').click(function(e){
//         e.preventDefault();
//         // $.ajaxSetup({
//         //     headers: {
//         //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//         //     }
//         // });
//         jQuery.ajax({
//             url: "{{ url('/login') }}",
//             method: 'post',
//             data: {
//                 user: jQuery('#user').val(),
//                 pass: jQuery('#pass').val()
//
//             },
//             success: function(result){
//                 if(result.errors)
//                 {
//                     jQuery('.alert-danger').html('');
//
//                     jQuery.each(result.errors, function(key, value){
//                         jQuery('.alert-danger').show();
//                         jQuery('.alert-danger').append('<li>'+value+'</li>');
//                     });
//                 }
//                 else
//                 {
//                     jQuery('.alert-danger').hide();
//                     $('#open').hide();
//                     $('#login-modal').modal('hide');
//                 }
//             }});
//     });
// });

    $('body').on('click', '#login', function(){
        var registerForm = $("#form");
        var formData = registerForm.serialize();

        $( '#email-error' ).html( "" );
        $( '#password-error' ).html( "" );

        $.ajax({
            url:'/login',
            type:'POST',
            data:formData,
            success:function(data) {
                console.log(data);
                if(data.errors) {

                    if(data.errors.email){
                        $( '#email-error' ).html( data.errors.email[0] );
                    }
                    if(data.errors.password){
                        $( '#password-error' ).html( data.errors.password[0] );
                    }

                }
                if(data.success) {
                    $('#success-msg').removeClass('hide');
                    setInterval(function(){
                        $('#login-modal').modal('hide');
                        $('#success-msg').addClass('hide');
                    }, 3000);
                }
            },
        });
    });
