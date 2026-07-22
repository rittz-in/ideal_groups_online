$(document).ready(function() {
    var table = $('#kt_datatable');
    // begin first table
    table.dataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        order: [],
        columnDefs: [{
            orderable: false,
            targets: []
        }],
        "searching": true,
        "ajax": {
            url: main_base_url + "admin/product_list",
            type: 'GET',
            'data': function(data) {
                var global_search = $('#global_search').val();
                var name = $('#searchByName').val();
                data.global_search = global_search;
                data.searchByName = name;
            }
        }
    });
    $(document).on('click', '.user-delete-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('idos');
        Swal.fire({
            title: "Are you sure?",
            text: "You won\"t be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light"
            }
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: main_base_url + "admin/product/delete/" + id,
                    type: "GET",
                    success: function(response) {
                        var obj = JSON.parse(response);
                        
                        console.log(obj);
                        if (obj.status == 'success') {
                            table.api().ajax.reload();
                            Swal.fire("Deleted!", obj.message, "success")
                        } else {
                            Swal.fire("Error!", obj.message, "error")
                        }
                    }
                });
            }
        });
    });
    $('#global_search').keyup(function() {
        table.api().ajax.reload();
    });


    $(document).on('change', '#role_selection', function(e) {
        if ($(this).val() == 2) {
            $("#k-treeview").removeClass("k-treeview");
            // $(".k-treeview").css("display", "unset");
        } else {
            $("#k-treeview").addClass("k-treeview");
            // $(".k-treeview").css("display", "none");            
        }
    });
});


