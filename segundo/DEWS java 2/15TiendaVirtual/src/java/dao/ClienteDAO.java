package dao;

import beans.Cliente;
import conex.BDConex;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;

public class ClienteDAO {

    static PreparedStatement psInsertCliente;
    static PreparedStatement psActualizaCliente;
    static Connection cn ;
    
    static{
        try{
            cn = (Connection) BDConex.ds.getConnection();
            String sqlPsInsertCliente = "INSERT INTO clientes (id, nombre, password, domicilio, codigopostal, telefono, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
            psInsertCliente = cn.prepareStatement(sqlPsInsertCliente);
            
            String sqlPsActualizaCliente = "UPDATE clientes SET nombre = ?, password = ?, domicilio = ?, codigopostal = ?, telefono = ?, email = ? WHERE clientes.id = ?";
            psActualizaCliente = cn.prepareStatement(sqlPsActualizaCliente);
            
        }catch(SQLException e){
            System.err.println("dao.ClienteDAO.bloqueEstático() "+e.getMessage());
        }
    }
    
    public static Cliente buscaCliente(String nombre, String password){
        String sql = "SELECT id, domicilio, codigopostal, telefono, email FROM clientes WHERE nombre = '"+nombre+"' AND password = '"+password+"' ";
        try(Connection cn = (Connection) BDConex.ds.getConnection(); Statement st = cn.createStatement();){
            ResultSet rs = st.executeQuery(sql);
            if (rs.next()){
                Cliente c = new Cliente(rs.getInt("id"), nombre, password, rs.getString("domicilio"), rs.getString("codigopostal"), rs.getString("telefono"), rs.getString("email"));
                return c;
            }
            
        }catch(SQLException e){
            System.err.println("dao.ClienteDAO.buscaCliente()");
        }
        
        return null;
    }
    
    public static boolean buscaCliente(String nombre){
        String sql = "SELECT id FROM clientes WHERE nombre = '"+nombre+"'";
        
        try(Connection cn = (Connection) BDConex.ds.getConnection(); Statement st = cn.createStatement();){
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                return true;
            }            
        }catch(SQLException e){
            System.err.println("dao.KeysDAO.siguienteId() "+e.getMessage());
        }        
        return false;
    }
    
    public static boolean guardaCliente(Cliente c){
//"INSERT INTO clientes (id, nombre, password, domicilio, codigopostal, telefono, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        int id = KeysDAO.siguienteId("clientes");
        System.err.println("dao.ClienteDAO.guardaCliente() siguiente id: "+id);
        try {
            psInsertCliente.setInt(1, id);
            psInsertCliente.setString(2, c.getNombre());
            psInsertCliente.setString(3, c.getPassword());
            psInsertCliente.setString(4, c.getDomicilio());
            psInsertCliente.setString(5, c.getCodigopostal());
            psInsertCliente.setString(6, c.getTelefono());
            psInsertCliente.setString(7, c.getEmail());
            
            int n = psInsertCliente.executeUpdate();
            if(n>0)return true;
        } catch (SQLException ex) {
            Logger.getLogger(ClienteDAO.class.getName()).log(Level.SEVERE, null, ex);
            //System.err.println("dao.ClienteDAO.guardaCliente()"+ ex.getMessage());
        }
        return false;
    }
    
    public static boolean actualizaCliente(Cliente c){
//"UPDATE clientes SET nombre = '?', password = '?', domicilio = '?', codigopostal = '?', telefono = '?', email = '?' WHERE clientes.id = ?";
        int id = KeysDAO.siguienteId("clientes");
        try {
            psActualizaCliente.setInt(7, c.getId());
            psActualizaCliente.setString(1, c.getNombre());
            psActualizaCliente.setString(2, c.getPassword());
            psActualizaCliente.setString(3, c.getCodigopostal());
            psActualizaCliente.setString(4, c.getDomicilio());
            psActualizaCliente.setString(5, c.getTelefono());
            psActualizaCliente.setString(6, c.getEmail());
            
            int n = psInsertCliente.executeUpdate();
            if(n>0)return true;
        } catch (SQLException ex) {
            Logger.getLogger(ClienteDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return false;
    }
    
}
