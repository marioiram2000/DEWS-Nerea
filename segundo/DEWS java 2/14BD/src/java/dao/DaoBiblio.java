package dao;

import beans.Libro;
import beans.Prestamo;
import com.sun.xml.ws.tx.at.v10.types.PrepareResponse;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.sql.DataSource;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.rmi.CORBA.Tie;

public class DaoBiblio {

    
    /*
    COMO 
    CREAR 
    UN 
    PS 
    ESTATICO    
    */
    static PreparedStatement psSeleccionarPrestamos;
    
    static{
        try{
            Connection cn = dameConexionPool();
            String sql = "select idprestamo, fecha, fechadevolucion from prestamos where idlibro = ?";
            psSeleccionarPrestamos = cn.prepareStatement(sql);
            
            cierraConexion(cn);
        }catch(SQLException e){
            
        }
    }
    
    private static Connection dameConexionPool(){
        try {
            InitialContext ctx = new InitialContext();
            DataSource ds = (DataSource) ctx.lookup("jdbc/biblio");//javax.sql.DataSource;  ----- Se usa el recurso
            Connection cn = ds.getConnection();
            return cn;
            
        } catch (NamingException ex) {
            Logger.getLogger(DaoBiblio.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SQLException ex) {
            Logger.getLogger(DaoBiblio.class.getName()).log(Level.SEVERE, null, ex);
        }
        return null;
    }
    
    private static void cierraConexion(Connection cn){
        try {
            cn.close();
        } catch (SQLException ex) {
            Logger.getLogger(DaoBiblio.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    public static ArrayList<Libro> libros() {
        ArrayList<Libro> lstLibros = new ArrayList<>();
        
        try{
            Connection cn = dameConexionPool();
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
    
    public static void prestarLibros(int[] ids){
        try{
            Connection cn = dameConexionPool();
            String sql = "insert into prestamos (fecha, idlibro, fechadevolucion) values (?,?, null)";
            PreparedStatement ps = cn.prepareStatement(sql);
            System.out.println(ids.toString());
            for (int i = 0; i < ids.length; i++) {
                int id = ids[i];
                System.out.println(id);
                ps.setDate(1, new java.sql.Date(new java.util.Date().getTime()));
                ps.setInt(2, id);
                ps.executeUpdate();
            }
            
            cierraConexion(cn);
        }catch(SQLException e){
            System.err.println("dao.DaoBiblio.prestarLibros()");
        }
    }
    
    public static HashMap<Integer, Integer> mapCantidadPrestados(){
        HashMap<Integer, Integer> mapa = new HashMap<Integer, Integer>();
        ArrayList<Libro> libros = libros();
        try{
            Connection cn = dameConexionPool();
            String sql = "select count(*) as cuantos from prestamos where idlibro = ?";
            PreparedStatement ps = cn.prepareStatement(sql);
            for (Libro libro:libros) {
                ps.setInt(1, libro.getIdlibro());
                ResultSet rs = ps.executeQuery();
                if(rs.next()){
                    mapa.put(libro.getIdlibro(), rs.getInt("cuantos"));
                }
                rs.close();
                
            }
            ps.close();
            cierraConexion(cn);
            
            cierraConexion(cn);
        }catch(SQLException e){
            System.err.println("dao.DaoBiblio.mapCantidadPrestados()");
        }
        
        return mapa;
    }
    
    
    public static HashMap<Integer, ArrayList<Prestamo>> mapaPrestamos(){
        HashMap<Integer, ArrayList<Prestamo>> mapa = new HashMap<Integer, ArrayList<Prestamo>>();
        ArrayList<Libro> libros = libros();
        try{
            
            for (Libro libro:libros) {
                ArrayList<Prestamo> prestamos = new ArrayList<Prestamo>();
                psSeleccionarPrestamos.setInt(1, libro.getIdlibro());
                ResultSet rs = psSeleccionarPrestamos.executeQuery();
                while(rs.next()){
                    int idprestamo = rs.getInt("idprestamo");
                    java.util.Date fecha = new java.util.Date(rs.getDate("fecha").getTime());
                    java.util.Date fechaDev;
                    if(rs.getDate("fechadevolucion")!=null){
                        fechaDev = new java.util.Date(rs.getDate("fechadevolucion").getTime());
                    }else{
                        fechaDev = null;
                    }
                    Prestamo prestamo = new Prestamo();
                    prestamo.setIdprestamo(idprestamo);
                    prestamo.setIdlibro(libro.getIdlibro());
                    prestamo.setFecha(fecha);
                    prestamo.setFechaDev(fechaDev);
                    prestamos.add(prestamo);
                }
                mapa.put(libro.getIdlibro(), prestamos);
                rs.close();
            }
            psSeleccionarPrestamos.close();
            
        }catch(SQLException e){
            System.err.println("dao.DaoBiblio.mapCantidadPrestados()");
        }
        return mapa;
    }
    
    
}