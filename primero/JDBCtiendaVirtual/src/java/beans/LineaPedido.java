
package beans;

public class LineaPedido {
    
    private int id;
    private int cantidad;
    private Pedido pedido;
    private Item item;

    public LineaPedido() {
    }

    public LineaPedido(int id, int cantidad, Pedido pedido, Item item) {
        this.id = id;
        this.cantidad = cantidad;
        this.pedido = pedido;
        this.item = item;
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
        return pedido;
    }

    public Item getItem() {
        return item;
    }

    public void setPedido(Pedido pedido) {
        this.pedido = pedido;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setItem(Item item) {
        this.item = item;
    }

    @Override
    public String toString() {
        return "LineaPedido{" + "id=" + id + ", cantidad=" + cantidad + ", pedido=" + pedido + ", item=" + item + '}';
    }
    
    
}
