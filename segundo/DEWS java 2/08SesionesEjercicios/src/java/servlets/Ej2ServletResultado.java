package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.time.Duration;
import java.time.Instant;
import java.util.Date;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Ej2ServletResultado extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        HttpSession s = request.getSession();
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {

        out.println("<!DOCTYPE html>");
        out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet Ej2ServletResultado</title>");  
        out.println("</head>");
        out.println("<body>");
        out.println("<h1>"+s.getAttribute("nombre")+", has acertado "+s.getAttribute("correctas")+" de "+s.getAttribute("cant")+" preguntas</h1>");
        
        if((int)s.getAttribute("correctas")<(int)s.getAttribute("cant")/2){
            out.print("<p>Eres inútil</p>");
        }else{
            out.print("<p>No eres inútil</p>");
        }
        
        long millisSinceEpoch = s.getCreationTime();
        Instant instantSessionStarted = Instant.ofEpochMilli( millisSinceEpoch );
        Duration durationOfThisSession = Duration.between( instantSessionStarted , Instant.now() );
        
        out.print("Tiempo de respuesta: "+ (durationOfThisSession.getSeconds()/60) + " minutos y " + (durationOfThisSession.getSeconds()%60) +" segundos");
        
        
        out.println("</body>");
        out.println("</html>");
        }
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    }
}
