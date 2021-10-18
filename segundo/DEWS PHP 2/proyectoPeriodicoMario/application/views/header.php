<html>
    <head>
        <meta charset="UTF-8">
        <title>Periodico dw2</title>
        <link rel="stylesheet" href="<?php echo base_url("recursos/css/bootstrap.min")?>" type="text/css">
        <script src="<?= base_url("recursos/js/bootstrap.min")?>"></script>
        <script type="text/javascript" src="<?= base_url("ckeditor/ckeditor.js")?>"></script>
    </head>
    <body class="p-0">
        <div class="sticky-top text-white bg-dark">
            <div class="text-center pt-2 row m-0">
                <?php
                $enlace = site_url()."/c_index/index";
                echo "<h1 class='m-auto' style='height: 60px'><a href='$enlace' class='text-white text-decoration-none'>Periodico dw2</a></h1>";
            echo "</div>";
            echo "<div class='row m-0 d-flex justify-content-end'>";
                echo '<nav class="nav sticky-top font-weight-bold mr-0">';
                    
                    echo "<h5><a class='nav-link text-white' href='$enlace'> Inicio </a></h5>";
                    if($this->session->userdata('uid')!=null){
                        $enlace = site_url()."/c_login/logout";
                        echo "<h5><a class='nav-link text-white' href='$enlace'> Logout </a></h5>"; 
                    }else{
                        $enlace = site_url()."/c_login/index";
                        echo "<h5><a class='nav-link text-white' href='$enlace'> Login </a></h5>";
                    }
                    if($this->session->userdata('periodista')!=null){
                        $enlace = site_url()."/c_noticias/nuevaNoticia";
                        echo "<h5><a class='nav-link text-white' href='$enlace'> Nueva noticia </a></h5>";
                    }
                    if($this->session->userdata('admin')==true){
                        $enlace = site_url()."/c_noticias/publicarNoticias";
                        echo "<h5><a class='nav-link text-white' href='$enlace'> Publicar noticias </a></h5>";
                    }
                echo "</nav>";
                    ?>
                
            </div>
            
        </div>
        <div class="row  m-0 ">