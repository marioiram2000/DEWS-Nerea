/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

import beans.Amigo;
import java.util.ArrayList;

/**
 *
 * @author pei4
 */
public class Persona {
    
    private String nombre;
    private int edad;
    private ArrayList<Amigo> amigos;
    private String amigo;
    
   
    public Persona() {
        nombre="desconocido";
        edad=25;  
        amigos=new ArrayList<Amigo>();
        
    }

   
    
    
    
    public String examinar(){
        
        if (edad >150)
            edad=0;
        if (nombre.equals("admin"))
            return "admin.xhtml";
        
        return null;
    }
    
    
    public String cumplirAnio(){
        if (edad<150)
            edad++;
        return null;
    }
    
     public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public int getEdad() {
        return edad;
    }

    public void setEdad(int edad) {
        this.edad = edad;
    }

    public String getAmigo() {
        return amigo;
    }

    public void setAmigo(String amigo) {
        this.amigo = amigo;
    }
    
    public void aniadeAmigo(){
        this.amigos.add(new Amigo(amigo,(int)(Math.random()*5)));        
    }

    public ArrayList<Amigo> getAmigos() {
        return amigos;
    }
    
    
    
    
}
