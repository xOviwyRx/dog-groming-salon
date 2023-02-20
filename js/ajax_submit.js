$(document).ready(function() {

              $('#submit').click(function(e){
                e.preventDefault();
                var form = $("#ajax_form");
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
                            if (typeof data.location !== 'undefined'){
                                location.href = data.location;
                            } else {
                                $("#alert-success").css("display","block");
                                $("#error-valid").css("display","none");
                            }
                        }
                    }

                });
              });
             return false;
  });
