package beans;

public class Reserva {
    
    private int id_ticket;
    private int pagado;
    private int numAsiento;
    private String id_dni;
    private String nombre;
    private int id_ruta;

    public Reserva(int id_ticket, int pagado, int numAsiento, String id_dni, String nombre, int id_ruta) {
        this.id_ticket = id_ticket;
        this.pagado = pagado;
        this.numAsiento = numAsiento;
        this.id_dni = id_dni;
        this.nombre = nombre;
        this.id_ruta = id_ruta;
    }

    public Reserva() {
    }

    public int getId_ticket() {
        return id_ticket;
    }

    public void setId_ticket(int id_ticket) {
        this.id_ticket = id_ticket;
    }

    public int getPagado() {
        return pagado;
    }

    public void setPagado(int pagado) {
        this.pagado = pagado;
    }

    public int getNumAsiento() {
        return numAsiento;
    }

    public void setNumAsiento(int numAsiento) {
        this.numAsiento = numAsiento;
    }

    public String getId_dni() {
        return id_dni;
    }

    public void setId_dni(String id_dni) {
        this.id_dni = id_dni;
    }

    public int getId_ruta() {
        return id_ruta;
    }

    public void setId_ruta(int id_ruta) {
        this.id_ruta = id_ruta;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }
    
    
}
