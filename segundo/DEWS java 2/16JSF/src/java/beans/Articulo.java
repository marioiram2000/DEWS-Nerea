/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;

/**
 *
 * @author dw2
 */
public class Articulo {

    private String nombre;
    private float precio;

    public Articulo(String nombre, float precio) {
        this.nombre = nombre;
        this.precio = precio;
    }
    
    

    public Articulo() {
    }

    public String getNombre() {
        return nombre;
    }

    public float getPrecio() {
        return precio;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setPrecio(float precio) {
        this.precio = precio;
    }
    
    
    
}
