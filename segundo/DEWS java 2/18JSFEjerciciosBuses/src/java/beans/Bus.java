package beans;
public class Bus {

    private String id_placa;
    private int capacidad;

    public Bus() {
    }

    public Bus(String id_placa, int capacidad) {
        this.id_placa = id_placa;
        this.capacidad = capacidad;
    }

    public String getId_placa() {
        return id_placa;
    }

    public void setId_placa(String id_placa) {
        this.id_placa = id_placa;
    }

    public int getCapacidad() {
        return capacidad;
    }

    public void setCapacidad(int capacidad) {
        this.capacidad = capacidad;
    }

    @Override
    public String toString() {
        return "Bus{" + "id_placa=" + id_placa + ", capacidad=" + capacidad + '}';
    }
    
    
}
