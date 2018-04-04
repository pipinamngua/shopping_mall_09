$(document).ready( function () {
    $('#myTable').DataTable();

    $('#button_update_status').click(function () {
        var status = $(this).parents().find('#status_bill_detail').val();
        var idOrder = $(this).parents().find('#status_bill_detail').attr('idOrder');
        var button_update_status = $(this);
        
        $.ajax({
            url: '/update-status-order',
            type: 'GET',
            data: {
                status: status, 
                idOrder: idOrder
            },
            success: function (res) {
                if (res == 'Hoàn Thành') {
                    button_update_status.parents().find('.del_option').remove();
                    button_update_status.parents('.dlt').remove();
                }
                toastr.success('Update Status Successfully!');
            }
        });
    });
});