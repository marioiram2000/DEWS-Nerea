package servlets;
import beans.Cliente;
import dao.ClienteDAO;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletLogin extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        response.sendError(403);
        
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitLogin")!=null){
            HttpSession ses = request.getSession(false);
            if(ses != null){
                ses.invalidate();
            }
            ses = request.getSession();
            String nombre = request.getParameter("usuario");
            String password = request.getParameter("password");
            Cliente c = dao.ClienteDAO.buscaCliente(nombre, password);
            if(c!=null){
                ses.setAttribute("cliente", c);
                ses.setAttribute("items", dao.PedidoDAO.todosItems());
                response.sendRedirect("tienda.jsp");
            }else if(nombre.equals("admin")){
                response.sendRedirect("ServletGestionPedidos");
            }else{
                response.sendRedirect("login.jsp?error");
            }
        }else{response.sendError(403);}
        
    }
}
