package servlets;

import beans.AlmacenPalabras;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletJuego extends HttpServlet {
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        String palabra = palabraAleatoria();
        int l = palabra.length();
        
        HttpSession ses = request.getSession(true);
        ses.setAttribute("palabra", palabra);
        
        int vidas = (int) (l/2);
        ses.setAttribute("vidas", vidas);
        
        boolean[] letras = new boolean[l];
        ses.setAttribute("letras", letras);
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletJuego</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>"+palabra+"</h1>");
            out.println("<table><tr>");
            for (int i = 0; i < l; i++) {
                out.println("<td>");
                if(letras[i]){
                    out.println(palabra.charAt(i));
                }else{
                    out.println("<a href=''>Ver</a>");
                }
                
                out.println("</td>");
            }
            out.println("</tr></table>");
            out.println("<h1>"+vidas+" vidas restantes</h1>");
            out.println("<h1>Tu respuesta<input type='text' name='respuesta'><input type='submit' value='Comprobar' name='submit'></h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
    }
    
    private String palabraAleatoria(){
        String[] palabras = AlmacenPalabras.getLista();
        int i = (int) (Math.random()* palabras.length);
        return palabras[i];
    }
}
