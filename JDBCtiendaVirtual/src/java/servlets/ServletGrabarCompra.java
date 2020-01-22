package servlets;

import beans.CarroCompra;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletGrabarCompra extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendError(403);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //sessionScope.carroCompra.getLineasPedido()
        HttpSession ses = request.getSession();
        CarroCompra carro = (CarroCompra) ses.getAttribute("carroCompra");
        if(carro.getLineasPedido()!=null){
            
        }else{
            request.getRequestDispatcher("tienda.jsp").forward(request, response);
        }   
    }
}
