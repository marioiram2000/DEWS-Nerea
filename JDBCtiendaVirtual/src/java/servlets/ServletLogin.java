package servlets;

import beans.Cliente;
import dao.GestionClientes;
import dao.GestionPedidos;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletLogin extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException{
            response.sendError(403);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        HttpSession ses = request.getSession(false);
        ses.invalidate();
        ses = request.getSession(true);
        
        if(request.getParameter("login")==null){
                response.sendError(403);
        }
        String user = request.getParameter("username");
        String pas = request.getParameter("password");
        
        Cliente c = GestionClientes.buscaCliente(user, pas);
        
        if(c!=null){
            ses.setAttribute("cliente", c);
            ses.setAttribute("items", GestionPedidos.todosItems());
            
            request.getRequestDispatcher("tienda.jsp").forward(request, response);            
        }else{
            if(GestionClientes.buscaCliente(user)){   
                request.setAttribute("error", "Contraseña incorrecta");                      
            }else{
                request.setAttribute("error", "Usuario incorrecto");                    
            }
            //System.out.println(request.getAttribute("error"));            
            request.getRequestDispatcher("login.jsp").forward(request, response);      
        }
    }
}
