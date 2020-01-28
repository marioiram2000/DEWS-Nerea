/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

import java.util.Date;
import javax.faces.application.FacesMessage;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;

/**
 *
 * @author pei4
 */
public class Persona {

    private String nombre;
    private int edad;
    private java.util.Date fechaNac;
    
    
    public Persona() {
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

    public Date getFechaNac() {
        return fechaNac;
    }

    public void setFechaNac(Date fechaNac) {
        this.fechaNac = fechaNac;
    }
    
    public void validarNombre(FacesContext contexto,
                              UIComponent txtNombre,
                              Object valor){
        
        //Nombre tiene que tener 2 palabras al menos        
        String nombre=(String)valor;
        
        String[] partes=nombre.split(" ");
        if (partes.length <2){
            //Comunicar a la vista error en el nombre            
            contexto.addMessage(
                    txtNombre.getClientId(contexto),                    
                    new FacesMessage("Nombre erroneo. Debe tener 2 palabras"));            
            
        }
        
    }
    
    
    
}
