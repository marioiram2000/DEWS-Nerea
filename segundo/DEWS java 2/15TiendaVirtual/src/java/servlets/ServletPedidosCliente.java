package servlets;
import beans.Cliente;
import beans.Pedido;
import dao.PedidoDAO;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Map;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletPedidosCliente extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
        response.sendError(403);/* out.println("<!DOCTYPE html>");out.println("<html>");out.println("<head>");out.println("<title>Servlet ServletPedidosCliente</title>");out.println("</head>");out.println("<body>");out.println("<h1>Mario Orozco ha patrocinado este servlet</h1>");out.println("</body>");out.println("</html>");}*/
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        if(request.getParameter("submitPedidosCliente")!=null){
        
        Cliente c = (Cliente)request.getSession().getAttribute("cliente");
        c.setPedidos(dao.PedidoDAO.getPedidosCliente(c));
        
        response.sendRedirect("listarPedidosCliente.jsp");
        } else if(request.getParameter("submitAnularPedidos")!=null){
            String[] anular = request.getParameterValues("anular");
            for (String idPedido : anular) {
                int id = Integer.parseInt(idPedido);
                dao.PedidoDAO.borrarPedido(id);
            }
            
            Cliente c = (Cliente)request.getSession().getAttribute("cliente");
            c.setPedidos(dao.PedidoDAO.getPedidosCliente(c));
            response.sendRedirect("listarPedidosCliente.jsp");
            
        } else{
            response.sendError(403);
        }
    }
}
