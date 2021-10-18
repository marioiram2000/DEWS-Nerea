/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

/**
 *
 * @author dw2
 */
public class Pregunta {

    private final static int MAX_INTENTOS=3;
    private String enunciado;
    private int rspCorrecta;
    private int rspUsuario;
    
    private String feedback;
    
    private int intentos;
  
    
    public Pregunta() {
        
        this.enunciado= "raiz de 25";
        this.rspCorrecta=(int)Math.sqrt(25);
        this.feedback="";
        this.intentos=0;
    }

    public String getEnunciado() {
        return enunciado;
    }

    public int getRspCorrecta() {
        return rspCorrecta;
    }

    public int getRspUsuario() {
        return rspUsuario;
    }

    public void setEnunciado(String enunciado) {
        this.enunciado = enunciado;
    }

    public void setRspCorrecta(int rspCorrecta) {
        this.rspCorrecta = rspCorrecta;
    }

    public void setRspUsuario(int rspUsuario) {
        this.rspUsuario = rspUsuario;
    }

    public String getFeedback() {
        return feedback;
    }

    public void setFeedback(String feedback) {
        this.feedback = feedback;
    }
    
    
    
    public String comprobarRsp() {
       /* 
        if (this.rspUsuario==this.rspCorrecta){
            return "rspcorrecta";
        }
        
        return null;
        */
       
        if (this.rspUsuario==this.rspCorrecta){
            this.feedback= "ERES UN GENIO";
            return "resultado";
            
        }else{            
            intentos++;
            if (intentos>= MAX_INTENTOS){
                this.feedback="toonto";
                return "resultado";
            }
        }
        
        return null;
    }

    public static int getMAX_INTENTOS() {
        return MAX_INTENTOS;
    }

    public int getIntentos() {
        return intentos;
    }

    public void setIntentos(int intentos) {
        this.intentos = intentos;
    }
    
    
    
}
