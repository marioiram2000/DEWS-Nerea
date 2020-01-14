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
    
    
}
