
package servlets;

import beans.Pregunta;
import beans.Test;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class Ej2ProcesoPregunta extends HttpServlet {
   
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("cant") == null || request.getParameter("cant").equals("") || Integer.parseInt(request.getParameter("cant")) < 1 || request.getParameter("nombre") == null || request.getParameter("nombre").equals("")){
            response.sendRedirect("Ej2index.html");
        }else{
            Test test = new Test(Integer.parseInt(request.getParameter("cant")));
            HttpSession s = request.getSession();
            s.setAttribute("nombre", request.getParameter("nombre"));
            s.setAttribute("cant", test.getPreguntas().size());
            s.setAttribute("i", 0);
            s.setAttribute("test", test);
            s.setAttribute("correctas", 0);

            if(request.getParameter("pistas")!=null){
                s.setAttribute("pistas", true);
            }else{
                s.setAttribute("pistas", false);
            }
            doPost(request, response);
        }
        
    } 

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        HttpSession s = request.getSession();
        Test test = (Test)s.getAttribute("test");
        ArrayList<Pregunta> preguntas = test.getPreguntas();
        int i = (int)s.getAttribute("i");
        
        if(request.getParameter("submitSiguiente")!=null){
            Pregunta p = preguntas.get(i);
            if(request.getParameter("respuesta")!=null){
                if(p.getCorrecta() == Integer.parseInt(request.getParameter("respuesta"))){
                    s.setAttribute("correctas", (int)s.getAttribute("correctas")+1);
                }else{
                }
                i ++;
                s.setAttribute("i", i);
            }
        }
        
        
        if(i<(int)s.getAttribute("cant")){
            try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet Ej2ProcesoPregunta</title>");  
            out.println("</head>");
            out.println("<body>");
            Pregunta pregunta = preguntas.get(i);

            out.println("<h1>"+pregunta.getEnunciado()+"</h1>");
            out.println("<h1>Correctas "+s.getAttribute("correctas")+"</h1>");
            out.print("<div><form method='POST' action='Ej2ProcesoPregunta'>");
            for (int j = 0; j < pregunta.getRespuestas().length; j++) {
                String respuesta = pregunta.getRespuestas()[j];
                out.print("<p><input type='radio' name='respuesta' value='"+j+"'>"+respuesta+"</p>");
            }
            if(i==(int)s.getAttribute("cant")-1){
                out.print("<p><input type='submit' name='submitSiguiente' value='FIN'/></p>");
            }else{
                out.print("<p><input type='submit' name='submitSiguiente' value='SIGUIENTE'/></p>");
            }
            out.print("</form></div>");
            if((Boolean)s.getAttribute("pistas")){
                out.print("<p>*Pista : "+pregunta.getPista()+"</p>");
            }
            out.println("</body>");
            out.println("</html>");
            }
        }else{
            response.sendRedirect("Ej2ServletResultado");
        }
        
    }


}
