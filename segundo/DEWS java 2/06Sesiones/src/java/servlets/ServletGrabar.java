
package servlets;

import beans.Comida;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectOutput;
import java.io.ObjectOutputStream;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletGrabar extends HttpServlet {

    private boolean crearFichComidas(String[] nombres, int[] precios){
        ObjectOutputStream oos = null;
        try {
            String nomFich = this.getServletContext().getInitParameter("ficherocomidas");
            String url = this.getServletContext().getRealPath(nomFich);
            oos = new ObjectOutputStream(new FileOutputStream(url));
            for (int i = 0; i < nombres.length; i++) {
                String nombre = nombres[i];
                int precio = precios[i];
                Comida comida = new Comida(nombre, precio);
                oos.writeObject(comida);
                
            }
            
            
        } catch (FileNotFoundException ex) {
            Logger.getLogger(ServletGrabar.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IOException ex) {
            Logger.getLogger(ServletGrabar.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            try {
                oos.close();
            } catch (IOException ex) {
                Logger.getLogger(ServletGrabar.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        return true;
           
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitGrabar")==null){
            response.sendError(403);
        }else{
            String[] nombres = request.getParameterValues("nombres");
            String[] strPrecios = request.getParameterValues("precios");
            int[] precios = new int[strPrecios.length];
            for (int i = 0; i < strPrecios.length; i++) {
                try{
                    precios[i] = Integer.parseInt(strPrecios[i]);
                }catch(NumberFormatException e){
                    precios[i] = 0;
                }
            }
            if(crearFichComidas(nombres,precios)){
                escribir(request, response, "Fichero creado");
            }else{
                escribir(request, response, "Fichero NO creado");
            }
        }
    }
    
    private void escribir(HttpServletRequest request, HttpServletResponse response, String texto) throws IOException{
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {

            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet Servletform</title>");  
            out.println("</head>");
            out.println("<body>");
            out.println("<p>"+texto+"</p>");
            out.println("</body>");
            out.println("</html>");
        }
    }
}