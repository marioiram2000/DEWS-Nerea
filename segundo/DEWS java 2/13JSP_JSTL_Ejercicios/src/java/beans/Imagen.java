package beans;

import java.util.Objects;

public class Imagen {
    
    private String ruta;
    private String nombre;
    private long tamanio;

    public Imagen() {
    }

    public Imagen(String ruta, String nombre, long tamanio) {
        this.ruta = ruta;
        this.nombre = nombre;
        this.tamanio = tamanio;
    }

    public String tamanioDesglosado(){
        int Mb = (int) (tamanio/(1024*1024));
        float rbytes = tamanio%(1024*1024);
        int Kb = (int)rbytes/1024;
        int bytes = (int)rbytes%1024;
        
        String desglosado = Mb+" Mb "+Kb+" Kb "+bytes+" bytes";
        return desglosado;
    }
    
    public String getRuta() {
        return ruta;
    }

    public void setRuta(String ruta) {
        this.ruta = ruta;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public long getTamanio() {
        return tamanio;
    }

    public void setTamanio(byte tamanio) {
        this.tamanio = tamanio;
    }

    @Override
    public String toString() {
        return "Imagen{" + "ruta='" + ruta + "', nombre='" + nombre + "', tamanio='" + tamanio + "'}";
    }

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 31 * hash + Objects.hashCode(this.ruta);
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (this == obj) {
            return true;
        }
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Imagen other = (Imagen) obj;
        if (!Objects.equals(this.ruta, other.ruta)) {
            return false;
        }
        return true;
    }
    
    
}
