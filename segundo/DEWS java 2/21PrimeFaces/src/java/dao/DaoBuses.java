package dao;

import beans.Bus;
import beans.Ruta;
import conex.BDConex;
import java.beans.Statement;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Timestamp;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.Map;

public class DaoBuses {

    public static ArrayList<Ruta> getRutas(Date d1, Date d2){
        ArrayList<Ruta> rutas = new ArrayList<>();
        SimpleDateFormat formateador= new SimpleDateFormat("yyyy-MM-dd");
        String f1=formateador.format(d1);
        
        String f2=formateador.format(d2);
        
        String sql= "SELECT Id_Ruta, CiudadOrigen, CiudadDestino, HoraSalida, HoraLlegada, Tarifa, Id_Placa FROM rutas where HoraSalida BETWEEN '"+f1+"' and '"+f2+"' ";

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
    
    public static void actualizarRutas(ArrayList<Ruta> rutas){
        
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();){
            for (Ruta ruta : rutas) {
                SimpleDateFormat formateador= new SimpleDateFormat("yyyy-MM-dd");
                String hs=formateador.format(ruta.getHoraSalida());
                String hl=formateador.format(ruta.getHoraLlegada());
                
                String sql= "update rutas set tarifa="+ruta.getTarifa()+", CiudadOrigen='"+ruta.getCiudadOrigen()+"',CiudadDestino='"+ruta.getCiudadDestino()+"',HoraSalida='"+hs+"', HoraLlegada='"+hl+"' where id_ruta="+ruta.getId_ruta();
                st.executeUpdate(sql);
            }
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.actualizarRutas()"+e.getMessage());
        }
    }
    
    public static ArrayList<String> clientesDeRuta(int id_ruta){
        ArrayList<String> reservados= new ArrayList<>();
        
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();){
            String sql="SELECT Id_DNI FROM reservas WHERE Id_Ruta="+id_ruta+"";
            ResultSet rs = st.executeQuery(sql);
            while (rs.next()){                
                String cliente=rs.getString("Id_DNI");
                reservados.add(cliente);
            }
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.clientesDeRuta()"+e.getMessage());
        }
         
        return reservados;
    } 
    
    public static void avisar(ArrayList<String> avisos,int id_ruta){
        try(Connection cn = (Connection) BDConex.ds.getConnection();
            java.sql.Statement st = cn.createStatement();){
            for (String aviso : avisos) {
                SimpleDateFormat formateador= new SimpleDateFormat("yyyy-MM-dd");
                java.util.Date currdate = new Date();
                String fecha=formateador.format(currdate);
                
                String sql="INSERT INTO avisos(id_ruta, dni, fecha_aviso) VALUES ("+id_ruta+", '"+aviso+"', '"+fecha+"')";
                
                st.executeUpdate(sql);
            }
        }catch(SQLException e){
            System.err.println("dao.DaoBuses.avisar()"+e.getMessage());
        }
    }
}
