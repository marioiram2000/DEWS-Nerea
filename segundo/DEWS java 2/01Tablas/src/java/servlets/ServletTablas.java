package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletConfig;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletTablas extends HttpServlet {

    private int cuantasTablas;

    @Override
    public void init(ServletConfig config) throws ServletException {
        super.init(config);
        cuantasTablas = 0;
        System.err.println("El metodo init, cuantasTablas=0");
    }

    private static void verTablaNum(int num, PrintWriter out){
        for (int i = 0; i < 10; i++) {
            out.print("<p>"+num+"x"+i+"="+(num*i)+"</p>");
        }
        
    }
    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletTablas</title>");            
            out.println("</head>");
            out.println("<body>");
            for (int cont = 0; cont <= 10; cont++) {
                out.println("<p><a href='ServletTablas?num="+cont+"'>Tabla del "+ cont+"</a></p>");
            }
            
            if( request.getParameter("num")!=null){
                cuantasTablas ++;
                int num=Integer.parseInt(request.getParameter("num"));
                verTablaNum(num, out);
            }
            out.println("<p>Se han mostrado "+cuantasTablas+" tablas</p>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendError(403);
    }

}
