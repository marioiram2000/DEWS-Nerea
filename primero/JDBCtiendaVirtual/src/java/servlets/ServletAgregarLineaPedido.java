package servlets;

import beans.CarroCompra;
import beans.Item;
import beans.LineaPedido;
import dao.GestionPedidos;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletAgregarLineaPedido extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendError(403);
    }
    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        if(request.getParameter("cantidad")!=null && !request.getParameter("cantidad").equals("") && Integer.parseInt(request.getParameter("cantidad"))>0){
            HttpSession ses = request.getSession();
            CarroCompra carroCompra = (CarroCompra) ses.getAttribute("carroCompra");
            if(carroCompra==null){
                carroCompra = new CarroCompra();
            }

            LineaPedido lp = new LineaPedido();

            Item it = GestionPedidos.buscaItemPoirId(Integer.parseInt(request.getParameter("id")));
            lp.setItem(it);
            lp.setCantidad(Integer.parseInt(request.getParameter("cantidad")));
         
            carroCompra.aniadeLinea(lp);
            ses.setAttribute("carroCompra", carroCompra);
        }        
        request.getRequestDispatcher("tienda.jsp").forward(request, response); 
    }
}
/*
lp.setPedido(0);
lp.setId(0);
*/