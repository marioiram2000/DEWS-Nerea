
package beans;


public class Libro {

    private int idlibro;
    private String titulo;
    private int paginas;
    private String genero;
    private int idautor;

    public Libro() {
    }

    @Override
    public String toString() {
        return "Libro{" + "idlibro=" + idlibro + ", titulo=" + titulo + ", paginas=" + paginas + ", genero=" + genero + ", idautor=" + idautor + '}';
    }

    public Libro(int idlibro, String titulo, int paginas, String genero, int idautor) {
        this.idlibro = idlibro;
        this.titulo = titulo;
        this.paginas = paginas;
        this.genero = genero;
        this.idautor = idautor;
    }
    
    public Libro(String titulo, int paginas, String genero, int idautor) {
        this.titulo = titulo;
        this.paginas = paginas;
        this.genero = genero;
        this.idautor = idautor;
    }

    public int getIdlibro() {
        return idlibro;
    }

    public void setIdlibro(int idlibro) {
        this.idlibro = idlibro;
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public int getPaginas() {
        return paginas;
    }

    public void setPaginas(int paginas) {
        this.paginas = paginas;
    }

    public String getGenero() {
        return genero;
    }

    public void setGenero(String genero) {
        this.genero = genero;
    }

    public int getIdautor() {
        return idautor;
    }

    public void setIdautor(int idautor) {
        this.idautor = idautor;
    }
    
    
    
    
    
    
}
