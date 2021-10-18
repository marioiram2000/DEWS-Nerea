/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;

import java.util.Date;

/**
 *
 * @author dw2
 */
public class Ruta {
    private int id_ruta;
    private String ciudadOrigen, ciudadDestino;
    private java.util.Date horaSalida, horaLlegada;
    private float tarifa;
    private Bus bus;
    private int capacidadDisp;
    
  

    public Ruta() {
    }

    public Ruta(int id_ruta, String ciudadOrigen, String ciudadDestino, Date horaSalida, Date horaLlegada, float tarifa, Bus bus, int capacidadDisp) {
        this.id_ruta = id_ruta;
        this.ciudadOrigen = ciudadOrigen;
        this.ciudadDestino = ciudadDestino;
        this.horaSalida = horaSalida;
        this.horaLlegada = horaLlegada;
        this.tarifa = tarifa;
        this.bus = bus;
        this.capacidadDisp = capacidadDisp;
       
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

    public Bus getBus() {
        return bus;
    }

    public void setBus(Bus bus) {
        this.bus = bus;
    }

    public int getCapacidadDisp() {
        return capacidadDisp;
    }

    public void setCapacidadDisp(int capacidadDisp) {
        this.capacidadDisp = capacidadDisp;
    }

    @Override
    public String toString() {
        return ciudadDestino + " " + ciudadOrigen + " " + bus;//To change body of generated methods, choose Tools | Templates.
    }

    

  
    
    
}
