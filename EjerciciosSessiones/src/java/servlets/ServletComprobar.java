package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletComprobar extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        System.out.print("LLEGA AL doGet");
        HttpSession ses = request.getSession(true);
        
        String i = request.getParameter("letra");
        if(i!=null){
            int vidas = (int)ses.getAttribute("vidas");
            if(vidas<=1){
                request.setAttribute("perdido", true);
                
            }else{
                vidas--;
                ses.setAttribute("vidas", vidas);
                
                boolean[] letras = (boolean[])ses.getAttribute("letras");
                letras[Integer.parseInt(i)] = true;
            }     
        }
        request.getRequestDispatcher("ServletJuego").forward(request, response);   
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        HttpSession ses = request.getSession(true);
        String respuesta = (String)request.getParameter("respuesta");
        String palabra = (String)ses.getAttribute("palabra");
        
        if(respuesta.equals(palabra)){
            request.setAttribute("acierto", true);
        }else{
            int vidas = (int)ses.getAttribute("vidas");
            if(vidas<=1){
                request.setAttribute("perdido", true);
            }else{
                vidas--;
            }            
            ses.setAttribute("vidas", vidas);
        }
        request.getRequestDispatcher("ServletJuego").forward(request, response);   
    }
}
