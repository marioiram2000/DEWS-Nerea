/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.Map.Entry;

/**
 *
 * @author dw2
 */
public class Mbmaterias {
    
    
    private LinkedHashMap<String,String[]> materias;

    
    public Mbmaterias() {
        
        materias= new LinkedHashMap<String, String[]>();
        materias.put("desarrollo web", new String[]{"lema","interfaces","servidor"});
        materias.put("desarrollo multi", new String[]{"BBDD","android","odoo"});
        materias.put("marketing", new String[]{"mundo","internet","mas cosas"});
    }

    public LinkedHashMap<String, String[]> getMaterias() {
        return materias;
    }
    
    public ArrayList<Entry> materiasAslist(){
        return new ArrayList<Entry>(materias.entrySet());
    }
    
}
