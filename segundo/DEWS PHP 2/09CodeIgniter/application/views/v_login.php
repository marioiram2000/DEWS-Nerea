<?php
echo "<p>".$this->session->flashdata('error')."</p>";

echo form_open("c_devoluciones/login");
    echo "<p>"."DNI: ".form_input("dni", "")."</p>";
    echo "<p>"."Contraseña ".form_password("pass")."</p>";
    echo form_submit("submitlogin", "ENTRAR");
echo form_close();
