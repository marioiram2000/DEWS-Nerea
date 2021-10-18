package dao;

import conex.BDConex;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class KeysDAO {

    public static int siguienteId(String tabla){
        String sql = "SELECT MAX(id) as maxid from "+tabla;
        
        try(Connection cn = (Connection) BDConex.ds.getConnection(); Statement st = cn.createStatement();){
            ResultSet rs = st.executeQuery(sql);
            rs.next();
            return rs.getInt("maxid")+1;
        }catch(SQLException e){
            System.err.println("dao.KeysDAO.siguienteId() "+e.getMessage());
        }
        return -1;
    }    

}
