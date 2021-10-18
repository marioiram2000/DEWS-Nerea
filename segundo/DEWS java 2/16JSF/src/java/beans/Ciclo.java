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
public class Ciclo {
    
    private String nombre;
    private String nivel;
    private int horas;

    public Ciclo(String nombre, String nivel, int horas) {
        this.nombre = nombre;
        this.nivel = nivel;
        this.horas = horas;
    }

    public Ciclo() {
    }

    public String getNombre() {
        return nombre;
    }

    public String getNivel() {
        return nivel;
    }

    public int getHoras() {
        return horas;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setNivel(String nivel) {
        this.nivel = nivel;
    }

    public void setHoras(int horas) {
        this.horas = horas;
    }
    
    
    
}
