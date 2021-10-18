/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;


public class Alumno {
    
    private String nombre;
    private String ciclo;

    public Alumno() {
    }

    public Alumno(String nombre, String ciclo) {
        this.nombre = nombre;
        this.ciclo = ciclo;
    }

    public String getNombre() {
        return nombre;
    }

    public String getCiclo() {
        return ciclo;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setCiclo(String ciclo) {
        this.ciclo = ciclo;
    }
    
    
    
}
