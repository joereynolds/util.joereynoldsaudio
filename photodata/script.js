$(document).ready(function(){
    $('.delete-button').click(function(){
        var fileName = $(this).parent().find('h1').text();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover the file",
            type: "warning",
            showCancelButton : true,
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(hasConfirmed) {
            if(hasConfirmed) {
                $.ajax({
                    url : 'photodata.php' ,
                    type: 'POST',
                    data: {name : fileName, method : 'delete'}, 
                    success: function(result) {
                        swal('File Deleted!', '', 'success');
                    }
                });
                $(this).parent().remove();
            } else {
                swal('Cancelled', 'Your file is safe', 'success');
            }
        });
    });
});
