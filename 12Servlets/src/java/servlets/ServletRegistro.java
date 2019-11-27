/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;


public class ServletRegistro extends HttpServlet {

   private void dibujarHTML(String nombre, HttpServletResponse response) throws ServletException, IOException{
       response.setContentType("text/html;charset=UTF-8");
       try (PrintWriter out = response.getWriter()) {
        out.println("<!DOCTYPE html>");
        out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet ServletRegistro</title>");            
        out.println("</head>");
        out.println("<body>");
        out.println("<h1>Usuario "+nombre+" registrado</h1>");
        out.println("</body>");
        out.println("</html>");
       }
   }
   
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //Acceso ilegal
        response.sendRedirect("registro.html");
    }

   
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        if(request.getParameter("submit")==null){
            request.getRequestDispatcher("registro.html").forward(request, response);
        }else{
            String nombre = request.getParameter("nombre");
            String sexo = request.getParameter("sexo");
            String[] aficiones = request.getParameterValues("aficiones");            
            
            if(nombre.equals("") || sexo == null || aficiones == null){
                request.getRequestDispatcher("registro.html").forward(request, response);
            }else{
                aniadirUsuario(nombre, sexo, aficiones);
                dibujarHTML(nombre, response);
            }
            
        }
    }

    
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

    private void aniadirUsuario(String nombre, String sexo, String[] aficiones) {
       try {  
           String ruta = this.getServletContext().getRealPath("usuarios.txt");           
           PrintWriter pw = new PrintWriter(new FileWriter(ruta, true));
           
           String str = nombre+"\t"+sexo+"\t";
           for(String aficion:aficiones){
               str+=aficion+"\t";
           }
           pw.println(str);
           pw.close();
       } catch (IOException ex) {
           Logger.getLogger(ServletRegistro.class.getName()).log(Level.SEVERE, null, ex);
       }
    }

}
