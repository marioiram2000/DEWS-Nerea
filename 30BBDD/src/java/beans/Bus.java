/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package beans;

/**
 *
 * @author pei4
 */
public class Bus {
    
    private String id_placa;
    private int capacidad;
    private String imagen;

    public Bus() {
    }

    public Bus(String id_placa, int capacidad, String imagen) {
        this.id_placa = id_placa;
        this.capacidad = capacidad;
        this.imagen = imagen;
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

    public String getImagen() {
        return imagen;
    }

    public void setImagen(String imagen) {
        this.imagen = imagen;
    }
    
    
    
}
