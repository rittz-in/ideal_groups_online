function validateTab(id) 
{
    var categorydata = id;
    $allow_next = true;
    $("input").removeClass("error");
    $("label.error").remove();
    $('#' + categorydata + ' .require-input').each(function () 
	{
        $field_value = $(this).val();
        if ($field_value == '') 
        {
            $allow_next = false;
            $(this).addClass("error");
            $(this).after("<label class='error text-danger'>This Field is required</label>");
        }
        else 
        {
            $allow_next = true;
        }
    });
    return $allow_next;


}
$(document).ready(function () {
    $(".category_form").click(function () 
	{
        $id = $(this).attr("id");
        $allow_fields = validateTab($id);
        if ($allow_fields) 
        {
            $form_id = $("#cat_id").val();
            $fname = $("#fname").val();
            $mobile = $("#mobile").val();
            $email = $("#email").val();
            $quality = $("#quality").val();
            $qty = $("#qty").val();
            
        
            $.ajax({
                url: base_url + "/category_form/" + $form_id,
                type: "POST",
                data: {
                    cat_id: $form_id,
                    fname: $fname,
                    mobile: $mobile,
                    email: $email,
                    quality: $quality,
                    qty: $qty,
                   
                },
                success: function(response) 
                {
                    const obj = JSON.parse(response);
                  
                    if(obj.type == 'success')
                    {
                        window.location.href= base_url + 'category/'+ $form_id;
                        
                    } 
                    // else 
                    // {
                    //     $('#gRecaptchaResponseEventFError'+$id).html(obj.message);
                    // }
                    
                }

                
            });
           

           

        }    
       
        
        // $allow_fields = validateTab($id);
       
    });
});