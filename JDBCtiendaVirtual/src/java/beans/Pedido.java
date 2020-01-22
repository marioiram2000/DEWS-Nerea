package beans;

import java.sql.Date;
import java.util.HashSet;

public class Pedido {
    private int id;
    private double total;
    private Date fecha;
    private int idcliente;

    HashSet<LineaPedido> lineas;
    
    public Pedido() {
    }

    public Pedido(int id, double total, Date fecha, int idcliente, HashSet<LineaPedido> lineas) {
        this.id = id;
        this.total = total;
        this.fecha = fecha;
        this.idcliente = idcliente;
        this.lineas = lineas;
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
