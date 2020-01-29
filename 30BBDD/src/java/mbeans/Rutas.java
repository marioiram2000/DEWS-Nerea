package mbeans;

import beans.Bus;
import beans.Ruta;
import dao.DaoBuses;
import java.util.ArrayList;

public class Rutas {

    private ArrayList<Bus> buses;
    private ArrayList<Ruta> rutas;
    private String busSelec;
      
    public Rutas() {
        buses=DaoBuses.buses();
    }
    
    public String cargarRutas(){
        
        rutas=DaoBuses.rutasDeBus(busSelec);
        return null;
    }
    
    public String subirTarifa(Ruta r){
        
        DaoBuses.subirTarifa(r, 20); 
        r.setTarifa(r.getTarifa() + r.getTarifa() * (float)20/100);
        
        //rutas=DaoBuses.rutasDeBus(busSelec);
        return null;
    }
    
    public String guardarRuta(Ruta r){
        DaoBuses.guardarRuta(r);
        return null;
    }
    
    

    public ArrayList<Bus> getBuses() {
        return buses;
    }

    public String getBusSelec() {
        return busSelec;
    }

    public void setBusSelec(String busSelec) {
        this.busSelec = busSelec;
    }

    public ArrayList<Ruta> getRutas() {
        return rutas;
    }
    
    
    
}
