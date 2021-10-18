package beans;

public class Catalogo {
    private String[] libros ;

    public Catalogo() {
        this.libros = new String[]{"El alquimista", "Utopia", "La viajera del tiempo", "Harry Potter", "Solo leveling", "One piece"};
    }

    public String[] getLibros() {
        return libros;
    }

    public void setLibros(String[] libros) {
        this.libros = libros;
    }
    
    
}
