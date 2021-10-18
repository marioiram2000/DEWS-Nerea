/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Date;
import java.util.HashMap;
import java.util.Iterator;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

/**
 *
 * @author pei4
 */
public class ServletPrincipal extends HttpServlet {

    
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletPrincipal</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet ServletPrincipal at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

   
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
       
        HttpSession session = request.getSession();
        String usuario=(String)session.getAttribute("usuario");
        
        if (usuario==null){
            response.sendRedirect("index.html");
        }
        else{      
            
            long t1=session.getCreationTime();
            long t2=session.getLastAccessedTime();
            Date d=new Date(t2-t1);
            String strTiempoConex="Conectado durante " + d.getSeconds();            
            
            
            response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletPrincipal</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Bienvenido " + usuario + "</h1>");
            out.println("<h1>" + strTiempoConex + "</h1>");
            
            HashMap<String,Integer> mapa=
                    ( HashMap<String,Integer>)
                    this.getServletContext().getAttribute("mapa_logins");
            
            out.println("<ul>");
            Iterator it=mapa.keySet().iterator();
            while (it.hasNext()){
               String cada_usuario=(String)it.next();
               int logins_cada_usuario=mapa.get(cada_usuario);
               out.println("<li>" + cada_usuario + ":" + logins_cada_usuario + " logins</li>"); 
            }
            out.println("</ul>");
            
            out.println("</body>");
            out.println("</html>");
        }
        }
    }

    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    

}
