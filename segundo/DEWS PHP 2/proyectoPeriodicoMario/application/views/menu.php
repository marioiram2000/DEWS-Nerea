<div id="menu">
<?php
$enlace = site_url()."/c_index/index";
echo "<a href='$enlace'> Inicio </a>";
if($this->session->userdata('uid')!=null){
    $enlace = site_url()."/c_login/logout";
    echo "<a href='$enlace'> Logout </a>"; 
}else{
    $enlace = site_url()."/c_login/login";
    echo "<a href='$enlace'> Login </a>";
}
?>
</div>