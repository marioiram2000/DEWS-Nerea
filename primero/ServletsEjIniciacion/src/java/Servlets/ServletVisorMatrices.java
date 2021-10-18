package Servlets;

import beans.AlmacenMatrices;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Iterator;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletVisorMatrices extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        ArrayList<Integer[][]> matrices = AlmacenMatrices.getMatrices();
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletVisorMatrices</title>");            
            out.println("</head>");
            out.println("<body>");
            for (Iterator<Integer[][]> iterator = matrices.iterator(); iterator.hasNext();) {
                Integer[][] matriz = iterator.next();
                out.println("<h1>Matriz</h1>");
                out.println("<table>");
                for (int i = 0; i < matriz.length; i++) {
                    out.println("<tr>");
                    for (int j = 0; j < matriz[i].length; j++) {
                        out.println("<td style='border: 3px solid black;'>"+matriz[i][j]+"</td>");
                    }
                    out.println("</tr>");
                }
                out.println("</table>");
                out.println("<br>");
            }
            
            out.println("</body>");
            out.println("</html>");
        }
    }

    
}
