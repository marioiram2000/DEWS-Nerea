package beans;

import java.util.Date;
import java.util.HashSet;

public class Pedido {

    private int id;
    private double total;
    private Date fecha;
    private Cliente cliente;
    private HashSet<LineaPedido> lineas;
    private String estado;
    
    public Pedido() {
    }

    public double getTotal() {
        return total;
    }

    public void setTotal(double total) {
        this.total = total;
    }

    public Cliente getCliente() {
        return cliente;
    }

    public void setCliente(Cliente cliente) {
        this.cliente = cliente;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFecha() {
        return fecha;
    }

    public void setFecha(Date fecha) {
        this.fecha = fecha;
    }

    public HashSet<LineaPedido> getLineas() {
        return lineas;
    }

    public void setLineas(HashSet<LineaPedido> lineas) {
        this.lineas = lineas;
    }

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }

    @Override
    public String toString() {
        return "Pedido{" + "id=" + id + ", total=" + total + ", fecha=" + fecha + ", lineas=" + lineas + ", estado=" + estado + '}';
    }

    
    
    
    
    
}
