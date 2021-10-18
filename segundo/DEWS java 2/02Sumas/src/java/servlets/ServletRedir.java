package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletRedir extends HttpServlet {

    String PASS = "123";
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendRedirect("ServletLogin");
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        if(request.getParameter("submitLogin")!=null){
            String pass = request.getParameter("pass");
            if(pass.equals(PASS)){
                //request.getRequestDispatcher("ServletPregunta").forward(request, response);
                response.sendRedirect("ServletPregunta");
            }else{
                //request.getRequestDispatcher("ServletLogin").forward(request, response);
                response.sendRedirect("ServletLogin?error");
            }
        }else{
            response.sendRedirect("ServletLogin");
        }
    }

}
