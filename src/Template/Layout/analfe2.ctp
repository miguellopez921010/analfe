<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="utf-8" /> 
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="Author" content="Miguel Lopez" />
        <meta name="robots" content="index,follow">
        <meta http-equiv="pragma" content="no-cache" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <title>Analfe</title>
        
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        
        <script type="text/javascript">
            var dir= "<?php echo $dir; ?>" ;
            var user_id =  <?php 
            if($logged_in == 0){
                echo 0;
            }else{
                echo $idLogged;
            }
            ?> ;
        </script>
        
        <?php 
//        echo $this->Html->script('jquery-3.0.0.min');
        echo $this->Html->css('general');
        echo $this->Html->css('jquery-ui.min');
        echo $this->Html->css('jquery-ui.structure.min');
        echo $this->Html->css('jquery-ui.theme.min');
        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('sweetalert');
//        echo $this->Html->css('full-slider');
//        echo $this->Html->css('bootstrap-multiselect');
//        echo $this->Html->css('jquery.bxslider'); 
        echo $this->Html->css('dropzone'); 
        ?>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!--         Latest compiled and minified JavaScript 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->

        <link href="https://github.com/scottjehl/Respond/blob/master/cross-domain/respond-proxy.html" id="respond-proxy" rel="respond-proxy" />
    </head>
    
    <body>
        <div class="main-header-parent">
            <?php echo $this->element('header'); ?>
        </div>
        <div class="main-header-parent-mobile">
            <?php echo $this->element('headermobile'); ?>
        </div>
        
        <div class="main-content-parent">
            <?php // echo $this->element('modals'); ?>
        
            <div class="container">
                <div id="divMessages" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
            </div>
            
            <div id="container">                
                <?php echo $this->fetch('content'); ?>
            </div>
        </div>
        
        <div class="main-footer-parent">
            <p class="text-center">© <?php echo date("Y"); ?> <label style="color: #4c90d0; font-weight: normal;">Analfe</label> | Todos los derechos reservados.<p>
        </div>
        
        <?php
        echo $this->Html->script('bootstrap.min');    
        echo $this->Html->script('general');        
        echo $this->Html->script('jquery-ui.min');
        echo $this->Html->script('jquery.validate.min');
        echo $this->Html->script('jquery.blockUI');
        echo $this->Html->script('bootstrap-filestyle.min');
        echo $this->Html->script('sweetalert.min');
//        echo $this->Html->script('bootstrap-multiselect');
//        echo $this->Html->script('jquery.bxslider.min'); 
//        echo $this->Html->script('config-facebook'); 
        echo $this->Html->script('dropzone'); 
        ?>  
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>        
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    </body>
</html>