<?php


function alta($usuario,$pass,$nomfich){
    
    $f=fopen($nomfich,"a");
    $linea=$usuario.";".$pass."\n";   
    fputs($f,$linea);
    fclose($f);
    
}

function listado($nomfich){
    
    if (!file_exists($nomfich))
        return false;
    
    $arr=array();
    
    $f=fopen($nomfich,"r");    
    while (!feof($f)){
        $linea=trim(fgets($f));
        $arrlinea=explode(";",$linea);
        if (count($arrlinea)==2){
            $usuario=$arrlinea[0];
            $pass=$arrlinea[1];    
            $arr[$usuario]=$pass;          
        }
    }
    fclose($f);
    return $arr;   
    
}

function login ($usuario1,$pass1,$nomfich){
    
     if (!file_exists($nomfich))
        return false;
       
    $f=fopen($nomfich,"r");    
    while (!feof($f)){
        $linea=trim(fgets($f));
        $arrlinea=explode(";",$linea);
        if (count($arrlinea)==2){
            $usuario=$arrlinea[0];
            $pass=$arrlinea[1];    
            if ($usuario==$usuario1){
                if ($pass==$pass1){
                    fclose($f);
                    return true;
                }
                else{
                    fclose($f);
                    return false;
                }
           }            
        }
    }    
    fclose($f);
    return false;
   
}


function logueos ($usuario1,$nomfich){
       
    $f=fopen($nomfich,"r");    
    while (!feof($f)){
       list($usuario,$pass,$cantlogueos)=fscanf($f,"%s\t%s\t%d");
      // echo "<br>Comparando:".$usuario . " y " .$usuario1;
       if ($usuario==$usuario1){
           fclose($f);
           return $cantlogueos;
       }
    }    
    fclose($f);
    return 0;
   
   
}


function   incrementa_logueos($usuario1,$nomfich){
    
    
    //$numlogueos= logueos($usuario1, $nomfich);
    //$numlogueos++;
    $encontrado=false;
     $f=fopen($nomfich,"r");  //Leer del original
     $faux=fopen("auxi.txt","w");
     while (!feof($f)){
         list($usuario,$pass,$cantlogueos)=fscanf($f,"%s\t%s\t%d");
         if ($usuario==$usuario1){
             $encontrado=true;
             $cantlogueos++;            
         }
         fputs($faux,"$usuario\t$pass\t$cantlogueos\n");
     }
     if (!$encontrado){
         $pass="123";
         $cantlogueos=1;
         fputs($faux,"$usuario1\t$pass\t$cantlogueos\n");
     }
     fclose($f);
     fclose($faux);
     unlink($nomfich);
     rename("auxi.txt",$nomfich);  
   
    
}


?>
