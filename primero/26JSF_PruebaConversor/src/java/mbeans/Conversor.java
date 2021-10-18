/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

import beans.Tempe;
import java.util.ArrayList;

/**
 *
 * @author pei4
 */
public class Conversor {

     private Tempe tempe;
     private ArrayList<Tempe> arrTempes;
    
    
    public Conversor() {
        tempe=new Tempe();
        arrTempes= new ArrayList<Tempe>();
    }

    public Tempe getTempe() {
        return tempe;
    }

    public void setTempe(Tempe tempe) {
        this.tempe = tempe;
    }

    public ArrayList<Tempe> getArrTempes() {
        return arrTempes;
    }

    public void setArrTempes(ArrayList<Tempe> arrTempes) {
        this.arrTempes = arrTempes;
    }
    
    public String convertir(){
        
        this.tempe.calculaFahr();
       
        Tempe tempeClon=new Tempe();
        tempeClon.setCels(tempe.getCels());
        tempeClon.calculaFahr();
        
        this.arrTempes.add(tempeClon);        
        return null;
        
    }
    
}
