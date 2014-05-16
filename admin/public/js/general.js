// JavaScript Document
var data_exc = "";
function deleteAllCookies() {
	//alert("deleteAllCookies")
    var cookies = document.cookie.split(";");
	//alert(cookies.length)
    for (var i = 0; i < cookies.length; i++) {
    	var cookie = cookies[i];
    	var eqPos = cookie.indexOf("=");
    	var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    	document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}
//---------------------------------------------------------------------------
function gral_btn_edit(){
	$( ".edit" ).button({
      icons: {
        primary: "ui-icon-pencil"
      },
      text: false
    })
	}
//-----------------------------------
function gral_btn_note(){
	$( ".note" ).button({
      icons: {
        primary: "ui-icon-note"
      },
      text: false
    })
	}	
//-----------------------------------
function gral_boton(){
	$(".boton").button();
	}	
//-----------------------------------
function gral_btn_gear(){
	$( ".gear" ).button({
      icons: {
        primary: "ui-icon-gear"
      },
      text: false
    })
	}
//-----------------------------------
function gral_btn_add(){
	$( ".add" ).button({
      icons: {
        primary: "ui-icon-plus"
      },
      text: false
    })
	}			
//-----------------------------------
function gral_data_excel(x,f){
	if(x==1){
		
		$.ajax({
			url: "public/libs/PHPExcleReader/",
			type: "GET",
			success: function(data) {
				var result = data;
				//Ejecutar funcion f
				window[f](result);
				}
			});		
		}
	}	
//-----------------------------------
function gral_cargando(){
	$("#dialog_message").dialog( "option", "modal", true );	
	$('#dialog_message').html('<p align="center"><img src="public/images/cargando.gif" > Procesando datos.Espere un momento, por favor.</p>');
	$("#dialog_message").dialog('open');
	$("body").css("cursor", "progress");
	}	
//-----------------------------------
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
        return false;
    return true;
}	