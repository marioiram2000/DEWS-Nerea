package servlets;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Ej3procesaApuesta extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.sendError(403);
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        String[] apuestas = request.getParameterValues("apuestas");
        String[] partidos = request.getParameterValues("partidos");
        System.err.println(apuestas);
        System.err.println(partidos);
        boolean reenviar = false;
        HttpSession s = request.getSession();
        s.setAttribute("apuestas", apuestas);
        for (String apuesta : apuestas) {
            if(apuesta.equals("0")){
                reenviar = true;
            }
        }
        if(reenviar){
            request.getRequestDispatcher("Ej3EscribeApuesta").forward(request, response);
        }
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {

        out.println("<!DOCTYPE html>");
        out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet EscribeApuesta</title>");
        out.println("</head>");
        out.println("<body>");
        out.print("<h1>Apuesta guardada</h1>");
        out.print("<p>");
            for (int i = 0; i < partidos.length; i++) {
                String partido = partidos[i];
                String apuesta = apuestas[i];
                out.print(partido+apuesta+"<br>");
            }
        out.print("</p>");
        out.print("<p><a href='Ej3EscribeApuesta?nombre="+request.getParameter("nombre")+"'>REVISAR LA APUESTA</a></p>");
        out.println("</body>");
        out.println("</html>");
        
        }
    }
}
