
package mbeans;

import beans.Bus;
import beans.Ruta;
import dao.DaoBuses;
import java.util.ArrayList;


public class MBRutas {

    private ArrayList<Bus> buses;
    private String busActual; 
    ArrayList<Ruta> rutas;
    
    public MBRutas() {
        buses = dao.DaoBuses.getBuses();
        busActual = buses.get(0).getId_placa();
        rutas = DaoBuses.getRutasBus(busActual);
        
    }

    public ArrayList<Bus> getBuses() {
        return buses;
    }

    public void setBuses(ArrayList<Bus> buses) {
        this.buses = buses;
    }

    public String getBusActual() {
        return busActual;
    }

    public void setBusActual(String busActual) {
        this.busActual = busActual;
    }

    public ArrayList<Ruta> getRutas() {
        return rutas;
    }

    public void setRutas(ArrayList<Ruta> rutas) {
        this.rutas = rutas;
    }
    
    public String cambiarTarifa(Ruta ruta){
        DaoBuses.setTarifa(ruta);
        return null;
    }

    public void cargarRutasBus(){
        rutas = dao.DaoBuses.getRutasBus(busActual);
    }
}
