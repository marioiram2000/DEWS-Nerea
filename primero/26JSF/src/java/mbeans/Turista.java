/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

import java.util.ArrayList;

/**
 *
 * @author pei4
 */
public class Turista {

    private String nombre;
    private String sexo;
    private String[] paises;
    
    
    private ArrayList<String> listaPaises;   //paises visitables
    
    public Turista() {
        
        listaPaises=new ArrayList<String>();
        listaPaises.add("Iran");
        listaPaises.add("Chile");
        listaPaises.add("Peru");
        listaPaises.add("Rusia");
        listaPaises.add("China");
        
    }
    
    
    
    public String grabar(){
        nombre=nombre.toUpperCase();
        if (paises!=null && paises.length>2 && sexo.equals("MUJER")){
            return "mujeres.xhtml";            
        }
        else{
            return "nomujeres.xhtml";   
        }
        
                
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getSexo() {
        return sexo;
    }

    public void setSexo(String sexo) {
        this.sexo = sexo;
    }

    public String[] getPaises() {
        return paises;
    }

    public void setPaises(String[] paises) {
        this.paises = paises;
    }

    public ArrayList<String> getListaPaises() {
        return listaPaises;
    }
    
    
    
    
    
    
    
}
