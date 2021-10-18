package dao;

import beans.Autor;
import beans.Libro;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.LinkedHashMap;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

public class DaoBiblio {
    
    public static Connection conexion(){
        
        Connection cn=null;
        try {
            InitialContext ctx = new InitialContext();
            DataSource ds = (DataSource) ctx.lookup("jdbcbiblio");
            
            cn = ds.getConnection();
        } catch (NamingException ex) {
            Logger.getLogger(DaoBiblio.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SQLException ex) {
            Logger.getLogger(DaoBiblio.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return cn;
    }
    
    public static void devolverConexion(Connection cn){
        try {
            //Devuelve conexion al pool
            cn.close();
        } catch (SQLException ex) {
            Logger.getLogger(DaoBiblio.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    public static ArrayList<Libro> librosDe(Autor a){
        ArrayList<Libro> libros=new ArrayList<Libro>();
        Connection cn=conexion();
        
        try {
            Statement  st = cn.createStatement();
            ResultSet rs=st.executeQuery("SELECT idlibro,titulo,paginas,genero,idautor FROM libros WHERE idautor="+a.getIdautor()+"");
            while(rs.next()){
                Libro l = new Libro();
                l.setIdlibro(rs.getInt("idlibro"));
                l.setTitulo(rs.getString("titulo"));
                l.setPaginas(rs.getInt("paginas"));
                l.setGenero(rs.getString("genero"));
                l.setIdautor(rs.getInt("idautor"));
                libros.add(l);
            }
        } catch (SQLException ex) {
             System.out.println("ERROR CONSULTA SELECT LIBROS: " + ex.toString());
        }
        
        devolverConexion(cn);
        return libros;
    }
    
    public static LinkedHashMap<Autor,ArrayList<Libro>> mapaAutores(){
        
        LinkedHashMap<Autor,ArrayList<Libro>> mapa = new LinkedHashMap<Autor,ArrayList<Libro>>();
        
        Connection cn=conexion();
        
        try {
            String sql="SELECT idautor, nombre, nacionalidad, fechanac FROM autores ORDER BY nombre";
            
            Statement st=cn.createStatement();
            ResultSet rs=st.executeQuery(sql);
            
            while(rs.next()){
                java.sql.Date fechaBD=rs.getDate(4);
                java.util.Date fechaObj=new java.util.Date(fechaBD.getTime());
                
                Autor a = new Autor();
                a.setIdautor(rs.getInt(1));
                a.setNombre(rs.getString(2));
                a.setNacionalidad(rs.getString(3));
                a.setFechanac(fechaObj);
                
                mapa.put(a,librosDe(a));
            }
            
            st.close();
        } catch (SQLException ex) {
            System.out.println("ERROR CONSULTA SELECT AUTORES: " + ex.toString());
        }
        
        devolverConexion(cn);
        
        return mapa;
    }
    
    public static void reservar(int idlibro){
        Connection cn=conexion();
        
        String sql="INSERT INTO prestamos (fecha,idlibro) VALUES (now(),"+idlibro+")";
        Statement st;
        
        try {
            st = cn.createStatement();
            st.executeUpdate(sql);
        } catch (SQLException ex) {
            Logger.getLogger(DaoBiblio.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        devolverConexion(cn);
    }
}
