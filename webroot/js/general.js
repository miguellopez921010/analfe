$('document').ready(function(){
    
    if($("#formcargausuariosmasivo").length>0){
        $("#formcargausuariosmasivo #archivo").change(function(){
            var valor = $(this).val();
            
            if(valor != ''){
                if(checkfilexlsx(valor)){
                    
                }else{
                    $("#formcargausuariosmasivo #archivo").val('');
                }
            }else{
                swal({
                    title: "Error",
                    type: "error",
                    text: 'Seleccione el archivo xlsx',
                    html: true,
                    closeOnConfirm: true,
                });
            }
        });
        
        $("#formcargausuariosmasivo").validate({
            rules: {
                archivo: {required: true},
            },
            messages: {
                archivo: {required: "Campo obligatorio."},
            },
            submitHandler: function (form) {
                if($("#formcargausuariosmasivo #archivo").val() != ''){
                    var data = new FormData();
                    var posicion = 0;

                    $("#formcargausuariosmasivo").find(':input').each(function () {
                        var elemento = this;
                        if (elemento.type === 'file') {
                            var file = elemento.files[0];
                            data.append(elemento.name.toString(), file);
                        } else {
                            data.append(elemento.name, elemento.value);
                        }
                        posicion++;
                    });

                    $.ajax({
                        type: 'POST',
                        url: dir+'Users/saveusersmasivo',
                        datatype: 'json',
                        data: data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            $.blockUI({
                                message: '<img src="'+dir+'img/loader.gif" />',
                                css: {
                                    'border': 'none',
                                    'padding': '15px',
                                    'background': 'none',
                                    '-webkit-border-radius': '10px',
                                    '-moz-border-radius': '10px',
                                    'color': '#fff'
                                }
                            });
                        },
                        success: function (data) {
                            if (typeof data == "string") {
                                data = JSON.parse(data);
                            }

                            if (data.estado == 1) {
                                $.unblockUI();
                                swal({
                                    title: "Bien hecho!",
                                    type: "success",
                                    text: data.mensaje,
                                    html: true,
                                    closeOnConfirm: true,
                                });
                            }
                        }
                    });
                }else{
                    swal({
                        title: "Error",
                        type: "error",
                        text: 'Seleccione el archivo xlsx',
                        html: true,
                        closeOnConfirm: true,
                    });
                }                
            }
        });
    }
    
    if($('#forminvite').length>0){
        $('#forminvite').validate({
            rules: {
                document_number: {required: true},
            },
            messages: {
                document_number: {required: "Campo obligatorio"}
            },
            submitHandler: function (form) {
                var dataString = $(form).serialize();

                //Validar que si esta registrada la Cedula
                //Ir a descargar el certificado de la persona
                
                $.ajax({
                    type: 'POST',
                    url: dir+'Users/validexistbydocumentnumber',
                    datatype: 'json',
                    data: dataString,
                    beforeSend: function () {
                        $.blockUI({
                            message: '<img src="'+dir+'/img/loader.gif" />',
                            css: {
                                'border': 'none',
                                'padding': '15px',
                                'background': 'none',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                'color': '#fff'
                            }
                        });
                    },
                    success: function (data) {
                        if (typeof data == "string") {
                            data = JSON.parse(data);
                        }

                        setTimeout(function () {
                            $.unblockUI();
                            if(data.estado == 1){                            
                                window.location.href = dir+"Users/diplomas?u="+data.informacionusuario['id'];
                            }else{                                
                                swal({
                                    title: "Error",
                                    type: "error",
                                    text: data.mensaje,
                                    html: true,
                                    closeOnConfirm: true,
                                });
                            }
                        }, 1000);
                    }
                });
            }
        });
    }
    
    if($('#formlogin').length>0){
        $('#formlogin').validate({
            rules: {
                email: {required: true, email: true},
                password: {required: true},
            },
            messages: {
                email: {required: "Campo obligatorio", email: "Ingrese un Email valido"},
                password: {required: "Campo obligatorio"},
            },
            submitHandler: function (form) {
                var dataString = $(form).serialize();

                $.ajax({
                    type: 'POST',
                    url: dir+'Users/loginN',
                    datatype: 'json',
                    data: dataString,
                    cache: false,
                    beforeSend: function () {
                        $.blockUI({
                            message: '<img src="'+dir+'/img/loader.gif" />',
                            css: {
                                'border': 'none',
                                'padding': '15px',
                                'background': 'none',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                'color': '#fff'
                            }
                        });
                    },
                    success: function (data) {
                        if (typeof data == "string") {
                            data = JSON.parse(data);
                        }

                        setTimeout(function () {
                            $.unblockUI();
                            if(data.estado == 1){
                                swal({
                                    title: "Bienvenido",
                                    type: "success",
                                    text: data.mensaje,
                                    html: true,
                                    closeOnConfirm: true,
                                });
                                setTimeout(function () {
                                    window.location.href = data.direccion;
                                }, 2000);
                            }else{
                                swal({
                                    title: "Error",
                                    type: "error",
                                    text: data.mensaje,
                                    html: true,
                                    closeOnConfirm: true,
                                });
                            }
                            setTimeout(function () {
                                $('#divMessages').html('');
                            }, 5000);
                        }, 1000);
                    }
                });
            }
        });
        
        $('#remember_me').change(function(){
            var valorcheck = 0;
            if ($(this).is(':checked')) {
                valorcheck = 1;
            }
            if(valorcheck == 1){                
                $(this).prop('checked', true);
            }else{
                $(this).prop('checked', false);
            }
            $(this).val(valorcheck);
            $('#remember_mehidden').val(valorcheck);            
        });
    }
    
    if($('#formadduser').length>0){
        $('#formadduser').validate({
            rules: {
                document_type: {required: true},
                document_number: {required: true},
                name: {required: true},
                lastname: {required: true},
                email: {required: true, email: true},
                type_user_id: {required: true},
                password: {required: true},
                password2: {required: true, equalTo: "#password"}
            },
            messages: {
                document_type: {required: "Campo obligatorio"},
                document_number: {required: "Campo obligatorio"},
                name: {required: "Campo obligatorio"},
                lastname: {required: "Campo obligatorio"},
                email: {required: "Campo obligatorio", email: "Ingrese un Email valido"},
                type_user_id: {required: "Campo obligatorio"},
                password: {required: "Campo obligatorio"},
                password2: {required: "Campo obligatorio", equalTo: "Las contraseñas no coinciden"}
            },
            submitHandler: function (form) {
                var dataString = $(form).serialize();

                $.ajax({
                    type: 'POST',
                    url: dir+'Users/save',
                    datatype: 'json',
                    data: dataString,
                    cache: false,
                    beforeSend: function () {
                        $.blockUI({
                            message: '<img src="'+dir+'/img/loader.gif" />',
                            css: {
                                'border': 'none',
                                'padding': '15px',
                                'background': 'none',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                'color': '#fff'
                            }
                        });
                    },
                    success: function (data) {
                        if (typeof data == "string") {
                            data = JSON.parse(data);
                        }

                        $.unblockUI();
                        $('html, body').animate({
                            scrollTop: '0px'
                        });
                        if(data.estado == 1){                            
                            $('#divMessages').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+data.mensaje+'</div>');
                        }else{
                            $('#divMessages').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>'+data.mensaje+'</div>');
                        }

                        setTimeout(function () {
                            $('#divMessages').html('');
                        }, 5000);
                    }
                });
            }
        });
        
        $('#document_number').keyup(function(){
            formatnumber(this);
        }).change(function(){
            formatnumber(this);
        });
        
        $('#name').keyup(function(e){
            if((e.which>=37 && e.which<=40) || e.which==8 || e.which==46){
                return false;
            }
            var letramayuscula = $(this).val().toUpperCase();
            $(this).val(letramayuscula);
        }).change(function(e){
            if((e.which>=37 && e.which<=40) || e.which==8 || e.which==46){
                return false;
            }
            var letramayuscula = $(this).val().toUpperCase();
            $(this).val(letramayuscula);
        });
        $('#lastname').keyup(function(e){
            if((e.which>=37 && e.which<=40) || e.which==8 || e.which==46){
                return false;
            }
            var letramayuscula = $(this).val().toUpperCase();
            $(this).val(letramayuscula);
        }).change(function(e){
            if((e.which>=37 && e.which<=40) || e.which==8 || e.which==46){
                return false;
            }
            var letramayuscula = $(this).val().toUpperCase();
            $(this).val(letramayuscula);
        });
    }
    
    Dropzone.autoDiscover = false;
                                
    $('#dropzone').dropzone({
        sending: function(file, xhr, formData) {
            formData.append("tipo", 'productos');
        },                   
        url: dir+'Images/cargarimagenesajax',
        addRemoveLinks: true,
        maxFilesSize: 1000,
        dictResponseError: "Error en el servidor",
        acceptedFiles: '.jpg, .png, .jpeg',
        success:function(file, json) {
            if (typeof json == "string"){
                json = JSON.parse(json);
            }

            if(file.status == 'success'){
                var valorimagenes = $('#imagens_id').val();
                $('#imagens_id').val(valorimagenes+','+json.informacion['Imagene']['id']+',');                                            
                $(".dz-preview:last-child").attr('id', json.informacion['Imagene']['id']);

            }                            
        },
        error: function(file){
            alert('Error subiendo el archivo '+file.name);
        },
        removedfile: function(file) {
            var imagen_id = file.previewElement.id;
            $.ajax({
                type:  'POST',
                url:   dir+'Images/deleteimagenesajax',
                datatype: 'json',
                data: {id: imagen_id, tipo: 'productos'},
                beforeSend: function(){
                },
                success:  function (data) {                                                                  
                    if (typeof data == "string"){
                        data = JSON.parse(data);
                    }

                    var valorimagenes = $('#imagens_id').val();
                    if(valorimagenes!=''){
                        if(valorimagenes.substr(-1)==','){
                            valorimagenes = valorimagenes.substring(0,valorimagenes.length-1);
                        }

                        var nuevacadenaimagenes = "";
                        var arrayimagenesproducto = valorimagenes.split(',');
                        for(var j=0;j<arrayimagenesproducto.length;j++){
                            if(data.id != arrayimagenesproducto[j]){
                                nuevacadenaimagenes = nuevacadenaimagenes+arrayimagenesproducto[j]+',';
                            }
                        }

                        $('#imagens_id').val(nuevacadenaimagenes);                                    
                        $('.dropzone div#'+data.id).remove();
                    }
                }
            });
        }
    });
    
    $(":file").filestyle({size: "md", buttonText: "Seleccionar", icon: true});
});

function formatnumber(input){
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;
    }else{ 
        alert('Solo se permiten numeros');
    }
    input.value = input.value.replace(/[^\d\.]*/g,'');
}

function checkfilexlsx(fileExt) {
    var validExts = new Array(".xlsx", ".xls");
    fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
    if (validExts.indexOf(fileExt) < 0) {
        swal({
            title: "Error",
            type: "error",
            text: "Archivo invalido, los tipos de archivos permitidos son " + validExts.toString(),
            html: true,
            closeOnConfirm: true,
        });
        return false;
    }
    else return true;
}

function soloNumeros(evt) {
    //asignamos el valor de la tecla a keynum
    if (window.event) {// IE
        keynum = evt.keyCode;
    } else {
        keynum = evt.which;
    }
    //comprobamos si se encuentra en el rango
    if (keynum > 47 && keynum < 58) {
        return true;
    } else {
        return false;
    }
}