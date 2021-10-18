package dao;

import beans.Prestamo;
import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import org.apache.commons.dbcp2.BasicDataSource;

public class DaoBiblio {

    private static final BasicDataSource ds = new BasicDataSource();
    
    static{
        //Este ds va con un pool de conexiones
        ds.setDriverClassName("com.mysql.jdbc.Driver");
        ds.setUrl("jdbc:mysql://localhost/bdlibros");
        ds.setUsername("mario");
        ds.setPassword("123");
    }
    
    public static boolean insertarPrestamo(Prestamo prestamo){
        SimpleDateFormat formateador = new SimpleDateFormat("yyyy/MM/dd");
        String strFecha = formateador.format(prestamo.getFecha());
        String strFechaDev = formateador.format(prestamo.getFechaDev());
        
        String sql = "insert into prestamos (fecha, fechadevolucion, idlibro) values ('"+strFecha+"','"+strFechaDev+"',"+prestamo.getIdprestamo()+")";
        try(Connection cn = ds.getConnection();Statement st = cn.createStatement();){
            st.executeUpdate(sql);
            
            return true;
        }catch(SQLException e){
            System.out.println("dao.DaoBiblio.insertarPrestamo()"+e.getMessage());
            return false;
        }
    }
}
