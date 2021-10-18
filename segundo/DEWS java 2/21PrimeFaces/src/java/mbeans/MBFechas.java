package mbeans;

import beans.Ruta;
import dao.DaoBuses;
import java.io.Serializable;
import java.util.ArrayList;
import java.util.Date;
import org.primefaces.model.DualListModel;

public class MBFechas implements Serializable{

    private Date desde;
    private Date hasta;
    private boolean errorFecha;
    private ArrayList<Ruta> rutas ;
    
    ArrayList<String> reservados;
    private DualListModel<String> pasajeros;
    private Ruta rutaSeleccionada;
    
    public MBFechas() {
        desde = new Date();
        errorFecha = false;
        rutas = new ArrayList<>();
    }

    public Date getDesde() {
        return desde;
    }
    public void setDesde(Date desde) {
        this.desde = desde;
    }
    public Date getHasta() {
        return hasta;
    }
    public void setHasta(Date hasta) {
        this.hasta = hasta;
    }
    public boolean isErrorFecha() {
        return errorFecha;
    }
    public void setErrorFecha(boolean errorFecha) {
        this.errorFecha = errorFecha;
    }
    public ArrayList<Ruta> getRutas() {
        return rutas;
    }
    public void setRutas(ArrayList<Ruta> rutas) {
        this.rutas = rutas;
    }
    public boolean rutasVacio(){
        return rutas.isEmpty();
    }
    public ArrayList<String> getReservados() {
        return reservados;
    }
    public void setReservados(ArrayList<String> reservados) {
        this.reservados = reservados;
    }
    public DualListModel<String> getPasajeros() {
        return pasajeros;
    }
    public void setPasajeros(DualListModel<String> pasajeros) {
        this.pasajeros = pasajeros;
    }
    public Ruta getRutaSeleccionada() {
        return rutaSeleccionada;
    }
    public void setRutaSeleccionada(Ruta rutaSeleccionada) {
        this.rutaSeleccionada = rutaSeleccionada;
    }
    
    
    public String verRutas(){
        System.out.print("Llega a ver rutas, desde="+desde+" hasta="+hasta);
        if(desde.getTime() > hasta.getTime() || desde.equals(hasta)){
            System.out.print("Entra al if");
            errorFecha = true;
        }else{
            errorFecha = false;
            System.out.print("Entra al else");
            rutas = DaoBuses.getRutas(desde, hasta);
            for (Ruta ruta : rutas) {
                System.out.println(ruta.toString());
            }
        }
        System.out.println("TAMAÑO DE RUTAS: "+rutas.size());
        return null;
    }
    
    public String updateCambios(){
        dao.DaoBuses.actualizarRutas(rutas);
        return null;
    }
    
    public String verPasajeros(Ruta ruta){
        ArrayList<String> avisos= new ArrayList<>();
        reservados=dao.DaoBuses.clientesDeRuta(ruta.getId_ruta());
        
        rutaSeleccionada=ruta;
        
        pasajeros = new DualListModel<>(reservados, avisos);
        return null;
    }
    
    public String avisar(){
        
        dao.DaoBuses.avisar((ArrayList<String>)pasajeros.getTarget(), rutaSeleccionada.getId_ruta());
        
        return null;
    }
}
