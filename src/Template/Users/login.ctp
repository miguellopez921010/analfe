<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-3"></div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="contentformlogin">                
                <form id="formlogin" method="post">
                    <div class="contentheaderformlogin">
                        <img src="<?php echo $dir; ?>img/logos/logo.png" class="img-responsive" style="margin: 0px auto;" />
                        <p class="text-center" style="max-width: 170px;margin: 10px auto;font-weight: bold;color: #126596;">PANEL ADMINISTRATIVO DE CERTIFICACIONES</p>
                    </div>
                    <div class="contentcontentformlogin">
                        <div class="form-group has-feedback has-feedback-left">
                            <label for="email">E-mail</label>
                            <span class="glyphicon icons-feedback icon-user form-control-feedback"></span>
                            <input type="email" class="form-control" id="email" name="email">                    
                        </div>
                        <div class="form-group has-feedback has-feedback-left" style="margin-bottom: 0px !important">
                            <label for="password">Password</label>
                            <span class="glyphicon icons-feedback icon-key form-control-feedback"></span>
                            <input type="password" class="form-control" id="password" name="password">                    
                        </div>
                        <input type="hidden" id="remember_mehidden" name="remember_mehidden" value="0">
                        <!--<div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" value="0" id="remember_me" name="remember_me">Recordar contraseña</label>
                            </div>                   
                        </div>-->
                    </div>
                    <div class="contentfooterformlogin">
                        <div class="form-group text-center" style="margin-bottom:0px !important;">
                            <button class="btn btn-primary btn-block btn-lg">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>

            <p class="text-center" style="font-size: 15px;margin: 20px auto;">© <?php echo date("Y"); ?> <label style="color: #4c90d0; font-weight: normal;">Analfe</label> | Todos los derechos reservados.<p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-3"></div>
    </div>
</div>