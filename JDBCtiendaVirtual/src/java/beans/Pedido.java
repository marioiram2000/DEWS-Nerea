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
    
    
}
