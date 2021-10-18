package Servlets;

import beans.AlmacenMatrices;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletGuardaMatriz extends HttpServlet {

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        boolean todocorrecto=true;
        int filas = Integer.parseInt(request.getParameter("filas"));
        int columnas = Integer.parseInt(request.getParameter("columnas"));
        Integer[][] matriz = new Integer[filas][columnas];
        System.out.print(filas);
        System.out.print(columnas);        
        try {
            for (int i = 0; i < filas; i++) {
                for (int j = 0; j < columnas; j++) {
                    String nombre = i+"_"+j;                    
                    matriz[i][j]=Integer.parseInt(request.getParameter(nombre));
                }
            }
            AlmacenMatrices.meterMatriz(matriz);
        }
        catch (NumberFormatException  e){
            todocorrecto=false;
        }
        catch (NullPointerException  e){
            todocorrecto=false;
        }
        if(todocorrecto){
            response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {
                /* TODO output your page here. You may use following sample code. */
                out.println("<!DOCTYPE html>");
                out.println("<html>");
                out.println("<head>");
                out.println("<title>Servlet ServletGuardaMatriz</title>");            
                out.println("</head>");
                out.println("<body>");
                out.println("<h1>Tu matriz de "+filas+"x"+columnas+" ha sido guardada</h1>");
                out.println("<h1>Hay un total de "+AlmacenMatrices.getMatrices().size()+" matrices</h1>");
                out.println("<h1><a href='indexEj3.html'>Introducir otra matriz</a></h1>");
                out.println("<h1><a href='ServletVisorMatrices'>Ver matrices</a></h1>");
                out.println("</body>");
                out.println("</html>");
            }
        }else{
            request.getRequestDispatcher("ServletIntroCeldas").forward(request, response);
        }
        
        
    }
}
