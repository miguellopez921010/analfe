<div class="container contenedormassiveusers">
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php 
        if($type_user_id == 1 || $type_user_id == 2){
            ?>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        USUARIOS
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <?php 
                            if($type_user_id == 1){
                                ?>
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 text-center">
                                <a href="<?php echo $dir; ?>Users/add">
                                    <img src="<?php echo $dir; ?>img/icons/add_user.png" class="img-responsive">
                                    <label style="color: #000;">Nuevo Usuario</label>
                                </a>                                
                            </div>
                                <?php
                            }
                            ?>
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-3 text-center">
                                <a href="<?php echo $dir; ?>Users/massiveusers">
                                    <img src="<?php echo $dir; ?>img/icons/users_group.png" class="img-responsive">
                                    <label style="color: #000;">Cargar Usuarios (Excel)</label>
                                </a>                                
                            </div>                            
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
            <?php
        }
        ?>
    </div>
</div>