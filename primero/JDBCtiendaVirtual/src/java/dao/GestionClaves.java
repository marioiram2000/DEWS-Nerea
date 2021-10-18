package dao;

import conex.Conexion;
import java.sql.Connection;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;

public class GestionClaves {
    
    public static int siguienteId(Connection cn, String tabla){
        try {
            int id = 1;
            Statement st = cn.createStatement();
            String sql = "select max(id) as 'idmax' from "+tabla+"";
            ResultSet rs = st.executeQuery(sql);
            if(rs.next()){
                Integer resul = rs.getInt("idmax");
                if(resul!=null){
                    id = resul +1;
                }
            }           
            return id;
        } catch (SQLException ex) {
            System.err.println("Gestion claves -> siguienteID");
        }
        return -1;
    }
}
