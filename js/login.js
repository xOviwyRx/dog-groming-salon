$(document).ready(function() {

              $('#submit').click(function(e){
                e.preventDefault();
                var form = $("#login_form");
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: form.serialize(),
                    url: form.attr('action'),
                    success: function(data){
                        if (data.code !== "200"){
                             $("#error-valid").html(data.msg);
                             $("#error-valid").css("display","block");
                        }
                        else
                        {
                            location.href = "../index.php";
                        }
                    }

                });
              });
             return false;
  });
