package dao;

import beans.Cliente;
import conex.Conexion;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;

public class GestionClientes {
    
    
    public static Cliente buscaCliente(String nom, String pas){
        Connection cn = Conexion.conexion();
        try {            
            Statement st = cn.createStatement();
            String sql = "SELECT id, domicilio, codigopostal, telefono, email "
                        + "FROM clientes "
                        + "WHERE nombre = '"+nom+"'"
                        + "AND password = '"+pas+"'";
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                int id = rs.getInt("id");
                String nombre = nom;
                String password = pas;
                String domicilio = rs.getString("domicilio");
                String codigopostal = rs.getString("codigopostal");
                String telefono = rs.getString("telefono");
                String email = rs.getString("email");
                
                Cliente c = new Cliente(id, nombre, password, domicilio, codigopostal, telefono, email);
                
                Conexion.devolverConexion(cn);
                return c;
            }           
        } catch (SQLException ex) {
            System.err.println("Gestion clientes -> buscaCliente(String nom, String pas)");
        }   
        Conexion.devolverConexion(cn);
        return null;        
    }
    
    public static boolean buscaCliente(String nom){
        Connection cn = Conexion.conexion();
        try {
            Statement st = cn.createStatement();
            String sql = "SELECT nombre "
                        + "FROM clientes "
                        + "WHERE nombre = '"+nom+"'";
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                if(rs.getString("nombre").equals(nom)){
                    Conexion.devolverConexion(cn);
                    return true;
                }else{
                    Conexion.devolverConexion(cn);
                    return false;
                }
            }
        } catch (SQLException ex) {
            System.err.println("Gestion clientes -> buscaCliente(String nom)");
        }        
        Conexion.devolverConexion(cn);
        return false;        
    }
    
    private static String insertCliente = "INSERT into clientes VALUES (?,?,?,?,?,?,?)";
    private static PreparedStatement psInsertCliente;
    static{
        Connection cn = Conexion.conexion();
        try {            
            psInsertCliente = cn.prepareStatement(insertCliente);            
        } catch (SQLException ex) {
            System.err.print("Gestion clientes -> psInsertCliente");
        }
        Conexion.devolverConexion(cn);
    }

    public static boolean guardaCliente(Cliente c){       
        try {                    
            psInsertCliente.setInt(1,c.getId());
            psInsertCliente.setString(2, c.getNombre());
            psInsertCliente.setString(3, c.getPassword());
            psInsertCliente.setString(4, c.getDomicilio());
            psInsertCliente.setString(5, c.getCodigopostal());
            psInsertCliente.setString(6, c.getTelefono());
            psInsertCliente.setString(7, c.getEmail());
            
            int n = psInsertCliente.executeUpdate();
            if(n>0){
                return true;
            }
        } catch (SQLException ex) {
            System.err.println("Gestion clientes -> guardaCliente(Cliente c)");
        }
        return false;
    }
    
    
    private static String updateCliente = 
            "UPDATE clientes "
            + "SET nombre = ?, password = ?, domicilio = ?, codigopostal = ?, telefono = ?, email = ?"
            + "WHERE id = ?";
    private static PreparedStatement psUpdateCliente;
    static{
        Connection cn = Conexion.conexion();
        try {
            psUpdateCliente = cn.prepareStatement(updateCliente);
        } catch (SQLException ex) {
            System.err.print("Gestion clientes -> psUpdateCliente");
        }
        Conexion.devolverConexion(cn);
    }
    public static boolean actualizaCliene(Cliente c){
        try {        
            int id = c.getId();
            String nombre = c.getNombre();
            String password = c.getPassword();
            String domicilio = c.getDomicilio();
            String codigopostal = c.getCodigopostal();
            String telefono = c.getTelefono();
            String email = c.getEmail();
            
            psUpdateCliente.setString(1, nombre);
            psUpdateCliente.setString(2, password);
            psUpdateCliente.setString(3, domicilio);
            psUpdateCliente.setString(4, codigopostal);
            psUpdateCliente.setString(5, telefono);
            psUpdateCliente.setString(6, email);
            psUpdateCliente.setInt(7, id);
            
            int n = psUpdateCliente.executeUpdate();
            if(n>0){
                return true;
            }
        } catch (SQLException ex) {
            System.err.print("Gestion clientes -> actualizaCliene(Cliente c)");
        }        
        return false;
    }
    
    public static int cuantosClientes(){
        Connection cn = Conexion.conexion();
        try {            
            Statement st = cn.createStatement();
            String sql = "SELECT COUNT(id) as cantidad "
                        + "FROM clientes";
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                int cant = rs.getInt("cantidad");
                Conexion.devolverConexion(cn);
                System.out.println("----Clientes en la base de datos: "+cant+"----");
                return cant;
            }           
        } catch (SQLException ex) {
            System.err.println("Gestion clientes -> cuantosClientes()");
        }   
        Conexion.devolverConexion(cn);
        return -1;
    }
}
