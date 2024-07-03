const swal_error = $('.swal_error').data('swal_error');
if(swal){
    Swal.fire({
        title: 'Oopss . . .',
        text: swal_error,
        icon: 'error',
    });
}