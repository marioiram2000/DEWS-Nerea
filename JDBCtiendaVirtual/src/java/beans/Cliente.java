package beans;

public class Cliente {

    private int id;
    private String nombre;
    private String password;
    private String domicilio;
    private String codigopostal;
    private String telefono;
    private String email;
    
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

    public void setId(int id) {
        this.id = id;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public void setPassword(String password) {
        this.password = password;
    }

    public void setDomicilio(String domicilio) {
        this.domicilio = domicilio;
    }

    public void setCodigopostal(String codigopostal) {
        this.codigopostal = codigopostal;
    }

    public void setTelefono(String telefono) {
        this.telefono = telefono;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public int getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public String getPassword() {
        return password;
    }

    public String getDomicilio() {
        return domicilio;
    }

    public String getCodigopostal() {
        return codigopostal;
    }

    public String getTelefono() {
        return telefono;
    }

    public String getEmail() {
        return email;
    }
    
    
}
