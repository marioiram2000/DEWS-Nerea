package beans;
public class Cliente {

    private String DNI;
    private String nombre;
    private String direccion;
    private String email;

    public Cliente() {
    }

    public Cliente(String DNI, String nombre, String direccion, String email) {
        this.DNI = DNI;
        this.nombre = nombre;
        this.direccion = direccion;
        this.email = email;
    }

    public String getDNI() {
        return DNI;
    }
    public void setDNI(String DNI) {
        this.DNI = DNI;
    }
    public String getNombre() {
        return nombre;
    }
    public void setNombre(String nombre) {
        this.nombre = nombre;
    }
    public String getDireccion() {
        return direccion;
    }
    public void setDireccion(String direccion) {
        this.direccion = direccion;
    }
    public String getEmail() {
        return email;
    }
    public void setEmail(String email) {
        this.email = email;
    }
    
    
    
}
