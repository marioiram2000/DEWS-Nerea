package dao;

import beans.Cliente;
import beans.Item;
import beans.LineaPedido;
import beans.Pedido;
import conex.Conexion;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Date;
import java.util.HashMap;
import java.util.HashSet;
import java.util.Iterator;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;

public class GestionPedidos {
    
    public static HashMap todosItems(){
        Connection cn = Conexion.conexion();
        HashMap<Integer, Item> items = new HashMap<>();
        try {
            Statement st = cn.createStatement();
            String sql = "SELECT id, nombre, precio, imagen "
                        + "FROM items";
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
                Item it = new Item(rs.getInt("id"), rs.getString("nombre"), rs.getDouble("precio"), "");
                items.put(rs.getInt("id"), it);
                
            }
        } catch (SQLException ex) {
            System.err.println("GestionPedidos.todosItems()");
        }     
        Conexion.devolverConexion(cn);
        //System.out.println(items);
        return items;     
    }
    
    public static Item buscaItemPoirId(int iditem){
        Connection cn = Conexion.conexion();
        Item item = null;
        try {
            Statement st = cn.createStatement();
            String sql = "SELECT id, nombre, precio, imagen "
                        + "FROM items "
                        + "WHERE id="+iditem;
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                item = new Item(rs.getInt("id"), rs.getString("nombre"), rs.getDouble("precio"), "");
            }
        } catch (SQLException ex) {
            System.err.println("GestionPedidos.buscaItemPoirId()");
        } 
        
        Conexion.devolverConexion(cn);
        return item;
    }
    
    
    private static String insertPedido = "INSERT INTO pedidos (id, total, fecha, idcliente) VALUES (?,?,?,?)";
    private static PreparedStatement psInsertPedido;
    static{
        Connection cn = Conexion.conexion();
        try {            
            psInsertPedido = cn.prepareStatement(insertPedido);            
        } catch (SQLException ex) {
            System.err.println("GestionPedidos psInsertPedido");
        }
        Conexion.devolverConexion(cn);
    }
    
    public static void guardaPedido(Pedido p){
        try {
            psInsertPedido.setInt(1, p.getId());
            psInsertPedido.setDouble(2, p.getTotal());
            psInsertPedido.setDate(3, p.getFecha());
            psInsertPedido.setInt(4, p.getIdcliente());
            
            psInsertPedido.executeUpdate();
        } catch (SQLException ex) {
            System.err.println("GestionPedidos.guardaPedido(Pedido p)");
        }        
        return;
    }
    
    
    private static String insertLineaPedido = "INSERT into lineaspedido (id, cantidad, idpedido, iditem) VALUES (?,?,?,?)";
    private static PreparedStatement psInsertLineaPedido;
    static{
        Connection cn = Conexion.conexion();
        try {            
            psInsertLineaPedido = cn.prepareStatement(insertLineaPedido);            
        } catch (SQLException ex) {
            System.err.println("GestionPedidos insertLineaPedido");
        }
        Conexion.devolverConexion(cn);
    }
    
    public static void guardaLineaPedido(LineaPedido l){
        //System.out.print(l);
        try {
            System.out.print(psInsertLineaPedido);
            psInsertLineaPedido.setInt(1, l.getId());
            psInsertLineaPedido.setInt(2, l.getCantidad());
            psInsertLineaPedido.setInt(3, l.getPedido().getId());
            psInsertLineaPedido.setInt(4, l.getItem().getId());
            
            psInsertLineaPedido.executeUpdate();
        } catch (SQLException ex) {
            System.err.println("GestionPedidos.guardaLineaPedido(LineaPedido l)");
        }
        return;
    }
    
    public static Map<Integer, Pedido> todosPedidos(Cliente c){
        
        Connection cn = Conexion.conexion();
        Map<Integer, Pedido> pedidos = new HashMap<>();
        try {
            Statement st = cn.createStatement();
            String sql = "SELECT id, total, fecha "
                        + "FROM pedidos "
                        + "WHERE idcliente="+c.getId();
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
                HashSet<LineaPedido> lineas = new HashSet<>();
                
                String consulta = "SELECT id, cantidad, iditem "
                                + "FROM lineaspedido WHERE idpedido="+rs.getInt("id");
                
                Statement stat = cn.createStatement();
                ResultSet result = stat.executeQuery(consulta);
                while(result.next()){
                    LineaPedido lp = new LineaPedido(result.getInt("id"), result.getInt("cantidad"), null, GestionPedidos.buscaItemPoirId(result.getInt("iditem")));
                    lineas.add(lp);
                }
                
                Pedido p = new Pedido(rs.getInt("id"), rs.getDouble("total"), rs.getDate("fecha"), c.getId(), lineas);
                
                for (Iterator<LineaPedido> iterator = lineas.iterator(); iterator.hasNext();) {
                    LineaPedido linea = iterator.next();
                    linea.setPedido(p);
                }
                pedidos.put(p.getId(), p);
                
            }
        } catch (SQLException ex) {
            System.err.println("GestionPedidos.todosItems()->"+ex);
        } 
        
        
        Conexion.devolverConexion(cn);
        //System.out.println(items);
        return pedidos; 
    }
}
