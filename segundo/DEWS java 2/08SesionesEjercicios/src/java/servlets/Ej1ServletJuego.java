package servlets;

import beans.AlmacenPalabras;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Ej1ServletJuego extends HttpServlet {
        
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        HttpSession s = request.getSession();
        Boolean[] letras;
        if(s.getAttribute("palabra")==null){
            s.setAttribute("palabra", new AlmacenPalabras().getPalabra());
            int vidas = ((String)s.getAttribute("palabra")).length()/2;
            s.setAttribute("vidas", vidas);
            letras = new Boolean[((String)s.getAttribute("palabra")).length()];
            for (int i = 0; i < letras.length; i++) {
                letras[i] = false;
            }
            s.setAttribute("letras", letras);
        }        
        
        String palabra = (String) s.getAttribute("palabra");
        int vidas = (int) s.getAttribute("vidas");
        letras = (Boolean[])s.getAttribute("letras");
        
        if(vidas>1){
            if(request.getParameter("v")!=null){
                int v = Integer.parseInt(request.getParameter("v"));
                letras[v] = true;
                vidas --;
                s.setAttribute("vidas", vidas);
            }
        }
        
        if(request.getParameter("correcto")!=null){
            if(request.getParameter("correcto").equals("si")){
                s.invalidate();
                    response.sendRedirect("Ej1ServletJuego?acierto");
            }else{
                vidas --;
                s.setAttribute("vidas", vidas);
                if(vidas==0){
                    s.invalidate();
                    response.sendRedirect("Ej1ServletJuego?pal="+palabra+"&fallo");
                }
            }
        }
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {

        out.println("<!DOCTYPE html>");
        out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet Ej1ServletJuego</title>");  
        out.println("</head>");
        out.println("<body>");
        //out.println("<h1>"+palabra+palabra.length()+vidas+"</h1>");
        if(request.getParameter("acierto")!=null){
            out.println("<h1>Muy bien, has acertado la palabra</h1>");
        }
        if(request.getParameter("fallo")!=null){
            out.println("<h1>Has perdido! La palabra era "+request.getParameter("pal")+"</h1>");
        }
        out.print("<table>");
            out.print("<tr>");
                for (int i = 0; i < palabra.length(); i++) {
                    if(letras[i]){
                        out.print("<td>"+palabra.charAt(i)+"</td>");
                    }else{
                        out.print("<td><a href='Ej1ServletJuego?v="+i+"'>Ver</a></td>");
                    }
                }
            out.print("</tr>");
        out.print("</table>");
        out.print("<p>- "+vidas+" vidas restantes</p>");
        out.print("<p>- Tu respuesta <form method='POST' action='Ej1ServletComprobar'><input type='text' name='palabra'><input type='submit' name='submit' value='Comprobar'></from></p>");
        out.println("</body>");
        out.println("</html>");
        }
    } 
}
