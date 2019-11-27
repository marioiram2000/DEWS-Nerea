/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author dw2_alum4
 */
public class ServletPregunta extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
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
        int lim1 = Integer.parseInt(this.getInitParameter("LIM1"));
        int lim2 = Integer.parseInt(this.getInitParameter("LIM2"));
        int n1=lim1 + (int)(lim1+Math.random()*(lim2-lim1+1));
        
        
        int n2;
        do{
            n2 = lim1 + (int)(lim1+Math.random()*(lim2-lim1+1));
        }while (n2==n1);
        
        dibujarFormPregunta(n1,n2,response, request);
    }

    private void dibujarFormPregunta(int n1, int n2, HttpServletResponse response, HttpServletRequest request) throws IOException{
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletPregunta</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>"+n1+"+"+n2+"= ?</h1>");
            out.println("<form method='post' action='"+request.getRequestURI()+"'>");
            out.println("<input type='hidden' name='n1' value='"+(n1)+"'/>");
            out.println("<input type='hidden' name='n2' value='"+(n2)+"'/>");
            out.println((n1+n2)+"<input type='radio' name='resp' value='"+(n1+n2)+"'/>");
            out.println((n1+n2-2)+"<input type='radio' name='resp' value='"+(n1+n2-2)+"'/>");
            out.println((n1+n2+1)+"<input type='radio' name='resp' value='"+(n1+n2+1)+"'/>");            
            out.println("<input type='submit' name='submitresp' value='Comprobar'/>");
            out.println("</form>");
            out.println("</body>");
            out.println("</html>");
        }
    }
    
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        if(request.getParameter("submitresp")!=null){
            int n1 = Integer.parseInt(request.getParameter("n1"));
            int n2 = Integer.parseInt(request.getParameter("n2"));
            int resp = Integer.parseInt(request.getParameter("resp"));
            
            if(resp==(n1+n2)){
                doGet(request, response);
            }else{
                dibujarFormPregunta(n1, n2, response, request);
            }
        }else{
            doGet(request, response);
        }
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
