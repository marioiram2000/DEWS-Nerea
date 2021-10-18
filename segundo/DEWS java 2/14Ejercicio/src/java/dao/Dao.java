package dao;

import beans.Libro;
import beans.Prestamo;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Date;
import javax.sound.midi.SysexMessage;
import org.apache.commons.dbcp2.BasicDataSource;
import org.apache.jasper.tagplugins.jstl.ForEach;

public class Dao {

    private static final BasicDataSource ds = new BasicDataSource();
    
    static{
        //Este ds va con un pool de conexiones
        ds.setDriverClassName("com.mysql.jdbc.Driver");
        ds.setUrl("jdbc:mysql://localhost/bdlibros");
        ds.setUsername("mario");
        ds.setPassword("123");
    }
    
    
    public static ArrayList<Prestamo> getPrestamosSinDevolver(){
        ArrayList<Prestamo> prestamos = new ArrayList<Prestamo>();
        String sql = "SELECT idprestamo, fecha, idlibro FROM prestamos WHERE fechadevolucion IS NULL ORDER BY fecha";
        
        try(Connection cn = ds.getConnection(); Statement st = cn.createStatement()){
            ResultSet rs = st.executeQuery(sql);
            while (rs.next()){         
                Prestamo p = new Prestamo(rs.getInt("idprestamo"), rs.getInt("idlibro"), rs.getDate("fecha"), null);
                prestamos.add(p);
            }
        }catch(SQLException e){
            System.err.println("dao.Dao.getPrestamosSinDevolver()");
        }finally{
            return prestamos;
        }
    }
    
    public static String getTitulo(int idlibro){
        String sql = "SELECT titulo FROM libros WHERE idlibro = "+idlibro;
        
        try(Connection cn = ds.getConnection(); Statement st = cn.createStatement()){
            ResultSet rs = st.executeQuery(sql);
            rs.next();
            return rs.getString("titulo");
        }catch(SQLException e){
            System.err.println("dao.Dao.getTitulo()");
        }
        return "titulo";
    }
    
    public static void devolverLibro(int idprestamo){
        String sql = "UPDATE prestamos SET fechadevolucion = CURRENT_DATE WHERE prestamos.idprestamo = "+idprestamo;
        try(Connection cn = ds.getConnection(); Statement st = cn.createStatement()){
            st.executeUpdate(sql);
        }catch(SQLException e){
             System.err.println("dao.Dao.devolverLibro()");
        }
    }
}
