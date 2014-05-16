var hstTable;
$(document).ready(function () {
	$(".boton").button();
	//Cargar tabla principal
	hst_load_datatable();

	//Crear dialog formulario
	$( "#hst_dialog_formu" ).dialog({
		autoOpen:false,
		modal: true,
		width: 650,
		height: 530,
		buttons: {
			Cancelar: function() {
				$(this).dialog( "close" );
			},
			Guardar: function() {				
				hst_val_data();
			}
		}
	});
	
	
	});
//----------------------------
function hst_load_datatable(){
	scroll_table=($("#hst_main").height()-125)+"px";
	
    hstTable = $('#hst_table').dataTable({
	  "sScrollY": scroll_table,
      "bDestroy": true,
      "bLengthChange": true,
      "bPaginate": false,
      "bFilter": true,
      "bSort": true,
      "bJQueryUI": true,
      "iDisplayLength": 20,      
      "bProcessing": true,
      "bAutoWidth": false,
      "bSortClasses": false,
      "sAjaxSource": "index.php?m=mHistoria&c=mRegistro",
      "aoColumns": [
	  
	    { "mData": " ", sDefaultContent: "" },
		{ "mData": "ID", sDefaultContent: "","bSearchable": false,"bVisible":    false },
        { "mData": "TITULO", sDefaultContent: "" },
        { "mData": "USUARIO", sDefaultContent: ""},
		{ "mData": "FECHA", sDefaultContent: "" }
      ] , 
      "aoColumnDefs": [
        {"aTargets": [0],
          "sWidth": "65px",
          "bSortable": false,        
          "mRender": function (data, type, full) {
            var edit  = '';
            var del   = '';

            edit = "<td><div onclick='hst_abrir_formulario("+full.ID+",2);' class='custom-icon-edit-custom'>"+
                    "<img class='total_width total_height' src='data:image/gif;base64,R0lGODlhAQABAJH/AP///wAAAMDAwAAAACH5BAEAAAIALAAAAAABAAEAQAICVAEAOw=='/>"+
                    "</div></td>";

            del = "<td><div onclick='hst_delete_function("+full.ID+");' class='custom-icon-delete-custom'>"+
                    "<img class='total_width total_height' src='data:image/gif;base64,R0lGODlhAQABAJH/AP///wAAAMDAwAAAACH5BAEAAAIALAAAAAABAAEAQAICVAEAOw=='/>"+
                    "</div></td>";
			

            return '<table><tr>'+edit+del+'</tr></table>';
        }}	
      ],
      "oLanguage": {
          "sInfo": "Mostrando _TOTAL_ registros (_START_ a _END_)",
          "sEmptyTable": "No hay registros.",
          "sInfoEmpty" : "No hay registros.",
          "sInfoFiltered": " - Filtrado de un total de  _MAX_ registros",
          "sLoadingRecords": "Leyendo información",
          "sProcessing": "Procesando",
          "sSearch": "Buscar:",
          "sZeroRecords": "No hay registros",
      }
    }); 
	}	
//----------------------------------------
function hst_abrir_formulario(id,op){
	//alert(id+"/"+op)
	if(op==1){$("#hst_dialog_formu").dialog('option', 'title', 'Agregar historia');}
	if(op==2){$("#hst_dialog_formu").dialog('option', 'title', 'Editar historia');}
	      $.ajax({
          url: "index.php?m=mHistoria&c=mFormulario",
          type: "GET",
          data: {
			  id : id,
			  op : op
			    },
          success: function(data) {
            var result = data; 
            $('#hst_dialog_formu').html('');
            $('#hst_dialog_formu').dialog('open');
			$('#hst_dialog_formu').html(result); 
          }
      });
	}	
//-----------------------------------------------
function vac_parrafo(id){
	
	var p = '';
	var a = $('#'+id+'').val().search("<p>");
	var b = $('#'+id+'').val().search("</p>");
	//alert(a)
	
	var ex = $('#'+id+'').val().split("\n");

	$.each(ex, function(x){
		
		p += (a<=-1)?'<p>'+ex[x]+'</p>':ex[x];

		 });

	return p;	   
	}
//-----------------------------------------------

function hst_val_data(){
	var ifs = 0;
	var op = $("#hst_hop").val();
	if($("#hst_ttl").val().length == 0){
		ifs=ifs+1;
		$('#dialog_message').html('<p align="center"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 1px 25px 0;"></span>Debe escribir el título de la historia.</p>');
		$("#dialog_message" ).dialog('open');	
		return false;
		}
	if($("#hst_txt").val().length == 0){
			ifs=ifs+1;
			$('#dialog_message').html('<p align="center"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 1px 25px 0;"></span>Debe escribir el texto de la historia.</p>');
			$("#dialog_message" ).dialog('open');	
			return false;
			}
		else{
			$('#hst_txt').val(vac_parrafo('hst_txt'));
			}

	if(op==1){
		if($("#hst_img").val().length == 0){
			ifs=ifs+1;
			$('#dialog_message').html('<p align="center"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 1px 25px 0;"></span>Debe seleccionar la imagen de la historia.</p>');
			$("#dialog_message" ).dialog('open');	
			return false;
			}	
	}
	if($("#datepicker").val().length == 0){
		ifs=ifs+1;
		$('#dialog_message').html('<p align="center"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 1px 25px 0;"></span>Debe seleccionar la fecha de la historia.</p>');
		$("#dialog_message" ).dialog('open');	
		return false;
		}

																											
	if(ifs==0){
		//sel();
		$("#hst_form").submit();
		gral_cargando();
		}
	}	
//----------------------------------
function hst_mensaje(mns){
	$("body").css("cursor", "default");	
	$('#dialog_message').html('<p align="center"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 1px 25px 0;"></span>'+mns+'</p>');
	$('#hst_dialog_formu').dialog('close');
	hst_load_datatable();
	}	
//-------------------------------------------------------------------------
function hst_delete_function(q){
	  $( "#hst_dialog_confirm" ).dialog({
      autoOpen:false,   
      resizable: false, 
      height:140,
      modal: true,
      buttons: {
        "Aceptar": function() {         
          hst_send_delete(q);
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

    $('#hst_dialog_confirm').html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>&iquest;Desea borrar a esta historia?</p>');
    $("#hst_dialog_confirm").dialog("open");		
	}	
//-----------------------------------------------------------------------
function hst_send_delete(q){	

      $.ajax({
          url: "index.php?m=mHistoria&c=mDelete",
          type: "GET",
          data: { 
		  id : q
		  },
          success: function(data) {
            var result = data; 
            if(result==1){
				
				$('#dialog_message').html('<p align="center"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 1px 25px 0;"></span>Los datos han sido eliminados correctamente.</p>');
				$("#dialog_message" ).dialog('open');
				hst_load_datatable();
				}
			else{
	
				$('#dialog_message').html('<p align="center"><span class="ui-icon ui-icon-alert" style="float:left; margin:0 1px 25px 0;"></span>Ha ocurrido un error intentelo nuevamente.</p>');
				$("#dialog_message" ).dialog('open');
				}	
          }
      });
	 }			