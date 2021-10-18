/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;

/**
 *
 * @author pei4
 */
public class Trabajador {
    private String nombre;
    private float dinero;
    private Movil movil;

    public Trabajador() {
    }

    public Trabajador(String nombre, float dinero, Movil movil) {
        this.nombre = nombre;
        this.dinero = dinero;
        this.movil = movil;
    }

    public void trabajar(){
        movil.llamar();
        dinero+=10;
    }
    
    
    
    
    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public float getDinero() {
        return dinero;
    }

    public void setDinero(float dinero) {
        this.dinero = dinero;
    }

    public Movil getMovil() {
        return movil;
    }

    public void setMovil(Movil movil) {
        this.movil = movil;
    }
    
    
    
    
}
