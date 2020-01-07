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
        String str;

        if(longitud>Math.pow(1024, 2)){
            long mb = longitud/(long)Math.pow(1024, 2);
            long resto = longitud%(long)Math.pow(1024, 2);
            long kb = resto/1024;
            resto = resto%1024;
            long by = resto;
            str = mb + " Mb "+ kb + " Kb "+ by + " bytes";
            System.out.println(this.nombre+"  : " + mb + " Mb "+ kb + " Kb "+ by + " bytes");
        }else if(longitud>1024){
            long kb = longitud/1024;
            long by = longitud%1024;
            str = kb + " Kb "+ by + " bytes";
            System.out.println(this.nombre+"  : " + kb + " Kb "+ by + " bytes");
        }else{
            str = longitud + " bytes";
            System.out.println(this.nombre+"  : " + longitud + " bytes");       
        }
        return str;
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
