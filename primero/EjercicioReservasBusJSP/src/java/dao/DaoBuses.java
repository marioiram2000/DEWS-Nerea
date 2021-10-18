package dao;

import beans.Ruta;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

public class DaoBuses {
    public static Connection conexion(){
        
        Connection cn=null;
        try {
            InitialContext ctx = new InitialContext();
            DataSource ds = (DataSource) ctx.lookup("jdbcBuses");
            
            cn = ds.getConnection();
        } catch (NamingException ex) {
            Logger.getLogger(DaoBuses.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SQLException ex) {
            Logger.getLogger(DaoBuses.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return cn;
    }
    
    public static void devolverConexion(Connection cn){
        try {
            //Devuelve conexion al pool
            cn.close();
        } catch (SQLException ex) {
            Logger.getLogger(DaoBuses.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    public static ArrayList<Ruta> rutas(){
        ArrayList<Ruta> rutas=new ArrayList<Ruta>();
        Connection cn=conexion();
        
        try {
            Statement  st = cn.createStatement();
            ResultSet rs = st.executeQuery("SELECT CiudadOrigen, CiudadDestino, Id_placa, Tarifa FROM rutas");
            System.out.println("ANTES DEL WHILE");
            while(rs.next()){
                System.out.println("NO ENTRA EN EL WHILE");
                Ruta r = new Ruta();
                r.setOrigen(rs.getString("CiudadOrigen"));
                r.setDestino(rs.getString("CiudadDestino"));
                r.setBus(rs.getString("Id_placa"));
                r.setTarifa(rs.getDouble("Tarifa"));
                rutas.add(r);
            }
        } catch (SQLException ex) {
             System.out.println("ERROR CONSULTA SELECT RUTAS: " + ex.toString());
        }
        
        devolverConexion(cn);
        return rutas;
    }
}
