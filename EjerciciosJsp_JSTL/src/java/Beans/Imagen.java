package Beans;

import java.text.DecimalFormat;

public class Imagen {

    private String ruta;
    private String nombre;
    private long tamanio;

    public Imagen(String ruta, String nombre, long tamanio) {
        this.ruta = ruta;
        this.nombre = nombre;
        this.tamanio = tamanio;
    }
    
    public String tamanioDesglosado(){
        long longitud = this.tamanio;
        DecimalFormat df = new DecimalFormat("#.00");
        
        if(longitud>1024000000){
            long gb = longitud/1024000000;
            long mb = (longitud%1024000000)/10240000;
            long kb = ((longitud%1024000000)%10240000)/102400;
            long by = (((longitud%1024000000)%10240000)%102400)/1024;
            System.out.println(this+"  : " + gb + " Gb"+ mb + " Mb"+ kb + " Kb"+ by + " bytes");
        }else if(longitud>1024000){
            long mb = longitud/10240000;
            long kb = (longitud%10240000)/102400;
            long by = ((longitud%10240000)%102400)/1024;
            System.out.println(this+"  : "+ mb + " Mb"+ kb + " Kb"+ by + " bytes");
        }else if(longitud>1024){
                    System.out.println(this+"  : " + longitud/1024 + " Kb");
        }else{
                    System.out.println(this+"  : " + longitud + " bytes");       
        }
        return "";
    }

    public String getRuta() {
        return ruta;
    }

    public String getNombre() {
        return nombre;
    }

    public long getTamanio() {
        return tamanio;
    }    

    @Override
    public String toString() {
        return "Imagen{" + "ruta=" + ruta + ", nombre=" + nombre + ", tamanio=" + tamanio + '}';
    }
    
    
}
