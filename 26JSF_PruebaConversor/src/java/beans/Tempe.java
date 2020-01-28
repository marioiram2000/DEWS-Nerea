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
public class Tempe {
    
    
    private float cels;
    private float fahr;

    public Tempe() {
        this.calculaFahr();
    }

    public Tempe(float cels, float fahr) {
        this.cels = cels;
        this.fahr = fahr;
    }

    public float getCels() {
        return cels;
    }

    public void setCels(float cels) {
        this.cels = cels;
    }

    public float getFahr() {
        return fahr;
    }

    public void setFahr(float fahr) {
        this.fahr = fahr;
    }
    
    public void calculaFahr(){
        
        this.fahr=32+(9/5)*this.cels;
    }
    
}
