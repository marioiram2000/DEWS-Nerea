package dao;

import beans.Cliente;
import beans.Item;
import beans.LineaPedido;
import beans.Pedido;
import conex.BDConex;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.sql.Timestamp;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.management.j2ee.statistics.TimeStatistic;

public class PedidoDAO {

    static PreparedStatement psInsertPedido;
    static PreparedStatement psInsertLineaPedido;
    static PreparedStatement psEnviarPedido;
    static Connection cn ;
    
    static{
        try{
            cn = (Connection) BDConex.ds.getConnection();
            String sqlpsInsertPedido = "INSERT INTO pedidos (id, total, fecha, idcliente, estado) VALUES (?, ?, ?, ?, 'pedido');";
            psInsertPedido = cn.prepareStatement(sqlpsInsertPedido);
            
            String sqlpsInsertLineaPedido = "INSERT INTO lineaspedido (id, cantidad, idpedido, iditem) VALUES (?, ?, ?, ?);";
            psInsertLineaPedido = cn.prepareStatement(sqlpsInsertLineaPedido);
            
            String sqlpsEnviarPedido = "UPDATE pedidos SET estado = 'enviado' WHERE pedidos.id = ?";
            psEnviarPedido = cn.prepareStatement(sqlpsEnviarPedido);
            
        }catch(SQLException e){
            System.err.println("dao.PedidoDAO.bloqueEstático() "+e.getMessage());
        }
    }
    
    
    public static HashMap<Integer, Item> todosItems(){
        HashMap<Integer, Item> items = new HashMap<>();
        String sql = "SELECT id, nombre, precio FROM items";
        
        try(Connection cn = (Connection) BDConex.ds.getConnection(); Statement st = cn.createStatement();){
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
                Item i = new Item(rs.getInt("id"), rs.getString("nombre"), rs.getDouble("precio"));
                items.put(i.getId(), i);
            }
            rs.close();
            return items;
        }catch(SQLException e){
            System.err.println("dao.PedidoDAO.todosItems()");
        }
        return null;
    }
    
    public static Item buscaItemPorId(int iditem){
        String sql = "SELECT nombre, precio FROM items WHERE id = "+iditem;
        try(Connection cn = (Connection) BDConex.ds.getConnection(); Statement st = cn.createStatement();){
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                Item i = new Item(iditem, rs.getString("nombre"), rs.getDouble("precio"));
                return i;
            }            
        }catch(SQLException e){
            System.err.println("dao.KeysDAO.siguienteId() "+e.getMessage());
        }     
        return null;
    }
    
    public static int guardaPedido(Pedido p){
//INSERT INTO pedidos (id, total, fecha, idcliente) VALUES (?, '?', '?', '?');
        int id = KeysDAO.siguienteId("pedidos");
        //System.err.println("dao.PedidoDAO.guardaPedido() + id " + id);
                
        try {
            psInsertPedido.setInt(1, id);
            psInsertPedido.setDouble(2, p.getTotal());
            //psInsertPedido.setDate(3, new java.sql.Date(new java.util.Date().getTime())); //solo dia, mes, año     
            Timestamp tActual=new  Timestamp(p.getFecha().getTime());
            psInsertPedido.setTimestamp(3, tActual );
            psInsertPedido.setDouble(4, p.getCliente().getId());
            
            psInsertPedido.executeUpdate();
        } catch (SQLException ex) {
            System.err.println("dao.PedidoDAO.guardaPedido()"+ex.getMessage());
        }
        return id;
    }
    
    public static void guardaLineaPedido(LineaPedido l){
//INSERT INTO lineaspedido (id, cantidad, idpedido, iditem) VALUES (?, '?', '?', '?')
        int id = KeysDAO.siguienteId("lineaspedido");
        try{
            psInsertLineaPedido.setInt(1, id);
            psInsertLineaPedido.setDouble(2, l.getCantidad());
            psInsertLineaPedido.setInt(3, l.getPedido().getId());
            psInsertLineaPedido.setInt(4, l.getItem().getId());
            
            psInsertLineaPedido.executeUpdate();
        }catch(SQLException e){
            
            System.err.println("dao.PedidoDAO.guardaLineaPedido()"+ e.getMessage());
        }
    }
    
    public static HashSet<LineaPedido> getLineas(Pedido p){
        HashSet<LineaPedido> lineas = new HashSet<>();
        
        String sql = "SELECT id, cantidad, iditem FROM lineaspedido WHERE idpedido = "+p.getId();
        
        try(Connection cn = (Connection) BDConex.ds.getConnection();
                Statement st = cn.createStatement();
                ResultSet rs = st.executeQuery(sql);){
            
            while(rs.next()){
                LineaPedido l = new LineaPedido();
                l.setId(rs.getInt("id"));
                l.setCantidad(rs.getInt("cantidad"));
                l.setPedido(p);
                l.setItem(buscaItemPorId(rs.getInt("iditem")));
                lineas.add(l);
            }
            rs.close();
        }catch(SQLException e){
            System.err.println("dao.PedidoDAO.getLineas() "+e.getMessage());
        }
        
        return lineas;
    }
    
    public static HashMap<Integer, Pedido> getPedidosCliente(Cliente c){
        HashMap<Integer, Pedido> pedidos = new HashMap<>();
        
        
        String sql = "SELECT id, total, fecha FROM pedidos WHERE idcliente = "+c.getId();
        
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            Statement st = cn.createStatement();
            ResultSet rs = st.executeQuery(sql);){
            
            while(rs.next()){
                
                Pedido p = new Pedido();
                p.setId(rs.getInt("id"));
                p.setTotal(rs.getDouble("total"));
                p.setFecha(rs.getDate("fecha"));
                p.setCliente(c);
                p.setLineas(getLineas(p));
                pedidos.put(p.getId(), p);
            }
            rs.close();
        }catch(SQLException e){
            System.err.println("dao.PedidoDAO.getLineas()");
        }
        
        return pedidos;
    }
    
    public static void borrarPedido(int id){
        try(Connection cn = (Connection) BDConex.ds.getConnection();Statement st = cn.createStatement();){
            st.executeUpdate("DELETE FROM lineaspedido WHERE idpedido = "+id);
            st.executeUpdate("DELETE FROM pedidos WHERE id = "+id);
        }catch(SQLException e){
            System.err.println("dao.PedidoDAO.borrarPedido()");
        }
    }
    
    
    public static Pedido[][] getPedidosSemanaEstado(){
        Pedido[][] pedidos = new Pedido[3][];
        String[] aux = {"pedido", "enviado", "recibido"};
        
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            Statement st = cn.createStatement(); ){
            ResultSet rs = null;
            for (int i = 0; i < aux.length; i++) {
                String sql = "SELECT count(*) as cuantos FROM pedidos WHERE estado = '"+aux[i]+"' AND fecha between date_sub(now(),INTERVAL 1 WEEK) and now()";
                rs = st.executeQuery(sql);
                rs.next();
                pedidos[i] = new Pedido[rs.getInt("cuantos")];
                
                sql = "SELECT id, total, fecha, idcliente, estado FROM pedidos WHERE estado = '"+aux[i]+"' AND fecha between date_sub(now(),INTERVAL 1 WEEK) and now()";
                rs = st.executeQuery(sql);
                int cont = 0;
                while(rs.next()){
                    Pedido p = new Pedido();
                    p.setId(rs.getInt("id"));
                    p.setTotal(rs.getDouble("total"));
                    p.setFecha(rs.getDate("fecha"));
                    p.setLineas(getLineas(p));
                    p.setEstado(rs.getString("estado"));
                    p.setCliente(getCliente(rs.getInt("idcliente")));
                    pedidos[i][cont] = p;
                    cont ++;
                }
                
            }
            rs.close();
        }catch(SQLException e){
            System.err.println("dao.PedidoDAO.getPedidosSemanaEstado()"+e.getMessage());
        }
        
        return pedidos;
    }
    
    public static Cliente getCliente(int idCli){
        String sql = "SELECT nombre, password, domicilio, codigopostal, telefono, email FROM clientes WHERE id = "+idCli;
        try(Connection cn = (Connection) BDConex.ds.getConnection(); Statement st = cn.createStatement(); ResultSet rs = st.executeQuery(sql)){
            if(rs.next()){
                Cliente c = new Cliente(idCli, rs.getString("nombre"), rs.getString("password"), rs.getString("domicilio"), rs.getString("codigopostal"), rs.getString("telefono"), rs.getString("email"));
                return c;
            }            
        }catch(SQLException e){
            System.err.println("dao.KeysDAO.siguienteId() "+e.getMessage());
        }     
        return null;
    }
    
    public static void enviarPedido(int id){
        try {
            psEnviarPedido.setInt(1, id);
            psEnviarPedido.executeUpdate();
        } catch (SQLException ex) {
            System.err.println("dao.PedidoDAO.enviarPedido()");
        }
    }
    
    public static void recibirPedido(int id){
        String sql = "UPDATE pedidos SET estado = 'recibido' WHERE pedidos.id = "+id;
        try(Connection cn = (Connection) BDConex.ds.getConnection(); Statement st = cn.createStatement();){
            st.executeUpdate(sql);
        } catch (SQLException ex) {
            System.err.println("dao.PedidoDAO.recibirPedido()");
        }
    }
}