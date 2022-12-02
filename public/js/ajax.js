$(document).ready(function(){
    $("#cedula").keyup(function(){
        if($("#cedula").val() !=""){
            valor = $("#cedula").val();
                $.ajax({
                    type:"POST",
                    dataType:"html",
                    url: varjs+"/getNameCedula",
                    data:"cedula="+valor,
                        success:function(msg){
                            console.log(11);
                            $("#nombre").empty().removeAttr("disabled").append(msg);
                        }
                    });
                }else{
                    $("#nombre").empty().attr("disabled","disabled");
                };
                
            });
});