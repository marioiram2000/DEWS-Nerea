package servlets;

import beans.CarroCompra;
import beans.LineaPedido;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletUpdateLineaPedido extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendError(403);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        HttpSession ses = request.getSession();
        CarroCompra carroCompra = (CarroCompra) ses.getAttribute("carroCompra");
        int idItem = Integer.parseInt(request.getParameter("idItem"));
        System.out.println("------------------------------------------------------"+request.getParameter("idItem")+"--------------------------------------------------------------");
        if(request.getParameter("borrar")!=null){            
            carroCompra.borrarLinea(idItem);
            ses.setAttribute("carroCompra", carroCompra);
            
        }else if(request.getParameter("cambiar")!=null){            
            LineaPedido lp = carroCompra.getLineaPedido(idItem);
   
            if(Integer.parseInt(request.getParameter("cantidad"))>0){
                lp.setCantidad(Integer.parseInt(request.getParameter("cantidad")));
                
            }else{
                carroCompra.borrarLinea(idItem);
                ses.setAttribute("carroCompra", carroCompra);
            }
        }else{
            response.sendError(403);
        }
        request.getRequestDispatcher("listar_cesta.jsp").forward(request, response);
    }

}
