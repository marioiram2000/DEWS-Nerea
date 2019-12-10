/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import beans.Lenguaje;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectOutputStream;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletFichero extends HttpServlet {

   
    private void dibujaFormCuantos(HttpServletRequest request, PrintWriter out)
            throws ServletException, IOException {
       
            out.println("<form method='post' action='"+request.getRequestURI()+"'>");
            out.println("Cuántos Lenguajes configurar?<input type='text' name='cuantos' />");
            out.println("<input type='submit' name='submit_cuantos' value='Enviar' />");
            out.println("</form>");          
    }

    private void dibujaFormLP(HttpServletRequest request, PrintWriter out)
            throws ServletException, IOException {
       
            out.println("<form method='post' action='"+request.getRequestURI()+"'>");            
            int n=Integer.parseInt(request.getParameter("cuantos"));
            
            for (int cont=1; cont<=n ; cont++){
                 out.println("<p>Lenguaje " + cont + ": <input type='text' name='lenguaje' /></p>");
            }          
            
            out.println("<input type='submit' name='submit_crear' value='GUARDAR FICHERO' />");
            out.println("</form>");          
    }
    
    private void creaFichLenguajes(String[] lenguajes){
        
        ObjectOutputStream oos=null;
        try {
            String ruta_fich=this.getServletContext().getRealPath("lenguajes.obj");
            oos = new ObjectOutputStream(
                    new FileOutputStream(ruta_fich));
            
            for (String lenguaje: lenguajes)
                oos.writeObject(new Lenguaje(lenguaje, 3));
            oos.writeObject(null);
            
            
           
        } catch (IOException ex) {
            Logger.getLogger(ServletFichero.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            try {
                oos.close();
            } catch (IOException ex) {
                Logger.getLogger(ServletFichero.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        
    }
    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
       
        
         response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletFichero</title>");            
            out.println("</head>");
            out.println("<body>");
            
            dibujaFormCuantos(request,out);
            
          
            
            out.println("</body>");
            out.println("</html>");
        }
        
    }

   
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        if (request.getParameter("submit_cuantos")!=null){         
            
            try{
                Integer.parseInt(request.getParameter("cuantos"));
            }
            catch (NumberFormatException e){
                request.setAttribute("error", "Nº lenguajes debe ser numérico");
                request.getRequestDispatcher(".0."
                        + ""
                        + ""
                        + "").forward(request, response);
            }
            
              response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletFichero</title>");            
            out.println("</head>");
            out.println("<body>");
            
            
            
            dibujaFormCuantos(request,out);            
            dibujaFormLP(request,out);
            
            out.println("</body>");
            out.println("</html>");
        }
        }
        
        
        
        if (request.getParameter("submit_crear")!=null){
            
            String[] lenguajes=request.getParameterValues("lenguaje");
            this.creaFichLenguajes(lenguajes);
            
              response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletFichero</title>");            
            out.println("</head>");
            out.println("<body>");   
            
            out.println("<p>Fichero creado con los "
                    + " lenguajes de programación</p>");   
            
            out.println("</body>");
            out.println("</html>");
        }
       
    }

    }

}
