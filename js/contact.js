$(document).ready(function() {

              $('#submit').click(function(e){
                e.preventDefault();
                var form = $("#contact_us_form");
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: form.serialize(),
                    url: form.attr('action'),
                    success: function(data){
                        if (data.code !== "200"){
                             $("#error-valid").html(data.msg);
                             $("#error-valid").css("display","block");
                             $("#alert-success").css("display","none");
                        }
                        else
                        {
                            $("#alert-success").css("display","block");
                            $("#error-valid").css("display","none");
                            
                        }
                    }

                });
              });
             return false;
  });
