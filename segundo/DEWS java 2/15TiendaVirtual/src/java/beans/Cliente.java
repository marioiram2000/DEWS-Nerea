package beans;

import java.util.HashMap;
import java.util.Objects;

public class Cliente {

    private int id;
    private String nombre;
    private String password;
    private String domicilio;
    private String codigopostal;
    private String telefono;
    private String email;
    private HashMap<Integer, Pedido> pedidos;
    
    
    public Cliente() {
    }

    public Cliente(int id, String nombre, String password, String domicilio, String codigopostal, String telefono, String email) {
        this.id = id;
        this.nombre = nombre;
        this.password = password;
        this.domicilio = domicilio;
        this.codigopostal = codigopostal;
        this.telefono = telefono;
        this.email = email;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public String getDomicilio() {
        return domicilio;
    }

    public void setDomicilio(String domicilio) {
        this.domicilio = domicilio;
    }

    public String getCodigopostal() {
        return codigopostal;
    }

    public void setCodigopostal(String codigopostal) {
        this.codigopostal = codigopostal;
    }

    public String getTelefono() {
        return telefono;
    }

    public void setTelefono(String telefono) {
        this.telefono = telefono;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public HashMap<Integer, Pedido> getPedidos() {
        return pedidos;
    }

    public void setPedidos(HashMap<Integer, Pedido> pedidos) {
        this.pedidos = pedidos;
    }

    
    
    @Override
    public String toString() {
        return "Cliente{" + "id=" + id + ", nombre=" + nombre + ", password=" + password + ", domicilio=" + domicilio + ", codigopostal=" + codigopostal + ", telefono=" + telefono + ", email=" + email + '}';
    }

    @Override
    public int hashCode() {
        int hash = 7;
        hash = 13 * hash + Objects.hashCode(this.nombre);
        hash = 13 * hash + Objects.hashCode(this.domicilio);
        hash = 13 * hash + Objects.hashCode(this.codigopostal);
        hash = 13 * hash + Objects.hashCode(this.telefono);
        hash = 13 * hash + Objects.hashCode(this.email);
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Cliente other = (Cliente) obj;
        if (!Objects.equals(this.nombre, other.nombre)) {
            return false;
        }
        if (!Objects.equals(this.codigopostal, other.codigopostal)) {
            return false;
        }
        if (!Objects.equals(this.telefono, other.telefono)) {
            return false;
        }
        if (!Objects.equals(this.email, other.email)) {
            return false;
        }
        return true;
    }

    

    
    
    
}
