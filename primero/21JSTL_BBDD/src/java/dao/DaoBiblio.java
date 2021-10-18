
package dao;


import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.logging.Level;
import java.util.logging.Logger;


public class DaoBiblio {
    
    
    
    private static final String DRIVER="com.mysql.jdbc.Driver";
    private static final String URL="jdbc:mysql://localhost/bdbiblioteca";
    private static final String USER="root";
    private static final String PASS="";
    
    
    private Connection cn;
    
    
    public DaoBiblio(){
        
        try {
            Class.forName(DRIVER);
            cn=DriverManager.getConnection(URL, USER, PASS);
        } catch (ClassNotFoundException ex) {
            System.err.println("DRIVER mysql no existe");
        } catch (SQLException ex) {
            System.err.println("conexion a " + URL + " falla");    
        }
    }
    
    
    
    public ArrayList<String> titulos(){
        ArrayList<String> titulos=new  ArrayList<String>();
        try {
            
            Statement st=cn.createStatement();
            String sql="select idlibro, titulo, paginas, genero from libros";
            ResultSet rs=st.executeQuery(sql);
            while (rs.next()){
                titulos.add(rs.getString("titulo"));                
            }
            rs.close();
            st.close();   
            
        } catch (SQLException ex) {
            System.err.println("en titulos:" +ex.getMessage() );
        }
        
        return titulos;
         
        
        
    }
    
}
