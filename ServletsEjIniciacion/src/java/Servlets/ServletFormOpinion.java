package Servlets;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.Iterator;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletFormOpinion extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        BufferedReader br = new BufferedReader(new FileReader(getServletContext().getRealPath("secciones.txt")));
        String linea;
        ArrayList<String>secciones = new ArrayList<>();
        while((linea = br.readLine()) != null){
            secciones.add(linea);
        }
        br.close();
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletFormOpinion</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<form method='POST' action='ServletFormOpinion'><br>" +
                            "	<p>Nombre: <input type=\"text\" name=\"nombre\"/></p>" +
                            "	<p>Apellidos: <input type=\"text\" name=\"apellidos\"/></p>" +
                            "	<p>Opinión: <br>" +
                            "		<input type=\"radio\" name=\"opinion\" value=\"b\">Buena<br>" +
                            "		<input type=\"radio\" name=\"opinion\" value=\"r\">Regular<br>" +
                            "		<input type=\"radio\" name=\"opinion\" value=\"m\">Mala<br>" +
                            "	</p>" +
                            "	<p>Comentarios: <br><textarea name=\"comentarios\" cols=\"30\" rows=\"10\"></textarea></p><br>" +
                            "	<p>Tus seccions favoritas<br>");
            
            for (Iterator<String> iterator = secciones.iterator(); iterator.hasNext();) {
                String next = iterator.next();
                out.println("<input type=\"checkbox\" name=\"secciones[]\" value='"+next+"'>"+next+"<br>"); 
            }
            
            out.println("</p><br>" +
                            "	<input type=\"submit\" name=\"submit\" value=\"Enviar opinion\">" +
                            "</form>");
            out.println("</body>");
            out.println("</html>");
        }
    }
    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        if(request.getParameter("submit")==null || request.getParameter("nombre").equals("")|| request.getParameter("secciones[]") == null){
            response.sendRedirect("ServletFormOpinion");
            System.out.println("Algun campo es null");
        }else{
            if(request.getParameter("opinion").equals("b")){
                System.out.println("opinion b");
                BufferedWriter bw = new BufferedWriter(new FileWriter(getServletContext().getRealPath("seccionesfavoritas.txt"), true));
                String linea = request.getParameter("nombre")+": ";
                
                String[] secciones = request.getParameterValues("secciones[]");
                for (String seccion : secciones) {
                    linea += seccion+" ";
                    //System.out.println(seccion);
                }
                bw.write(linea + "\n");
                bw.close();
            }
        }
      response.sendRedirect("ServletFormOpinion");
    }
}
