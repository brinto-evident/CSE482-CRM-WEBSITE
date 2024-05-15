// $(document).ready(function () {
//     $('#loadicon').hide();
// });

$("#ticketbtn").on('click', function (e) {


    var subject = $('#subject').val();
    var systemid = $('#systemid').val();
    var supporttype = $('#supporttype').val();
    var urgency = $('#urgency').val();
    var details = $('#details').val();

    var postdata = {
        'subject': subject,
        'systemid': systemid,
        'supporttype': supporttype,
        'urgency': urgency,
        'details': details
    };

    $.ajax({
        url: "backend/createticket.php",
        type: "POST",
        data: postdata,
        success: function (data) {
            if (data == 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Operation Successful!',
                    text: 'Your ticket has been issued',
                })
            }
            if (data == 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'Could not process your request!',
                    text: 'Please try again',
                })
            }
        },
        error: function () {
            alert("Error occured")
        }
    });
    e.preventDefault();
    $("#resetticket").trigger('click');
});

$("#loginbtn").on('click', function (e) {
    var loginEmail = $('#loginEmail').val();
    var loginPassword = $('#loginPassword').val();
    var inputRememberPassword = $('#inputRememberPassword').is(':checked');

    if(loginEmail=='admin' && loginPassword=='admin'){
        location.href = 'admin.php';
    }

    $.ajax({
        url: "backend/userlogin.php",
        type: "GET",
        data: {
            'email': loginEmail,
            'pass': loginPassword,
            'logincheck': inputRememberPassword
        },
        success: function (data) {
            if (data == 'error') {
                Swal.fire({
                    icon: 'error',
                    title: 'User Not found',
                    text: 'Please login using valid credentials',
                })
            } else {
                location.href = 'index.php';
            }
        },
        error: function (data) {
            alert(data);
        }
    });
    e.preventDefault();
});
