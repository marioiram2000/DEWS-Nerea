package beans;

public class Ruta {

    private String origen;
    private String Destino;
    private String bus;
    private Double tarifa;
    
    public Ruta() {
    }

    public Ruta(String origen, String Destino, String bus, Double tarifa) {
        this.origen = origen;
        this.Destino = Destino;
        this.bus = bus;
        this.tarifa = tarifa;
    }

    public String getOrigen() {
        return origen;
    }

    public void setOrigen(String origen) {
        this.origen = origen;
    }

    public String getDestino() {
        return Destino;
    }

    public void setDestino(String Destino) {
        this.Destino = Destino;
    }

    public String getBus() {
        return bus;
    }

    public void setBus(String bus) {
        this.bus = bus;
    }

    public Double getTarifa() {
        return tarifa;
    }

    public void setTarifa(Double tarifa) {
        this.tarifa = tarifa;
    }
    
}
