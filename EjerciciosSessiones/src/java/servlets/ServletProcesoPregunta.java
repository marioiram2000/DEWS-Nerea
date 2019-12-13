package servlets;

import beans.Pregunta;
import beans.Test;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Iterator;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletProcesoPregunta extends HttpServlet {

    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletProcesoPregunta</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet ServletProcesoPregunta at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }
    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //String nombre = request.getParameter("nombre");
        String cant = request.getParameter("cant");
        String pistas = request.getParameter("pistas");
        
        
        HttpSession ses = request.getSession(true);
        if(ses.getAttribute("indice")==null){
            ses.setAttribute("indice", 0);
        }
        int indice = (int) ses.getAttribute("indice");
        
        int c = -1;
        try{
            c = Integer.parseInt(cant);
            
        }catch(NumberFormatException nfe){
            request.getRequestDispatcher("indexTest.html").forward(request, response);   
        }catch(NullPointerException npe){
            request.getRequestDispatcher("indexTest.html").forward(request, response);   
        }
        if(c<1){
            request.getRequestDispatcher("indexTest.html").forward(request, response);   
        }
        
        Test test = new Test(c);        
        ArrayList<Pregunta> preguntas = test.getPreguntas();
        Pregunta p = preguntas.get(c);//getRespuestaCorrecta,getEnunciado,getPista,getRespuestas
        String enunciado = p.getEnunciado();
        String pista = "";
        if(pistas.equals("si")){
            pista = "* PISTA: "+p.getPista();
        }
        String[] respuestas = p.getRespuestas();
        escribir(response, enunciado, respuestas, pista);        
    }
    
    private void escribir(HttpServletResponse response, String enunciado, String[] respuestas, String pista) throws IOException{
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletProcesoPregunta</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>"+enunciado+"</h1>");
            out.println("<form action='ServletProcesoPregunta' method='POST'>");
            for (int i = 0; i < respuestas.length; i++) {
                String respuesta = respuestas[i];
                out.println("<p><input type='radiobutton' name='respuesta' value='"+i+"'>"+respuesta+"</p>");
            }
            out.println("</form>");
            out.println("<p>"+pista+"</p>");
            out.println("</body>");
            out.println("</html>");
        }
    }
}
