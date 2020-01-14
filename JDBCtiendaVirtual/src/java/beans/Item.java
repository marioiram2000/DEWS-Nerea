package beans;

public class Item {
    
    private int id;
    private String nombre;
    private double precio;
    private String imagen;

    public Item() {
    }

    public Item(int id, String nombre, double precio, String imagen) {
        this.id = id;
        this.nombre = nombre;
        this.precio = precio;
        this.imagen = imagen;
    }

    public double getPrecio() {
        return precio;
    }
    
    
}
