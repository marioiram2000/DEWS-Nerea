package servlets;
import beans.Cliente;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletRegistro extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.sendError(403);
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitRegistro")==null)response.sendError(403);
        
        String usuario = request.getParameter("usuario");
        if(dao.ClienteDAO.buscaCliente(usuario)){
            response.sendRedirect("registro.jsp?error");
        }else{
            Cliente c = new Cliente();
            c.setCodigopostal(request.getParameter("zip"));
            c.setDomicilio(request.getParameter("domicilio"));
            c.setEmail(request.getParameter("email"));
            c.setNombre(usuario);
            c.setPassword(request.getParameter("password"));
            c.setTelefono(request.getParameter("usuario"));
            
            dao.ClienteDAO.guardaCliente(c);
            
            response.sendRedirect("login.jsp?registrado");
        }
    }
}
