package dao;

import beans.Bus;
import beans.Ruta;
import conex.BDConex;
import java.beans.Statement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Timestamp;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class DaoBuses {

    public static ArrayList<Ruta> getRutas(){
        ArrayList<Ruta> rutas = new ArrayList<>();
        String sql = "select Id_Ruta, CiudadOrigen, CiudadDestino, HoraSalida, HoraLlegada, tarifa, id_placa from rutas";
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();
            ResultSet rs = st.executeQuery(sql);){
            
            while(rs.next()){
                java.util.Date fechaSalida = new java.util.Date(new Timestamp(rs.getTimestamp("horasalida").getTime()).getTime());
                java.util.Date fechaLlegada = new java.util.Date(new Timestamp(rs.getTimestamp("horallegada").getTime()).getTime());

                Ruta r = new Ruta(rs.getInt("id_ruta"),rs.getString("ciudadOrigen"),rs.getString("ciudadDestino"),fechaSalida,fechaLlegada,rs.getFloat("tarifa"),rs.getString("id_placa"));
                rutas.add(r);
            }
            
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.getRutas()"+e.getMessage());
        }
        return rutas;
    }
    
    public static HashMap<Integer, String> getReservasRuta(int id_ruta){
        
        HashMap<Integer, String> reservas = new HashMap<>();
        String sql = "SELECT reservas.Id_Ticket, reservas.NumAsiento, clientes.Nombre "
                + "FROM reservas, clientes "
                + "WHERE reservas.Id_DNI = clientes.Id_DNI "
                + "AND reservas.Id_Ruta = "+id_ruta;
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();
            ResultSet rs = st.executeQuery(sql);){
            
            while(rs.next()){
                reservas.put(rs.getInt("NumAsiento"), rs.getString("Nombre"));
            }
            
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.getReservasRuta()");
        }
                
        return reservas;
    }
    
    public static int getCapacidadBus(String id_placa){
        String sql = "SELECT capacidad FROM buses WHERE id_placa = '"+id_placa+"'";
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();
            ResultSet rs = st.executeQuery(sql);){
            rs.next();
            return rs.getInt("capacidad");
        }catch (SQLException e){
            System.err.println("dao.DaoBuses.getCapacidadBus()");
        }
        return -1;
    }
    
    public static void insertReservas(int numAsiento, String dni, int id_ruta){
        System.out.println("llega a insert"+numAsiento+" "+dni+" "+id_ruta);
        String sql = "INSERT INTO reservas (Pagado, NumAsiento, Id_DNI, Id_Ruta) VALUES ('0', "+numAsiento+", '"+dni+"', "+id_ruta+")";
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();){
            st.executeUpdate(sql);
        }catch (SQLException e){
            System.err.println("dao.DaoBuses.insertReservas()"+e.getMessage());
        }        
    }
    
}
