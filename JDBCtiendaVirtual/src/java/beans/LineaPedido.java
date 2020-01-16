
package beans;

public class LineaPedido {
    
    private int id;
    private int cantidad;
    private Pedido idpedido;
    private Item iditem;

    public LineaPedido() {
    }

    public int getId() {
        return id;
    }

    public int getCantidad() {
        return cantidad;
    }

    public void setCantidad(int cantidad) {
        this.cantidad = cantidad;
    }

    public Pedido getPedido() {
        return idpedido;
    }

    public Item getIditem() {
        return iditem;
    }
    
    
}
