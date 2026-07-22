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
            url: main_base_url + "admin/category_list",
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
                    url: main_base_url + "admin/category/delete/" + id,
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


    var i =1;
    $("#add").click(function()
    {
       i++;
       $("#add_data").append('<div class="row" id="row'+i+'"><div class="col-lg-3 mb-5"><div class="fv-row"><input type="text" name="quality[]" class="form-control form-control-lg" placeholder="Quality"></div></div><div class="col-lg-3 mb-5"><div class="fv-row"><input type="text" name="qty[]" class="form-control form-control-lg" placeholder="QTY"></div></div><div class="col-lg-3 mb-5"><div class="fv-row"><input type="text" name="price[]" class="form-control form-control-lg" placeholder="Price"></div></div><div class="col-lg-2 mb-2"><div class="fv-row"><button type="button" id="'+i+'"  class="btn btn-danger removeBtn remove_data">Remove</button></div></div></div>')
    });

    $(document).on('click','.remove_data', function(){
        $ids = $(this).attr('id');
        $('#row'+$ids+'').remove();
     });

     $(document).on('click','.remove_dynamic_data', function(){
        $ids = $(this).attr('id');
        $('#dynamic'+$ids+'').remove();
     });

});


