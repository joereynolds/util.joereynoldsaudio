$(document).ready(function(){

    $('form').submit(function(){
        //make sure to not exceed 2mb 
        if ($('[type=file]')[0].files[0].size >= 2000000) {
            swal({
                title: "Filesize exceeded",
                text: "This file is greater than the 2 megabyte size limit",
                type: "warning"
            });
            return false;
        }
    });

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
                    url : '/ajax/photodataDelete.php' ,
                    type: 'DELETE',
                    data: {name : fileName},
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
