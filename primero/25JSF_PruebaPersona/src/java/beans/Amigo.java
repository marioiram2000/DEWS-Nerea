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
public class Amigo {
    
    private String nombre;
    private int amistad;

    public Amigo() {
    }

    public Amigo(String nombre, int amistad) {
        this.nombre = nombre;
        this.amistad = amistad;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public int getAmistad() {
        return amistad;
    }

    public void setAmistad(int amistad) {
        this.amistad = amistad;
    }

    @Override
    public String toString() {
        return nombre + ", amistad=" + amistad ;
    }
    
   
    
}
