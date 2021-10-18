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

public class DaoBuses {

    public static ArrayList<Bus> getBuses(){
        ArrayList<Bus> buses = new ArrayList<>();
        String sql = "select id_placa, capacidad from buses";
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();
            ResultSet rs = st.executeQuery(sql);){
            
            while(rs.next()){
                Bus bus = new Bus(rs.getString("id_placa"), rs.getInt("capacidad"));
                buses.add(bus);
            }
            
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.getBuses()"+e.getMessage());
        }
        
        return buses;
    }
    
    public static ArrayList<Ruta> getRutasBus(String id_placa){
        ArrayList<Ruta> rutas = new ArrayList<>();
        String sql = "select Id_Ruta, CiudadOrigen, CiudadDestino, HoraSalida, HoraLlegada, Tarifa from rutas where id_placa = '"+id_placa+"'";
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();
            ResultSet rs = st.executeQuery(sql);){
            
            while(rs.next()){
                java.util.Date fechaSalida = new java.util.Date(new Timestamp(rs.getTimestamp("horasalida").getTime()).getTime());
                java.util.Date fechaLlegada = new java.util.Date(new Timestamp(rs.getTimestamp("horallegada").getTime()).getTime());

                Ruta r = new Ruta(rs.getInt("id_ruta"), rs.getString("ciudadOrigen"), rs.getString("ciudadDestino"), fechaSalida,  fechaLlegada, rs.getFloat("tarifa"), id_placa);
                rutas.add(r);
            }
            
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.getBuses()"+e.getMessage());
        }
        return rutas;
    }
    
    public static void setTarifa(Ruta ruta){
        String sql = "UPDATE rutas SET Tarifa = "+ruta.getTarifa()+" WHERE rutas.Id_Ruta = '"+ruta.getId_ruta()+"'";
        System.out.println(sql);
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();){
            st.executeUpdate(sql);
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.getBuses()"+e.getMessage());
        }
    }
}
