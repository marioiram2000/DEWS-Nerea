package beans;

import java.util.Date;

public class Ruta {
    private int id_ruta;
    private String ciudadOrigen;
    private String ciudadDestino;
    private java.util.Date horaSalida;
    private java.util.Date horaLlegada;
    private float tarifa;
    private String id_placa;

    
    
    public Ruta(int id_ruta, String ciudadOrigen, String ciudadDestino, Date horaSalida, Date horaDestino, float tarifa, String id_placa) {
        this.id_ruta = id_ruta;
        this.ciudadOrigen = ciudadOrigen;
        this.ciudadDestino = ciudadDestino;
        this.horaSalida = horaSalida;
        this.horaLlegada = horaDestino;
        this.tarifa = tarifa;
        this.id_placa = id_placa;
        
    }

    public Ruta() {
    }

    public int getId_ruta() {
        return id_ruta;
    }

    public void setId_ruta(int id_ruta) {
        this.id_ruta = id_ruta;
    }

    public String getCiudadOrigen() {
        return ciudadOrigen;
    }

    public void setCiudadOrigen(String ciudadOrigen) {
        this.ciudadOrigen = ciudadOrigen;
    }

    public String getCiudadDestino() {
        return ciudadDestino;
    }

    public void setCiudadDestino(String ciudadDestino) {
        this.ciudadDestino = ciudadDestino;
    }

    public Date getHoraSalida() {
        return horaSalida;
    }

    public void setHoraSalida(Date horaSalida) {
        this.horaSalida = horaSalida;
    }

    public Date getHoraLlegada() {
        return horaLlegada;
    }

    public void setHoraLlegada(Date horaLlegada) {
        this.horaLlegada = horaLlegada;
    }

    public float getTarifa() {
        return tarifa;
    }

    public void setTarifa(float tarifa) {
        this.tarifa = tarifa;
    }

    public String getId_placa() {
        return id_placa;
    }

    public void setId_placa(String id_placa) {
        this.id_placa = id_placa;
    }
    

    @Override
    public String toString() {
        return "Ruta{" + "id_ruta=" + id_ruta + ", ciudadOrigen=" + ciudadOrigen + ", ciudadDestino=" + ciudadDestino + ", horaSalida=" + horaSalida + ", horaLlegada=" + horaLlegada + ", tarifa=" + tarifa + ", id_placa=" + id_placa + '}';
    }

    
    

}
