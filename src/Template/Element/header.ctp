<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divcontentheader">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-9">
                <div class="row">
                    <div class="col-lg-1 col-md-1"></div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <a href="<?php echo $dir; ?>">
                            <img src="<?php echo $dir; ?>img/logos/logo.png" class="img-responsive" />
                        </a>                        
                    </div>
                    <div class="col-lg-1 col-md-1"></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-3 text-right" style="display: table;height: 70px;">
                <div style="display: table-cell;vertical-align: middle;">
                    <?php 
                    if($logged_in==0){
                        ?>
                    <a class="btn btn-link btn-login" href="<?php echo $dir; ?>Users/login">Iniciar sesión</a>
                        <?php
                    }else{
                        ?>
                    <a class="btn btn-link" href="<?php echo $dir; ?>Users/account"><b>HOLA</b> <?php echo $nameLogged; ?></a>
                    <span> | </span>
                    <a class="btn btn-link" href="<?php echo $dir; ?>Users/logout">Cerrar sesión</a>
                        <?php
                    }
                    ?> 
                </div>                               
            </div>
        </div>
    </div>
</div>