package mbeans;

import beans.Bus;
import java.util.ArrayList;

/**
 *
 * @author dw2_alum4
 */
public class MB_Buses {

    ArrayList<Bus> buses;
    public MB_Buses() {
        buses = dao.DaoBuses.buses();
    }

    public ArrayList<Bus> getBuses() {
        return buses;
    }

    public void setBuses(ArrayList<Bus> buses) {
        this.buses = buses;
    }
    
    
    
}
