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
public class Movil {
    
    
    private String numero;
    private int bateria;

    public Movil() {
    }

    public Movil(String numero) {
        this.numero = numero;
    }
    public void llamar(){
        bateria--;
    }
    
    
    
    

    public String getNumero() {
        return numero;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public int getBateria() {
        return bateria;
    }

    public void setBateria(int bateria) {
        this.bateria = bateria;
    }
    
    
    
    
}
