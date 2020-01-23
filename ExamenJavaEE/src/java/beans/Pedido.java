package beans;

import java.sql.Date;

public class Pedido {

    private int id;
    private double total;
    private Date fecha;

    public Pedido() {
    }

    public Pedido(int id, double total, Date fecha) {
        this.id = id;
        this.total = total;
        this.fecha = fecha;
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
    
        
}
