package mbeans;

import beans.Reserva;
import beans.Ruta;
import dao.DaoBuses;
import java.util.ArrayList;

public class Mb_Reserva {

    private Ruta ruta;
    private ArrayList<Reserva> reservas;
    
    public Mb_Reserva() {
        reservas = DaoBuses.reservas(ruta.getId_ruta());
    }

    public Ruta getRuta() {
        return ruta;
    }

    public String setRuta(Ruta ruta) {
        this.ruta = ruta;
        System.out.println("-------------------------------"+ruta);
        return "reserva.xhtml";
    }

    public ArrayList<Reserva> getReservas() {
        return reservas;
    }

    public void setReservas(ArrayList<Reserva> reservas) {
        this.reservas = reservas;
    }
    
    
    
}
