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
public class Empresa {
    
    private String nombre;
    private float beneficio;
    private int max_trabajadores;
    private int trabs;
    private Trabajador[] trabajadores;

    public Empresa(String nombre, float beneficio, int max_trabajadores) {
        this.nombre = nombre;
        this.beneficio = beneficio;
        this.max_trabajadores = max_trabajadores;        
        trabajadores=new Trabajador[max_trabajadores];
        trabs=0;
    }
    
    
    public boolean contratar (Trabajador t){
        
        if (trabs<max_trabajadores){
            trabajadores[trabs]=t;
            trabs++;
            return true;
        }
        return false;
        
    }
    
    
    public void trabajar(){
        //Trabajan todos sus trabajadores y se incrementa el beneficio
        for (int i=0; i<trabs; i++){
            trabajadores[i].trabajar();
        }
        beneficio+=100;
    }
    
    
    
    
}
