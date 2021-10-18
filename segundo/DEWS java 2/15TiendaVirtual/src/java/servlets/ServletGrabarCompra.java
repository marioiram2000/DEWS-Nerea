
package servlets;

import beans.CarroCompra;
import beans.Cliente;
import beans.LineaPedido;
import beans.Pedido;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.Date;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletGrabarCompra extends HttpServlet {
   
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitGrabar")==null)response.sendError(403);
        
        CarroCompra c = (CarroCompra)request.getSession().getAttribute("carro");
        if(c.vacio())response.sendRedirect("tienda.jsp?carroVacio");
        
        Cliente cliente = new Cliente();
        cliente.setCodigopostal(request.getParameter("zip"));
        cliente.setDomicilio(request.getParameter("domicilio"));
        cliente.setEmail(request.getParameter("email"));
        cliente.setNombre(request.getParameter("nom"));
        cliente.setTelefono(request.getParameter("telefono"));
        Cliente cl = (Cliente)request.getSession().getAttribute("cliente");
        
        if(!cliente.equals(cl)){
            cliente.setId(cl.getId());
            cliente.setPassword(cl.getPassword());
            cliente.setNombre(cl.getNombre());
            request.getSession().setAttribute("cliente", cliente);
            //System.err.println(cliente.toString());
            dao.ClienteDAO.actualizaCliente(cliente);
        }
        
        Pedido p = new Pedido();
        p.setCliente((Cliente)request.getSession().getAttribute("cliente"));
        p.setFecha(new Date());
        p.setTotal(c.total());
        
        //System.err.println(p.toString());
        int idPedido = dao.PedidoDAO.guardaPedido(p);
        p.setId(idPedido);
        
        for (LineaPedido linea : c.getLineasPedido()) {
            linea.setPedido(p);
            dao.PedidoDAO.guardaLineaPedido(linea);
            //System.out.println(linea.toString());
        }
        response.sendRedirect("gracias.jsp");
        
    }


}
