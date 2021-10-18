package beans;

import java.sql.Date;

public class Incidencia {

    private int id;
    private String descripcion;
    private int idPedido;
    private java.sql.Date fecha;

    public Incidencia() {
    }

    public Incidencia(int id, String descripcion, int idPedido, Date fecha) {
        this.id = id;
        this.descripcion = descripcion;
        this.idPedido = idPedido;
        this.fecha = fecha;
    }

    public int getId() {
        return id;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public int getIdPedido() {
        return idPedido;
    }

    public Date getFecha() {
        return fecha;
    }
    
    
}
