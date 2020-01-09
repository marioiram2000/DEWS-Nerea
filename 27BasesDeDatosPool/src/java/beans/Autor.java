package beans;

import java.text.SimpleDateFormat;
import java.util.Date;

public class Autor {
    private int idautor;
    private String nombre;
    private java.util.Date fechanac;
    private String nacionalidad;

    public Autor() {
    }

    public Autor(int idautor, String nombre, Date fechanac, String nacionalidad) {
        this.idautor = idautor;
        this.nombre = nombre;
        this.fechanac = fechanac;
        this.nacionalidad = nacionalidad;
    }

    public int getIdautor() {
        return idautor;
    }

    public void setIdautor(int idautor) {
        this.idautor = idautor;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public Date getFechanac() {
        return fechanac;
    }

    public void setFechanac(Date fechanac) {
        this.fechanac = fechanac;
    }

    public String getNacionalidad() {
        return nacionalidad;
    }

    public void setNacionalidad(String nacionalidad) {
        this.nacionalidad = nacionalidad;
    }
    
    public String fechaFormato(){
        SimpleDateFormat f = new SimpleDateFormat("MM/yyyy");
        
        //f.parse pasa de texto a Date y f.format al reves
        return f.format(fechanac);
    }

    @Override
    public int hashCode() {
        int hash = 7;
        return hash;
    }

    @Override //CONSIDERA DOS AUTORES IGUALES CON EL MISMO ID
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
        final Autor other = (Autor) obj;
        if (this.idautor != other.idautor) {
            return false;
        }
        return true;
    }
    
    
}
