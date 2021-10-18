/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;


import java.sql.Connection;
import java.sql.SQLException;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import org.apache.commons.dbcp2.BasicDataSource;
import java.util.List;
import beans.Bus;
import beans.Ruta;
import java.sql.ResultSet;
import java.sql.Timestamp;
import java.util.ArrayList;

/**
 *
 * @author dw2
 */
public class DaoBuses {
    
    private static final BasicDataSource ds=new BasicDataSource();    
    static{
        //Este ds va con un pool de conexiones
        ds.setDriverClassName("com.mysql.jdbc.Driver");
        ds.setUrl("jdbc:mysql://localhost/bdbus");
        ds.setUsername("root");
        ds.setPassword("");  
    }
    
 
    public static ArrayList<Ruta> todasRutas(float limInf, float limSup){
        
       ArrayList<Ruta> rutas=new ArrayList<Ruta>();
       String sql="select id_ruta, ciudadorigen, ciudaddestino, horallegada, horasalida, tarifa"
                + ", id_placa from rutas where tarifa between " + limInf + " and " + limSup;
        try(Connection cn=ds.getConnection();
            Statement st=cn.createStatement();   
            ResultSet rs=st.executeQuery(sql);
            )
        {
            while (rs.next()){
                Ruta r=new Ruta();
                r.setId_ruta(rs.getInt("id_ruta"));
                r.setCiudadOrigen((rs.getString("ciudadorigen")));
                r.setCiudadDestino(rs.getString("ciudaddestino"));
                
                Timestamp ts=new Timestamp(rs.getTimestamp("horasalida").getTime());
                r.setHoraSalida(new java.util.Date(ts.getTime()));
                
                Timestamp ts2=new Timestamp(rs.getTimestamp("horallegada").getTime());
                r.setHoraLlegada(new java.util.Date(ts2.getTime()));
                
                r.setTarifa(rs.getFloat("tarifa"));                
                r.setBus( busDePlaca(rs.getString("id_placa")));   
                
                
                rutas.add(r);
                
            }
        }
        catch (SQLException e){
            System.err.println("falla en todasRutas " + e.getMessage() + " sql:" + sql);           
        }
        finally{
            System.out.println(rutas.toString());
            return rutas;
        }       
        
    }
   
    private static Bus busDePlaca(String id_placa) {
    
        System.out.println("Buscando bus para placa" + id_placa);
        Bus bus=null;
        String sql="select Id_Placa, Capacidad, imagen from buses where id_placa='" + id_placa + "'";
        System.out.println(sql);
        try(Connection cn=ds.getConnection();
            Statement st=cn.createStatement();   
            ResultSet rs=st.executeQuery(sql);
            )
        {
            if (rs.next()){
                System.err.println("dentro de if next");
               bus=new Bus(rs.getString("Id_Placa"), rs.getInt("Capacidad"), rs.getString("imagen"));
               return bus;
            }
        }
        catch (SQLException e){
            System.err.println("falla en busDePlaca " + e.getMessage() + " sql:" + sql);           
        }
        return null; 
    
    
    
    }
        
}
