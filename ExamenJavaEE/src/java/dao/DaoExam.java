package dao;

import beans.Incidencia;
import beans.Item;
import beans.Pedido;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.Map;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

public class DaoExam {

    public static Connection dameConexion(){
        
        Connection cn=null;
        try {
            InitialContext ctx = new InitialContext();
            DataSource ds = (DataSource) ctx.lookup("jdbcTVExamen");            
            cn = ds.getConnection();
        } catch (NamingException ex) {
            Logger.getLogger(DaoExam.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SQLException ex) {
            Logger.getLogger(DaoExam.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        return cn;
    }
    
    public static void devuelveConexion(Connection cn){
        try {
            //Devuelve conexion al pool
            cn.close();
        } catch (SQLException ex) {
            Logger.getLogger(DaoExam.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    public static double[] preciosMinMax(){
        double[] precios = new double[2];
        Connection cn = dameConexion();
        try{
            Statement st = cn.createStatement();
            String sql = "SELECT min(precio) as minimo, max(precio) as maximo FROM items";
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                double min = rs.getDouble("minimo");
                double max = rs.getDouble("maximo");
                precios[0] = min;
                precios[1] = max;
            }
        }catch (SQLException ex) {
            System.err.println("DaoExam -> preciosMinMax ->"+ex);
        }
        
        devuelveConexion(cn);
        return precios;
    }
    
    
    
    private static String itemsPorPrecio = "SELECT id, nombre, precio "
                                        + "FROM items "
                                        + "WHERE (precio BETWEEN ? AND ?) "
                                        + "AND EXISTS "
                                            + "(SELECT iditem "
                                            + "FROM lineaspedido "
                                            + "where items.id = lineaspedido.iditem)";
    private static PreparedStatement psItemsPorPrecio;        
    static{
        Connection cn = dameConexion();
        try {            
            psItemsPorPrecio = cn.prepareStatement(itemsPorPrecio); 
        } catch (SQLException ex) {
            System.err.println("Dao psItemsPorPrecio");
        }
        devuelveConexion(cn);
    }

    public static HashSet itemsPorPrecio(double min, double max){
        HashSet items = new HashSet();       
        try{
            psItemsPorPrecio.setDouble(1, min);
            psItemsPorPrecio.setDouble(2, max);
            
            ResultSet rs = psItemsPorPrecio.executeQuery();
            while(rs.next()){
                int idItem = rs.getInt("id");
                String nombreItem = rs.getString("nombre");
                double precio = rs.getDouble("precio");
                
                Item it = new Item(idItem, nombreItem, precio, null);
                items.add(it);
            }
        }catch (SQLException ex) {
            System.err.println("DaoExam -> itemsPorPrecio ->"+ex);
        }
        HashSet itemsfinal = new HashSet();       
        for (Iterator iterator = items.iterator(); iterator.hasNext();) {
            Item item = (Item)iterator.next();
            ArrayList<String> compradores = compradoresItem(item.getId());
            System.out.println("------------------------"+compradores);
            item.setCompradoresItem(compradores);
            itemsfinal.add(item);
        }
        return itemsfinal;
    }
    
    private static String compradoresItem = "SELECT nombre FROM clientes WHERE EXISTS (SELECT id from pedidos WHERE clientes.id = pedidos.idcliente and EXISTS ( SELECT id from lineaspedido WHERE pedidos.id = lineaspedido.idpedido AND EXISTS ( SELECT id from items where lineaspedido.iditem = items.id and items.id = ?)))";
    private static PreparedStatement psCompradoresItem;    
    static{
        Connection cn = dameConexion();
        try {            
            psCompradoresItem = cn.prepareStatement(compradoresItem);
        } catch (SQLException ex) {
            System.err.println("Dao psCompradoresItem");
        }
        devuelveConexion(cn);
    }
    
    private static ArrayList<String> compradoresItem(int idItem){
        ArrayList<String> compradores = new ArrayList<>();
        try{
            psCompradoresItem.setInt(1, idItem);
            ResultSet rs2 = psCompradoresItem.executeQuery();
            while(rs2.next()){
                String nombre = rs2.getString("nombre");
                compradores.add(nombre);
            }
        }catch (SQLException ex) {
            System.err.println("DaoExam -> compradoresItem ->"+ex);
        }
        return compradores;
    }
    
    public static LinkedHashMap mapaPedidos(){
        LinkedHashMap<Pedido, ArrayList<Incidencia>> mapa = new LinkedHashMap<>();
        
        Connection cn = dameConexion();
        try{
            Statement st = cn.createStatement();
            String sql = "SELECT id, total, fecha FROM pedidos";
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
                Pedido p = new Pedido(rs.getInt("id"), rs.getDouble("total"), rs.getDate("fecha"));
                
                mapa.put(p, null);
            }
        }catch (SQLException ex) {
            System.err.println("DaoExam -> mapaPedidos ->"+ex);
        }
        for (Map.Entry<Pedido, ArrayList<Incidencia>> entry : mapa.entrySet()) {
            Pedido pedido = entry.getKey();
            ArrayList<Incidencia> incidencias = sacarIncidenciasPedido(cn, pedido.getId());
            entry.setValue(incidencias);
        }
        devuelveConexion(cn);        
        return mapa;
    }   
        
    private static ArrayList<Incidencia> sacarIncidenciasPedido(Connection cn, int idPedido){
        ArrayList<Incidencia> incidencias = new ArrayList<Incidencia>();
        try{
            Statement st = cn.createStatement();
            String sql = "SELECT idincidencia, descripcion, fecha FROM incidencias WHERE idpedido = "+idPedido;
            ResultSet rs = st.executeQuery(sql);
            while(rs.next()){
                Incidencia i = new Incidencia(rs.getInt("idincidencia"), rs.getString("descripcion"), idPedido, rs.getDate("fecha"));
                incidencias.add(i);
            }
        }catch (SQLException ex) {
            System.err.println("DaoExam -> sacarIncidenciasPedido ->"+ex);
        }       
        
        return incidencias;
    }
    
    private static String grabarIncidencia = "INSERT INTO incidencias (descripcion, idpedido, fecha) VALUES (?, ?, ?);";
    private static String consultaCondiciones = "SELECT idincidencia FROM `incidencias` A WHERE descripcion = ? OR '5'<( SELECT COUNT(idincidencia) FROM incidencias B WHERE A.idpedido = B.idpedido AND A.fecha = B.fecha AND idincidencia = ?)";
    
    private static PreparedStatement psGrabarIncidencia;    
    private static PreparedStatement psCondiciones;    
    
    static{
        Connection cn = dameConexion();
        try {            
            psGrabarIncidencia = cn.prepareStatement(grabarIncidencia); 
            psCondiciones = cn.prepareStatement(consultaCondiciones); 
        } catch (SQLException ex) {
            System.err.println("GestionPedidos psInsertPedido");
        }
        devuelveConexion(cn);
    }
    public boolean grabarIncidencia(Incidencia i){
        ArrayList<String> compradores = new ArrayList<>();
        try{
            psCondiciones.setString(1, i.getDescripcion());
            psCondiciones.setInt(2, i.getId());
            ResultSet rs = psCondiciones.executeQuery();
            if(!rs.next()){
                psCompradoresItem.setString(1, i.getDescripcion());
                psCompradoresItem.setInt(2, i.getIdPedido());
                psCompradoresItem.setDate(3, i.getFecha());

                int r = psItemsPorPrecio.executeUpdate();
                if(r>0){
                    return true;
                }
            }           
            
        }catch (SQLException ex) {
            System.err.println("DaoExam -> compradoresItem ->"+ex);
        }        
        return false;
    }
    
    public void eliminarIncidencias(){
        
    }
    
}
