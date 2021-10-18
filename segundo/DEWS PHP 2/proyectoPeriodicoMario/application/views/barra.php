<div class="col-2 py-3 vh-100">
    <div class="position-fixed">
        <h5>Clasificación de noticias:</h5>
        <ul class="list-group">
            <?php
            $activo = "";
            $color = "";
            $enlace = site_url()."/c_index/index";
            if(!isset($idtipo) || $idtipo==null){
               $activo = "active";
               $color = "text-white";
            }
            echo "<a href='$enlace' class='$color text-decoration-none'> <li  class='list-group-item d-flex justify-content-between align-items-center $activo'>Todas </li></a>";
            
            foreach ($tipos as $tipo) {
                $enlace = site_url()."/c_index/tipo/$tipo->id";
                $activo = "";
                $color = "";
                if(isset($idtipo) && $idtipo == $tipo->id){
                    $activo = "active";
                    $color = "text-white";
                }
                echo "<a href='$enlace' class='$color text-decoration-none'>";
                    echo "<li  class='list-group-item d-flex justify-content-between align-items-center $activo'>"
                        . "$tipo->tipo"
                        . "<span class='badge badge-primary badge-pill'>$tipo->cantidad</span>"
                    . "</li>";
                echo "</a>";
            }
            ?>
        </ul>
    </div>
</div>