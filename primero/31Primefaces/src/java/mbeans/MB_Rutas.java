/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

/**
 *
 * @author dw2_alum4
 */
public class MB_Rutas {

    
    private int precioMin;
    private int precioMax;
    
    public MB_Rutas() {
        precioMin=10;
        precioMax=100;
    }
    
    public String cargarRutas(){
        return null;
    }

    public int getPrecioMin() {
        return precioMin;
    }

    public void setPrecioMin(int precioMin) {
        this.precioMin = precioMin;
    }

    public int getPrecioMax() {
        return precioMax;
    }

    public void setPrecioMax(int precioMax) {
        this.precioMax = precioMax;
    }
    
    
    
}
