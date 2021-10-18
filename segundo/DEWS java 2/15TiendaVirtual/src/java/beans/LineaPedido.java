package beans;
public class LineaPedido {

    private int id;
    private int cantidad;
    private Item item;
    private Pedido pedido;

    public LineaPedido() {
    }

    public int getCantidad() {
        return cantidad;
    }

    public void setCantidad(int cantidad) {
        this.cantidad = cantidad;
    }

    public Item getItem() {
        return item;
    }

    public void setItem(Item item) {
        this.item = item;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Pedido getPedido() {
        return pedido;
    }

    public void setPedido(Pedido pedido) {
        this.pedido = pedido;
    }

    @Override
    public String toString() {
        return "LineaPedido{" + "id=" + id + ", cantidad=" + cantidad + ", item=" + item.toString() + '}';
    }

    
    
    
    
}
