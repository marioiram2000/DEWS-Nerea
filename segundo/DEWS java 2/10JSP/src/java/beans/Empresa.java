package beans;

import java.util.Objects;


public class Empresa {

    private String nombre;
    private float beneficio;
    private Trabajador[] trabajadores;
    private int trabAct;

    public Empresa(String nombre, float beneficio, int maxTrab) {
        this.nombre = nombre;
        this.beneficio = beneficio;
        this.trabajadores = new Trabajador[maxTrab];
    }

    public boolean contratar(Trabajador t){
        if(trabAct < trabajadores.length){
            trabajadores[trabAct] = t;
            trabAct ++;
            return true;
        }
        return false;
    }
    
    public void trabajar(){
        for (int i = 0; i < trabAct; i++) {
            Trabajador t = trabajadores[i];
            t.trabajar();
        }
        beneficio += 100;
        
    }

    @Override
    public String toString() {
        return "Empresa{" + "nombre=" + nombre + ", beneficio=" + beneficio + ", trabAct=" + trabAct + '}';
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public float getBeneficio() {
        return beneficio;
    }

    public void setBeneficio(float beneficio) {
        this.beneficio = beneficio;
    }

    public Trabajador[] getTrabajadores() {
        return trabajadores;
    }

    public void setTrabajadores(Trabajador[] trabajadores) {
        this.trabajadores = trabajadores;
    }

    public int getTrabAct() {
        return trabAct;
    }

    public void setTrabAct(int trabAct) {
        this.trabAct = trabAct;
    }

    @Override
    public int hashCode() {
        int hash = 3;
        hash = 19 * hash + Objects.hashCode(this.nombre);
        hash = 19 * hash + Float.floatToIntBits(this.beneficio);
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
        final Empresa other = (Empresa) obj;
        if (Float.floatToIntBits(this.beneficio) != Float.floatToIntBits(other.beneficio)) {
            return false;
        }
        if (!Objects.equals(this.nombre, other.nombre)) {
            return false;
        }
        return true;
    }
    
}
