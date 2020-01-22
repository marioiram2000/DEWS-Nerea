package servlets;

import beans.Cliente;
import beans.Pedido;
import dao.GestionPedidos;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Map;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletPedidosClientes extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        request.getRequestDispatcher("listarPedidosCliente.jsp").forward(request, response);
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        HttpSession ses = request.getSession();
        Cliente c = (Cliente) ses.getAttribute("cliente");
        Map<Integer,Pedido> pedidos = GestionPedidos.todosPedidos(c);
        c.setPedidos(pedidos);
        ses.setAttribute("cliente", c);
        
        request.getRequestDispatcher("listarPedidosCliente.jsp").forward(request, response);
                
    }
}
