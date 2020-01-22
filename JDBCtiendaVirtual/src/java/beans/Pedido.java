package beans;

import java.sql.Date;

public class Pedido {
    private int id;
    private double total;
    private Date fecha;
    private int idcliente;

    public Pedido() {
    }

    public int getId() {
        return id;
    }

    public double getTotal() {
        return total;
    }

    public Date getFecha() {
        return fecha;
    }

    public int getIdcliente() {
        return idcliente;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setTotal(double total) {
        this.total = total;
    }

    public void setFecha(Date fecha) {
        this.fecha = fecha;
    }

    public void setIdcliente(int idcliente) {
        this.idcliente = idcliente;
    }

    @Override
    public String toString() {
        return "Pedido{" + "id=" + id + ", total=" + total + ", fecha=" + fecha + ", idcliente=" + idcliente + '}';
    }
    
    
}
