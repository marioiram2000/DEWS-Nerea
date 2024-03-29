package beans;

import java.io.Serializable;

public class Item implements Serializable{
    
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

    public int getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public String getImagen() {
        return imagen;
    }

    @Override
    public String toString() {
        return "Item{" + "id=" + id + ", nombre=" + nombre + ", precio=" + precio + ", imagen=" + imagen + '}';
    }
}
