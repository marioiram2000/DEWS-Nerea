/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import beans.Lenguaje;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.PrintWriter;
import java.util.HashSet;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class ServletUsuario extends HttpServlet {

 

        
    
    
    @Override
    public void init(ServletConfig config) throws ServletException {
        
        
        super.init(config);
        System.out.println("En init");
        ObjectInputStream ois=null;
        try {
           
            ois = new ObjectInputStream(
                    new FileInputStream(this.getServletContext().getRealPath("lenguajes.obj")));
            
            LinkedHashMap<Lenguaje,Integer> mapaL=new LinkedHashMap<Lenguaje,Integer>();
            
            Lenguaje l=(Lenguaje)ois.readObject();
            while (l!=null){
                System.out.println("Lenguaje leido " + l.getNombre());
                mapaL.put(l,0);
                l=(Lenguaje)ois.readObject();
            }
            ois.close();
             System.out.println("Atributo guardado");
            this.getServletContext().setAttribute("mapaL", mapaL);
          
        } catch (IOException ex) {
            Logger.getLogger(ServletUsuario.class.getName()).log(Level.SEVERE, null, ex);
        } catch (ClassNotFoundException ex) {
            Logger.getLogger(ServletUsuario.class.getName()).log(Level.SEVERE, null, ex);
        } finally {
            try {
                if (ois!=null)
                    ois.close();
            } catch (IOException ex) {
                Logger.getLogger(ServletUsuario.class.getName()).log(Level.SEVERE, null, ex);
            }
        }
        
                
        
    }

    
    
   
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletUsuario</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet ServletUsuario at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

   
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
         LinkedHashMap<Lenguaje,Integer> mapaL=
            (LinkedHashMap<Lenguaje,Integer>)
                    this.getServletContext().getAttribute("mapaL");
        
        
        
        //Crear set en sesion si no existia
        HttpSession session=request.getSession();
        if (session.getAttribute("set_lenguajes")==null){
            session.setAttribute("set_lenguajes", new HashSet<Lenguaje>());
        }
        //Recuperar en var.simple set de sesion
        HashSet<Lenguaje> set=(HashSet<Lenguaje>)session.getAttribute("set_lenguajes");
        
        //Si nos llega leng por get, añadirlo a set de sesión
        if (request.getParameter("conocido")!=null){
            Lenguaje lenguaje=new Lenguaje(request.getParameter("leng"),0);
            set.add(lenguaje);           
            Integer cant=(Integer)mapaL.get(lenguaje);
             mapaL.replace(lenguaje,cant+1);           
            
        }
        
        if (request.getParameter("desconocido")!=null){
            Lenguaje lenguaje=new Lenguaje(request.getParameter("leng"),0);
            set.remove(lenguaje);
            Integer cant=(Integer)mapaL.get(lenguaje);
            mapaL.replace(lenguaje,cant-1);     
        }
        
        
        
         response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletUsuario</title>");            
            out.println("</head>");
            out.println("<body>");
            
            out.println("<table>");
            Iterator it=mapaL.keySet().iterator();
            while (it.hasNext()){
                Lenguaje l=(Lenguaje)it.next();                
                out.println("<tr>");
                out.println("<td>"+l.getNombre()+ "</td>");
                out.println("<td>"+l.getDificultad()+ "</td>");
                
                
                String enlace=request.getRequestURI()+ "?leng="+l.getNombre()+"&conocido";
                String texto="CONOCIDO";
                if (set.contains(l)){
                    enlace=request.getRequestURI()+ "?leng="+l.getNombre()+"&desconocido";
                    texto="DESCONOCIDO";
                }               
                out.println("<td><a href='"+enlace+"'>"+texto+"</a>");    
                
                
                out.println("</tr>");                
            }
            
            
            out.println("</table>");
            out.println("</body>");
            out.println("</html>");
        }
        
        
        
        
    }

   
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
       
    }

    @Override
    public void destroy() {
        super.destroy(); //To change body of generated methods, choose Tools | Templates.
        
        LinkedHashMap<Lenguaje,Integer> mapaL=
            (LinkedHashMap<Lenguaje,Integer>)
                    this.getServletContext().getAttribute("mapaL");
        System.out.print(mapaL);
    }
    
    
    

    
}
