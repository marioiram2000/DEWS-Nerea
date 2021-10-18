/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

import beans.Ruta;
import java.util.ArrayList;

/**
 *
 * @author dw2
 */
public class MBrutas {
    
    private ArrayList<Ruta> rutas;
    private int limInf, limSup;


    
    public MBrutas() {
        //rutas=dao.DaoBuses.todasRutas();
        limInf=10;
        limSup=80;
        
    }

    
    
    public String cargarRutas(){
        rutas=dao.DaoBuses.todasRutas(limInf, limSup);
        
        return null;
    }
    public ArrayList<Ruta> getRutas() {
        return rutas;
    }

    public int getLimInf() {
        return limInf;
    }

    public void setLimInf(int limInf) {
        this.limInf = limInf;
    }

    public int getLimSup() {
        return limSup;
    }

    public void setLimSup(int limSup) {
        this.limSup = limSup;
    }

  
    
    
    
    
}
