<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_noticias extends CI_Controller {
    public function __construct(){
        parent::__construct();
    }
    
    function noticia($nid){
        if($this->session->userdata('uid')==null){
            $arr = $this->session->userdata('invitado');
            if(count($arr)>2 && !in_array($nid, $arr)){
                redirect('c_index/limNoticias/', 'refresh'); 
            }
            if(!in_array($nid, $arr))
                $arr[] = $nid;
            $this->session->set_userdata("invitado", $arr);
        }
        
        
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        $dataNoticia['noticia'] = $this->m_periodico->getNoticia($nid);
        $dataNoticia['nid'] =$nid;
        $dataComentarios['comentarios'] = $this->m_periodico->getComentariosNoticia($nid);
        
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view('noticia',$dataNoticia);
        $this->load->view('comentarios',$dataComentarios);
        $this->load->view('footer');
    }
    
    function comentar($nid){
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        $dataNoticia['noticia'] = $this->m_periodico->getNoticia($nid);
        $dataNoticia['nid'] = $nid;
        
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->form_validation->set_rules('comentario', 'Comentario', 'required');
        $this->form_validation->set_message('required', 'El campo es obligatorio');
       
        if ($this->form_validation->run() != FALSE){
            $this->m_periodico->comentar($this->session->userdata('uid'), $nid, $_POST['comentario']);
            redirect('c_noticias/noticia/'.$nid, 'refresh'); 
        }
        
        $this->load->view('noticia',$dataNoticia);
        $this->load->view('comentarios',$dataComentarios);
        $this->load->view('footer');     
    }
    
    function nuevaNoticia(){
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        $error = array('errorImg' => "");
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view('nuevaNoticia', $error);
        $this->load->view('footer');
    }
    
    function validarNuevaNoticia() {
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('subtitulo', 'subtitulo', 'required');
        //$this->form_validation->set_rules('imagen', 'imagen', 'required');
        $this->form_validation->set_rules('noticia', 'noticia', 'required');
        
        $this->form_validation->set_message('required', 'El campo es obligatorio');
        
        if ($this->form_validation->run() != FALSE){
            
            $config['upload_path'] = "./imagenes/";
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2000;
            $config['max_width'] = 1500;
            $config['max_height'] = 1500;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('imagen')) {
                $error = array('errorImg' => $this->upload->display_errors());

                $dataBarra['tipos'] = $this->m_periodico->getTipos();
                $this->load->view('header');
                $this->load->view('barra',$dataBarra);
                $this->load->view('nuevaNoticia', $error);
                $this->load->view('footer');
            } else {
                $data = array('image_metadata' => $this->upload->data());//Array ( [file_name] => coche_21.jpg [file_type] => image/jpeg [file_path] => C:/wamp64/www/proyectoPeriodicoMario/imagenes/ [full_path] => C:/wamp64/www/proyectoPeriodicoMario/imagenes/coche_21.jpg [raw_name] => coche_21 [orig_name] => coche_2.jpg [client_name] => coche_2.jpg [file_ext] => .jpg [file_size] => 31.17 [is_image] => 1 [image_width] => 624 [image_height] => 385 [image_type] => jpeg [image_size_str] => width="624" height="385" )
                
                $pid = $this->session->userdata('periodista')['id'];
                $titulo = htmlentities($_POST['titulo']);
                $subtitulo = htmlentities($_POST['subtitulo']);
                $contenido = nl2br(htmlentities($_POST['noticia']));
                
                $nid = $this->m_periodico->insertNoticia($pid, $titulo, $subtitulo, $_POST['noticia']);
                $this->m_periodico->insertImg($nid, $data['image_metadata']['file_name']);
                redirect('c_noticias/noticiaSubida/'.$nid, 'refresh'); 
                
            }
            
            
            
        }else{
            $dataBarra['tipos'] = $this->m_periodico->getTipos();
            $this->load->view('header');
            $this->load->view('barra',$dataBarra);
            $this->load->view('nuevaNoticia');
            $this->load->view('footer');
        }
    }
    
    function noticiaSubida($nid){
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        $dataNoticia['noticia'] = $this->m_periodico->getNoticiaCheck($nid);
        $dataNoticia['nid'] =$nid;
        
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view('noticiaSubida',$dataNoticia);
        $this->load->view('footer');
    }
    
    function publicarNoticias(){
        $tipos = $this->m_periodico->getTodosTipos();
        $arr = array();
        foreach ($tipos as $tipo) {
            $arr[$tipo->id] = $tipo->tipo;
        }
        
        $dataBarra['tipos'] = $this->m_periodico->getTipos();
        $dataNoticias['tipos'] = $arr;
        $dataNoticias['noticias'] = $this->m_periodico->getNoticiasSinPublicar();
        
        
        $this->load->view('header');
        $this->load->view('barra',$dataBarra);
        $this->load->view('publicarNoticias',$dataNoticias);
        $this->load->view('footer');
    }
    
    function publicarNoticia($nid){
        //echo $nid."\t".$_POST['tipos'];
        if(isset($_POST['submitPublicar'])){
            $this->m_periodico->publicarNoticia($_POST['tipos'], $nid);
        }else if(isset($_POST['submitBorrar'])){
            $this->m_periodico->borrarNoticia($nid);
        }
        
        
        redirect('c_noticias/publicarNoticias'); 
    }
    
    function borrarComentario($cid, $nid){
        $this->m_periodico->borrarComentario($cid);
        $this->noticia($nid);
    }
    
    function publicarComentario($cid, $nid){
        $this->m_periodico->publicarComentario($cid);
        $this->noticia($nid);
    }
}
