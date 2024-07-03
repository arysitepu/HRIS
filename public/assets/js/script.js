//sweat aler 2
const swal = $('.swal').data('swal');
if(swal){
    Swal.fire({
        title: 'Data Berhasil',
        text: swal,
        icon: 'success',
    });
}

const swal1 = $('.swal1').data('swal1');
if(swal1){
    Swal.fire({
        title: 'Login Success',
        text: swal1,
        icon: 'success',
    });
}

const swal_error = $('.swal_error').data('swal_error');
if(swal_error){
    Swal.fire({
        title: 'Oopss . . .',
        text: swal_error,
        icon: 'error',
    });
}

const swal_error2 = $('.swal_error2').data('swal_error2');
if(swal_error2){
    Swal.fire({
        title: 'Oopss . . .',
        text: swal_error2,
        icon: 'error',
    });
}



//tab
function detailKaryawan(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// batas tabb

// code fasilitas

// batas code fasilitas