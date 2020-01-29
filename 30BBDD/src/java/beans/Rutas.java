/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;

import java.util.ArrayList;

/**
 *
 * @author dw2_alum4
 */
public class Rutas {
    private ArrayList<Bus> buses;

    public Rutas(ArrayList<Bus> buses) {
        this.buses = buses;
    }

    
    
    
    public ArrayList<Bus> getBuses() {
        return buses;
    }

    public void setBuses(ArrayList<Bus> buses) {
        this.buses = buses;
    }
    
    
}
