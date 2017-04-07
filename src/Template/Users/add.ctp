<div class="container">
    <form id="formadduser" method="post">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="document_type">Tipo de documento</label>
                    <select class="form-control" id="document_type" name="document_type" required>
                        <option value="CC">Cédula ciudadana</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="document_number">Número de documento</label>
                    <input type="text" class="form-control" id="document_number" name="document_number" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="name">Nombres</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="lastname">Apellidos</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
            </div>
        </div>

        <?php 
        if($type_user_id == 2){
            ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
        </div>
            <?php
        }elseif($type_user_id == 1){
            ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="type_user_id">Tipo de usuario</label>
                    <select id="type_user_id" name="type_user_id" class="form-control">
                        <option value="">Seleccionar tipo de usuario</option>
                        <option value="1">Súper administrador</option>
                        <option value="2">Administrador</option>
                    </select>
                </div>
            </div>
        </div>    
            <?php
        }
        ?>
        

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="password2">Repetir contraseña</label>
                    <input type="password" class="form-control" id="password2" name="password2" required>
                </div>
            </div>
        </div>
        
        
        <div class="form-group text-center">
            <button class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>