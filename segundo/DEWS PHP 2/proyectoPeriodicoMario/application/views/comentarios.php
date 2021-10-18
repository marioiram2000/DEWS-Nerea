<div class="col-3 my-3  mx-auto border border-dark rounded" >
    <h3 class="p-2">COMENTARIOS:</h3>
    <p><small>Los comentarios serán revisados antes de ser publicados</small></p>
    <ul class="list-group list-group-flush">
<?php
    if($this->session->userdata('uid')!=null && $this->session->userdata('periodista')==null){
        $ruta = base_url()."index.php/c_noticias/comentar/".$nid;
        echo form_open($ruta);
        
        echo form_input("comentario");
        
        $data =  array('name' => 'submit', 'value' => 'comentar', 'class' => 'btn btn-secondary');
        echo form_submit($data);
        echo form_close();
    }
    foreach ($comentarios as $comentario) {
        if(!$comentario->activo){
            if($this->session->userdata('admin') || $comentario->uid == $this->session->userdata("uid")){
            echo "<li class='list-group-item'>";
                echo "<div class='d-flex w-100 justify-content-between'>";
                    echo "<h5 class='mb-1  text-capitalize'>$comentario->nombre</h5>";
                    echo "<small class='font-italic'>$comentario->fecha</small>";
                echo "</div>";
                echo "<p>$comentario->comentario</p>";
                if($this->session->userdata('admin')){
                    $link = site_url()."/c_noticias/borrarComentario/$comentario->id/$nid";
                    echo "<p class='d-flex justify-content-between'>";
                        echo "<a href='".$link."'>Borrar comentario</a>";
                        if(!$comentario->activo){
                            $link = site_url()."/c_noticias/publicarComentario/$comentario->id/$nid";
                            echo "<a href='".$link."'>Publicar comentario</a>";
                        }

                    echo "</p>";
                }else{
                    echo "<p><small class='text-info'>El comentario será publicado después de la revisión</small></p>";
                }
            echo "</li>";
            }
        }else{
            echo "<li class='list-group-item'>";
                echo "<div class='d-flex w-100 justify-content-between'>";
                    echo "<h5 class='mb-1  text-capitalize'>$comentario->nombre</h5>";
                    echo "<small class='font-italic'>$comentario->fecha</small>";
                echo "</div>";
                echo "<p>$comentario->comentario</p>";
                if($this->session->userdata('admin')){
                    $link = site_url()."/c_noticias/borrarComentario/$comentario->id/$nid";
                    echo "<p class='d-flex justify-content-between'>";
                        echo "<a href='".$link."'>Borrar comentario</a>";
                    echo "</p>";
                }
            echo "</li>";
        }
        
    }
?>
    </ul>
</div>