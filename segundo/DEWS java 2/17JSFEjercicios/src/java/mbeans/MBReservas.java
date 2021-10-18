package mbeans;
import beans.Ruta;
import dao.DaoBuses;
import java.io.Serializable;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map.Entry;


public class MBReservas implements Serializable{

    private ArrayList<Ruta> rutas;
    private Ruta ruta;
    private HashMap<Integer, String> reservasBus;
    private String[] reservar;
    private String dniCliente;
    
    public MBReservas() {
        rutas = DaoBuses.getRutas();
    }

    public ArrayList<Ruta> getRutas() {
        return rutas;
    }
    public void setRutas(ArrayList<Ruta> rutas) {
        this.rutas = rutas;
    }
    public Ruta getRuta() {
        return ruta;
    }
    public void setRuta(Ruta ruta) {
        this.ruta = ruta;
    }
    public HashMap<Integer, String> getReservasBus() {
        return reservasBus;
    }
    public void setReservasBus(HashMap<Integer, String> reservasBus) {
        this.reservasBus = reservasBus;
    }
    public String[] getReservar() {
        return reservar;
    }
    public void setReservar(String[] reservar) {
        this.reservar = reservar;
    }
    public String getDniCliente() {
        return dniCliente;
    }
    public void setDniCliente(String dniCliente) {        
        this.dniCliente = dniCliente;
        
    }
    
    
    public String reservar(){
        reservasBus = DaoBuses.getReservasRuta(ruta.getId_ruta());
        reservar = null;
        dniCliente = null;
        
        return "reserva";
    }
    
    public ArrayList<Entry> getAsientosOcupados(){
        return new ArrayList<Entry>(reservasBus.entrySet());
    }
    
    public ArrayList<Integer> getAsientosLibres(){
        ArrayList<Integer> asientos = new ArrayList<>();
        int capacidad = DaoBuses.getCapacidadBus(ruta.getId_placa());
        for (int i = 1; i <= capacidad; i++) {
            if(!reservasBus.containsKey(i)){
                asientos.add(i);
            }
        }
        return asientos;
    }
    
    public String hacerReservas(){
        System.out.println("Llega a hacer reservas");
        for (int i = 0; i < reservar.length; i++) {
            Integer asiento = Integer.parseInt(reservar[i]);
            DaoBuses.insertReservas(asiento, dniCliente, ruta.getId_ruta());
        }
        return this.reservar();
    }
}
