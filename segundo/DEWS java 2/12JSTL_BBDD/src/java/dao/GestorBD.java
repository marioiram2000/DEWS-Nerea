package dao;

import beans.Autor;
import beans.Libro;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.LinkedHashMap;
import java.util.logging.Level;
import java.util.logging.Logger;


public class GestorBD {

    private static final String DRIVER="com.mysql.jdbc.Driver";
    private static final String URL="jdbc:mysql://localhost/bdlibros";
    private static final String USER="root";
    private static final String PASS="";
    
    private Connection cn;
    
    public GestorBD(){        
        
        try {
            Class.forName(DRIVER);
            cn=DriverManager.getConnection(URL, USER, PASS);
        } catch (ClassNotFoundException ex) {
            System.err.println("Error en driver");
        } catch (SQLException ex) {
            System.err.println("Error al conectarse en la bd");
        }        
    }
    
    public ArrayList<Libro> libros() {
        ArrayList<Libro> lstLibros = new ArrayList<>();
        try{
            Statement st = cn.createStatement();
            String sql = "select idlibro, titulo, paginas, genero, idautor from libros";
            ResultSet rs = st.executeQuery(sql);
            while (rs.next()){
                Libro l = new Libro(rs.getInt("idlibro"), rs.getString("titulo"), rs.getInt("paginas"), rs.getString("genero"), rs.getInt("idautor"));
                lstLibros.add(l);            
            }
        }catch(SQLException e){
            System.err.println("dao.GestorBD.libros()");
        }finally{
            return lstLibros;
        }
    }
    
    public LinkedHashMap<Integer, Autor> autores(){
        LinkedHashMap<Integer, Autor> autores = new LinkedHashMap<>();
        
        try{
            Statement st = cn.createStatement();
            String sql = "select idautor, nombre, fechanac, nacionalidad from autores";
            ResultSet rs = st.executeQuery(sql);
            while (rs.next()){
                Autor a = new Autor(rs.getInt("idautor"), rs.getString("nombre"));
                autores.put(rs.getInt("idautor"), a);                            
            }
        }catch(SQLException e){
            System.err.println("dao.GestorBD.autores()");
        }finally{
            return autores;
        }
    }
    
    public boolean insertLibro(Libro l){
        try{
            Statement st = cn.createStatement();
            String sql = "insert into libros (titulo, paginas, genero, idautor) "
                    + "values ('"+l.getTitulo()+"', "+l.getPaginas()+", '"+l.getGenero()+"', "+l.getIdautor()+")";
            st.executeUpdate(sql);
            
            System.err.println(sql);
        }catch(SQLException e){
            System.err.println("dao.GestorBD.insertLibro()");
            return false;
        }
        return true;
    }
}
    
    