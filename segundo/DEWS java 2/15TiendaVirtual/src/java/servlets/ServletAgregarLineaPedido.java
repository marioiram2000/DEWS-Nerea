package servlets;
import beans.CarroCompra;
import beans.LineaPedido;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletAgregarLineaPedido extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.sendError(403);
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitAniadir")==null)response.sendError(403);
        
        if(Integer.parseInt(request.getParameter("cantidad"))>0){
            CarroCompra c;
            if(request.getSession().getAttribute("carro")==null){
                c = new CarroCompra();
                request.getSession().setAttribute("carro", c);
            }else{
                c = (CarroCompra)request.getSession().getAttribute("carro");
            }

            LineaPedido l = new LineaPedido();
            l.setCantidad(Integer.parseInt(request.getParameter("cantidad")));
            l.setItem(dao.PedidoDAO.buscaItemPorId(Integer.parseInt(request.getParameter("iditem"))));

            //System.err.println(c.toString());
            c.aniadeLinea(l);
        }
        
        response.sendRedirect("tienda.jsp");
    }
}
