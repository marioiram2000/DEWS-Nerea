package Beans;

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
        long by = this.tamanio/1024;
        int kb = (int)by;
        int mb = (int)kb/1024;
        
        by = by - (kb*1024);
        kb = kb - (mb*1024);
        
        String str = mb+" Mb "+kb+" Kb "+by+" bytes";
        return str;
    }
    
}
