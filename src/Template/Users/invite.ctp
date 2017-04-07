<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-3"></div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="contentformlogin">
                <form id="forminvite" method="post">
                    <div class="contentheaderformlogin">
                        <img src="<?php echo $dir; ?>img/logos/logo.png" class="img-responsive" style="margin: 0px auto;" />
                        <p class="text-center" style="max-width: 170px;margin: 10px auto;font-weight: bold;color: #126596;">PANEL ADMINISTRATIVO DE CERTIFICACIONES</p>
                    </div>
                    <div class="contentcontentformlogin">
                        <label for="document_number" class="text-center">Ingrese su n&uacute;mero de documento para generar y descargar su certificaci&oacute;n</label>
                        <div class="form-group has-feedback has-feedback-left">                            
                            <span class="glyphicon icons-feedback icon-cc form-control-feedback"></span>
                            <input type="text" class="form-control" id="document_number" name="document_number" onkeypress="return soloNumeros(event)" onpaste="return soloNumeros(event)"  onkeyup="formatnumber(this)" onchange="formatnumber(this)">                                      
                        </div>
                    </div>
                    <div class="contentfooterformlogin">
                        <div class="form-group text-center" style="margin-bottom:0px !important;">
                            <button class="btn btn-primary btn-block btn-lg">Generar</button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="text-center" style="font-size: 15px;margin: 20px auto;">© <?php echo date("Y"); ?> <label style="color: #4c90d0; font-weight: normal;">Analfe</label> | Todos los derechos reservados.<p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-3"></div>
    </div>
</div>