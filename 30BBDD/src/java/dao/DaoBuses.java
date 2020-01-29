/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package dao;

import beans.Bus;
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
            InitialContext ctx=new InitialContext();
            DataSource ds=(DataSource)ctx.lookup("jdbcBuses");
            cn=ds.getConnection();     
           
        } catch (NamingException ex) {
        } catch (SQLException ex) {
        }
        finally{
            return cn; //Toma conexión del pool
        }
    }
    
    public static void devolverConexion(Connection cn){
        try {
            cn.close(); //Devuelve conexión al pool
        } catch (SQLException ex) {
        
        }
    }
    
    
    public static ArrayList<Bus> buses(){        
        
        ArrayList<Bus> buses=new ArrayList<Bus>();
        Connection cn=conexion();       
        try {
            Statement st=cn.createStatement();
             ResultSet rs=st.executeQuery("select id_placa, capacidad, imagen "
                    + " from buses" );
            while (rs.next()){
                Bus b=new Bus();
                b.setId_placa(rs.getString("id_placa"));
                b.setCapacidad(rs.getInt("capacidad"));
                b.setImagen(rs.getString("imagen"));
                buses.add(b);
            }
        } catch (SQLException ex) {
            System.out.println("Error en Dao buses " + ex.getMessage());
         }
         
         devolverConexion(cn);
         return buses;   
    }
    
    
    public static ArrayList<Ruta> rutasDeBus(String placa){
        
        ArrayList<Ruta> rutas=new ArrayList<Ruta>();
        Connection cn=conexion();       
        try {
            Statement st=cn.createStatement();
            String sql="select id_ruta, ciudadorigen, ciudaddestino, horasalida " +
                    " , horallegada, tarifa, id_placa from rutas where id_placa='"
                    + placa + "'";
                    
            ResultSet rs=st.executeQuery(sql);
            
            while (rs.next()){
                Ruta r=new Ruta();
                r.setId_ruta(rs.getInt("id_ruta"));
                r.setCiudadOrigen(rs.getString("ciudadorigen"));
                r.setCiudadDestino(rs.getString("ciudaddestino"));
                r.setHoraSalida( new java.util.Date( rs.getTimestamp("horasalida").getTime()));
                r.setHoraLlegada( new java.util.Date( rs.getTimestamp("horallegada").getTime()));
                r.setTarifa(rs.getFloat("tarifa"));
                r.setId_placa(placa);
                rutas.add(r);
              
            }
        } catch (SQLException ex) {
            System.out.println("Error en Dao rutasDeBus " + ex.getMessage());
         }         
         devolverConexion(cn);
         return rutas;   
    }
    
    
    
    public static void subirTarifa(Ruta r, int porc){
        
        Connection cn=conexion();       
        try {
            Statement st=cn.createStatement();
            
            String sql="update rutas set tarifa= tarifa + tarifa * " + (float)porc/100 + ""
                    + " where id_ruta=" + r.getId_ruta();        
            System.out.println(sql);
            st.executeUpdate(sql);
            
        }
        catch(SQLException e){
             System.out.println("Error en Dao subirTarifa " + e.getMessage());
        }
        devolverConexion(cn);
    }
    
    public static void guardarRuta(Ruta r){
        
        Connection cn=conexion();       
        try {
            Statement st=cn.createStatement();
            
            String sql="update rutas set ciudadorigen='" + r.getCiudadDestino() + "' "
                    + ", ciudaddestino='" + r.getCiudadDestino() + "' "
                    + " where id_ruta=" + r.getId_ruta();        
            System.out.println(sql);
            st.executeUpdate(sql);
            
        }
        catch(SQLException e){
             System.out.println("Error en Dao subirTarifa " + e.getMessage());
        }
        devolverConexion(cn);
    }
    
    
    /*
    public static void main(String args[]){
        System.out.println(conexion());
    }
    */
    
}
