package Servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletIntroCeldas extends HttpServlet {

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        if(request.getParameter("filas").equals("") || request.getParameter("columnas").equals("")){
            response.sendRedirect("indexEj3.html");
        }else{
            int filas = Integer.parseInt(request.getParameter("filas"));
            int columnas = Integer.parseInt(request.getParameter("columnas"));
            String fondo = "none";
            if(request.getParameter("gris")!=null){
                fondo = "grey";
            }
            response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {
                out.println("<!DOCTYPE html>");
                out.println("<html>");
                out.println("<head>");
                out.println("<title>Servlet ServletIntroCeldas</title>");            
                out.println("</head>");
                out.println("<body>");
                out.println("<h1>INTRODUCE VALORES:</h1>");
                out.println("<form action='ServletGuardaMatriz' method='post'><table>");
                out.println("<input type='hidden' name='filas' value='"+filas+"'/>");   
                out.println("<input type='hidden' name='columnas' value='"+columnas+"'/>");   
                for (int i = 0; i < filas; i++) {
                    out.println("<tr>");
                    for (int j = 0; j < columnas; j++) {
                        out.println("<td style='border: 3px solid black;'><input type='text' name='"+i+"_"+j+"' style='background-color: "+fondo+";'/></td>");
                        //System.out.print(i+"_"+j);
                    }
                    out.println("</tr>");
                }
                out.println("</table>");   
                out.println("<input type='submit' name='submit' value='Guardar matriz'/>");   
                out.println("<input type='reset' name='reset' value='Restablecer'/>");   
                out.println("</form>");   
                out.println("</body>");
                out.println("</html>");
            }
        }
        
    }
}
