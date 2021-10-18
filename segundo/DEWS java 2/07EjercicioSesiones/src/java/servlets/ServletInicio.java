package servlets;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletInicio extends HttpServlet {

    
    
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        ArrayList<String> productos = new ArrayList<>();
        try {
            BufferedReader br = new BufferedReader(new FileReader(getServletContext().getRealPath("productos.txt")));
            String linea = br.readLine();
            
            while(linea!=null){
                productos.add(linea);
                linea = br.readLine();
            }
            
            this.getServletContext().setAttribute("productos", productos);
            br.close();
        } catch (FileNotFoundException ex) {
            Logger.getLogger(ServletInicio.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(ServletInicio.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        response.sendRedirect("ServletCompra");
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    }
}
