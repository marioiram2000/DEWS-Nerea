package beans;

import java.util.ArrayList;
import java.util.Iterator;

public class Item {
    
    private int id;
    private String nombre;
    private double precio;
    private ArrayList<String> compradoresItem;

    public Item() {
    }

    public Item(int id, String nombre, double precio, ArrayList<String> compradoresItem) {
        this.id = id;
        this.nombre = nombre;
        this.precio = precio;
        this.compradoresItem = compradoresItem;
    }

    public int getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public double getPrecio() {
        return precio;
    }

    public ArrayList<String> getCompradoresItem() {        
        return compradoresItem;
    }

    public void setCompradoresItem(ArrayList<String> compradoresItem) {
        this.compradoresItem = compradoresItem;
    }

    @Override
    public String toString() {
        return "Item{" + "id=" + id + ", nombre=" + nombre + ", precio=" + precio + ", compradoresItem=" + compradoresItem + '}';
    }
    
    
}
