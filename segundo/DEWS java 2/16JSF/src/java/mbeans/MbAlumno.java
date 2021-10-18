/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

import beans.Alumno;
import beans.Ciclo;
import java.util.ArrayList;

/**
 *
 * @author dw2
 */
public class MbAlumno {
    
    private Alumno alumno;
    private String pass;
    private String sexo;
    
    private String ciclo;
    
    private ArrayList<Ciclo> ciclos;

    public void setSexo(String sexo) {
        this.sexo = sexo;
    }

    public void setCiclo(String ciclo) {
        this.ciclo = ciclo;
    }

    public String getCiclo() {
        return ciclo;
    }

    public String getSexo() {
        return sexo;
    }
    
    public MbAlumno() {
        //sino lo instanciamos 
        //intentara hacer alumno.nombre cuando alumno es null
        alumno= new Alumno();
        
        //para que este seleccionado por defecto
        sexo="H";
        
        cargarciclos();
    }

    public ArrayList<Ciclo> getCiclos() {
        return ciclos;
    }

    public void setCiclos(ArrayList<Ciclo> ciclos) {
        this.ciclos = ciclos;
    }
    
    private void cargarciclos(){
        
        ciclos= new ArrayList<>();
        ciclos.add(new Ciclo("desarrollo web", "GB", 250));
        ciclos.add(new Ciclo("desarrollo multi", "gd", 30));
        ciclos.add(new Ciclo("marketing", "sc", 2));
    }

    public Alumno getAlumno() {
        return alumno;
    }

    public String getPass() {
        return pass;
    }

    public void setPass(String pass) {
        this.pass = pass;
    }
    
    public boolean passok(){
        
        String str="";
        for (int i=alumno.getNombre().length()-1;i>=0;i--){
            str+=alumno.getNombre().charAt(i);
        }
        
        return str.equals(pass);
    }
    
    public String login(){
        
        if (passok()){
            return "todasMaterias";
        }
        return null;
    }
    
    public String strsexo(){
        if(sexo.equals("M")){
            return "mujer";
        }else{
            return "hombre";
        }
    }
}
