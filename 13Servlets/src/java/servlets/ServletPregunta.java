/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author pei4
 */
public class ServletPregunta extends HttpServlet {

    
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletPregunta</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet ServletPregunta at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        }
    }

    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        int lim1=Integer.parseInt(this.getInitParameter("LIM1"));
        int lim2=Integer.parseInt(this.getInitParameter("LIM2"));
        
        //Generar 2 nºs aleatorios entre lim1 y lim2 (distintos)
        int n1=lim1 + (int)(Math.random()*(lim2-lim1+1));
        int n2;
        do{
            n2=lim1 + (int)(Math.random()*(lim2-lim1+1));
        } while (n2==n1);
        
        
        
        dibujarFormPregunta(n1,n2,request,response);
       
    }

   
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
       if (request.getParameter("submitresp")!=null){
           
           int n1=Integer.parseInt(request.getParameter("n1"));
           int n2=Integer.parseInt(request.getParameter("n2"));
           int resp=Integer.parseInt(request.getParameter("resp"));
           
           if (resp==n1+n2){
               //Rpta ok
               doGet(request,response);
           }
           else{
               //Rpta mal
               dibujarFormPregunta(n1,n2,request,response);
           }
           
       }
       else{
             doGet(request, response);
       }
    }

    private void dibujarFormPregunta(int n1, int n2, HttpServletRequest request, HttpServletResponse response) {
   
          response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletPregunta</title>");            
            out.println("</head>");
            out.println("<body>");
            
            out.println("<p>"+ n1 + " + "+  n2 + " = ?</p>");
            out.println("<form method='post' action='"+ request.getRequestURI()+"'>");
            out.println((n1+n2)+"<input type='radio' name='resp' value='"+(n1+n2)+"' />");
            out.println((n1+n2+7)+"<input type='radio' name='resp' value='"+(n1+n2+7)+"' />");
            out.println((n1+n2-1)+"<input type='radio' name='resp' value='"+(n1+n2-1)+"' />");
            out.println("<input type='hidden' name='n1' value='"+n1+"' />");
             out.println("<input type='hidden' name='n2' value='"+n2+"' />");
            out.println("<input type='submit' name='submitresp' value='COMPROBAR' />");
            out.println("</form>");
            
            out.println("</body>");
            out.println("</html>");
        } catch (IOException ex) {
            Logger.getLogger(ServletPregunta.class.getName()).log(Level.SEVERE, null, ex);
        }
    
    
    
    
    }

   

}
