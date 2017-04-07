<div class="container contenedormassiveusers">
    <form id="formcargausuariosmasivo" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                <fieldset>
                    <legend>Exportar</legend>                    
                    <div class="form-group">
                        <p class="text-justify">
                            Esta es la plantilla que se usarà para el cargue masivo de los usuarios. Por recomendaciòn                             
                            solo hacer uso de esta Plantilla.
                        </p>
                        <a class="btn btn-default btn-block" href="<?php echo $dir; ?>Users/downloadtemplate"><i class="glyphicon glyphicon-cloud-download"></i> Descargar</a>
                    </div>
                </fieldset>    
            </div>
            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                <fieldset>
                    <legend>Importar</legend>
                    <div class="form-group">
                        <label>Seleccionar archivo (de EXCEL)</label> <small>(se sugiere que el archivo a subir sea la plantilla descargada.)</small>
                        <input type="file" id="archivo" name="archivo">
                        <!--<div class="dropzone" id="dropzone"></div>-->
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-cloud-upload"></i>  Cargar archivo</button>
                </fieldset>
            </div>
        </div>
    </form>
</div>