package dao;

import beans.Cliente;
import conex.BDConex;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

public class DaoClientes {

    public static ArrayList<Cliente> getClientes(){
        ArrayList<Cliente> clientes = new ArrayList<>();
        String sql = "SELECT Id_DNI, Nombre, Direccion, Email FROM clientes";
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();
            ResultSet rs = st.executeQuery(sql);){
            
            while(rs.next()){
                Cliente c = new Cliente();
                c.setDNI(rs.getString("Id_DNI"));
                c.setNombre(rs.getString("Nombre"));
                c.setDireccion(rs.getString("Direccion"));
                c.setEmail(rs.getString("Email"));
                clientes.add(c);
            }
            
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.getRutas()"+e.getMessage());
        }
        return clientes;
    }
    
    public static void insertCliente(Cliente c){
        String sql = "INSERT INTO clientes (Id_DNI, Nombre, Direccion, Email)"
                + " VALUES ('"+c.getDNI()+"', '"+c.getNombre()+"', '"+c.getDireccion()+"', '"+c.getEmail()+"')";
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();){
            st.executeUpdate(sql);
        }catch(SQLException e){
            System.err.println("dao.DaoClientes.insertCliente()");
        }        
    }
}
