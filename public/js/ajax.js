// @ts-nocheck
$(function(){
    
    $("#cedula_buscar").on('change', function(){
        if($("#cedula_buscar").val() !=""){
            var valor = $("#cedula_buscar").val();console.log(valor)
                $.ajax({
                    type:"POST",
                    dataType:"html",
                    url: varjs+"membresia/miembros_select",
                    data:"cedula="+valor,
                        success:function(msg){
                            $("#idmembresias").empty().removeAttr("disabled").append(msg);
                        }
                    });
        }
        else{
            $("#idmembresias").empty().attr("disabled","disabled");
        }
    });
});