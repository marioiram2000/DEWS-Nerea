package beans;

import java.text.SimpleDateFormat;
import java.util.Date;

public class Prestamo {

    private int idprestamo;
    private int idlibro;
    private Date fecha;
    private Date fechaDev;

    public Prestamo() {
    }

    public Prestamo(int idprestamo, int idlibro, Date fecha, Date fechaDev) {
        this.idprestamo = idprestamo;
        this.idlibro = idlibro;
        this.fecha = fecha;
        this.fechaDev = fechaDev;
    }

    public int getIdprestamo() {
        return idprestamo;
    }

    public void setIdprestamo(int idprestamo) {
        this.idprestamo = idprestamo;
    }

    public int getIdlibro() {
        return idlibro;
    }

    public void setIdlibro(int idlibro) {
        this.idlibro = idlibro;
    }

    public Date getFecha() {
        return fecha;
    }

    public void setFecha(Date fecha) {
        this.fecha = fecha;
    }

    public Date getFechaDev() {
        return fechaDev;
    }

    public void setFechaDev(Date fechaDev) {
        this.fechaDev = fechaDev;
    }

    public String strFecha(){
        SimpleDateFormat formateador = new SimpleDateFormat("dd/MM/yyyy");
        return formateador.format(fecha);
    }
    
    @Override
    public String toString() {
        return "Prestamo{" + "idprestamo=" + idprestamo + ", idlibro=" + idlibro + ", fecha=" + fecha + ", fechaDev=" + fechaDev + '}';
    }
    
    
}
