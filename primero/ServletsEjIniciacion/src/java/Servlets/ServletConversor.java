
package Servlets;

import beans.ConversionCF;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashSet;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletConversor extends HttpServlet {

    private HashSet<String> paises;
    
    @Override
    public void init() throws ServletException {
        super.init(); //To change body of generated methods, choose Tools | Templates.
        paises = new HashSet<String>();
    } 

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {        
        //System.out.print(request.getLocale().getCountry());//es_ES//en_GB
        paises.add(request.getLocale().getCountry());
        
        ConversionCF t = null;
        
        if(request.getParameter("cf")!=null){     
            if(request.getParameter("c")==""){
               response.setContentType("text/html;charset=UTF-8");
                try (PrintWriter out = response.getWriter()) {
                    /* TODO output your page here. You may use following sample code. */
                    out.println("<!DOCTYPE html>");
                    out.println("<html>");
                    out.println("<head>");
                    out.println("<title>Servlet ServletConversor</title>");            
                    out.println("</head>");
                    out.println("<body>");
                   out.println("<h2>Error: Debes indicar los grados</h2>");
                    out.println("<h2><a href='conversorCF.html'>Enlace para volver al formulario</a></h2>");
                    out.println("</body>");
                    out.println("</html>");
                }
            }else{
                try{
                    float c = Float.parseFloat(request.getParameter("c"));
                    t = new ConversionCF(c, 'c');             
                    
                }catch (NumberFormatException nfe) {
                    response.sendRedirect("conversorCF.html");
                }                
            }
        }else{
            if(request.getParameter("f")==""){
               response.setContentType("text/html;charset=UTF-8");
                try (PrintWriter out = response.getWriter()) {
                    /* TODO output your page here. You may use following sample code. */
                    out.println("<!DOCTYPE html>");
                    out.println("<html>");
                    out.println("<head>");
                    out.println("<title>Servlet ServletConversor</title>");            
                    out.println("</head>");
                    out.println("<body>");
                    out.println("<h2>Error: Debes indicar los grados</h2>");
                    out.println("<h2><a href='conversorCF.html'>Enlace para volver al formulario</a></h2>");
                    out.println("</body>");
                    out.println("</html>");
                }
            }else{
                try{
                    float f = Float.parseFloat(request.getParameter("f"));
                    t = new ConversionCF(f, 'f');                   
                }catch (NumberFormatException nfe) {
                    response.sendRedirect("conversorCF.html");
                }                
            }
        }
        if(t!=null){
            response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {
                /* TODO output your page here. You may use following sample code. */
                out.println("<!DOCTYPE html>");
                out.println("<html>");
                out.println("<head>");
                out.println("<title>Servlet ServletConversor</title>");            
                out.println("</head>");
                out.println("<body>");
                out.println("<h1>Resultado de la conversion:</h1>");
                out.println("<h2>Valor en celsius:"+t.getC()+"</h2>");
                out.println("<h2>Valor en faharenheit:"+t.getF()+"</h2>");
                out.println("<h2><a href='conversorCF.html'>Enlace para volver al formulario</a></h2>");
                out.println("<h3>Se han establecido conexiones desde "+paises.size()+" distintos locale´s</h3>");
                out.println("</body>");
                out.println("</html>");
            }
        }        
    }
    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {response.sendRedirect("index.html");}
}
