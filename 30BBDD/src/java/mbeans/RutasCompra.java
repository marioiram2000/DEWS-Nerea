package mbeans;

import beans.Bus;
import beans.Ruta;
import dao.DaoBuses;
import java.util.ArrayList;

public class RutasCompra{
    
    private ArrayList<Bus> buses;
    private ArrayList<Ruta> rutas;

    public RutasCompra() {
        rutas = DaoBuses.rutas();
    }

    public ArrayList<Ruta> getRutas() {
        System.out.println("--------"+rutas);
        return rutas;
    }
    
    
}
