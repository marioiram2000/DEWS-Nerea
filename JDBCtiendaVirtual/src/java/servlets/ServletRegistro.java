package servlets;

import beans.Cliente;
import conex.Conexion;
import dao.GestionClaves;
import dao.GestionClientes;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletRegistro extends HttpServlet {
    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendError(403);
    }


    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        Connection cn = Conexion.conexion();
        int id = GestionClaves.siguienteId(cn, "clientes");
        Cliente c = new Cliente(id, 
                request.getParameter("username"), 
                request.getParameter("password"), 
                request.getParameter("domicilio"), 
                request.getParameter("zip"), 
                request.getParameter("telefono"), 
                request.getParameter("email"));
        System.out.println("-------------------Maximo de usuarios: "+this.getInitParameter("maxUsuarios"));
        if(!GestionClientes.buscaCliente(c.getNombre())){
            if(Integer.parseInt(this.getInitParameter("maxUsuarios")) > GestionClientes.cuantosClientes()){
                if(GestionClientes.guardaCliente(c)){            
                    request.setAttribute("registrado", c);
                    request.getRequestDispatcher("login.jsp").forward(request, response);                  
                }else{
                    System.out.print("-----No se ha guardado el cliente-----");
                    request.setAttribute("error", "No se pudo guardar el usuario en la base de datos");
                    request.getRequestDispatcher("registro.jsp").forward(request, response); 
                }
            }else{
                System.out.print("-----Maximo de usuarios alcanzado-----");
                request.setAttribute("error", "Se ha alcanzado el máximo de usuarios permitidos, lo sentimos.");
                request.getRequestDispatcher("registro.jsp").forward(request, response); 
            }            
        }else{
            System.out.print("-----Nombre de usuario ya usado-----");
            request.setAttribute("error", "Ese nombre de usuaio ya está siendo usado");
            request.getRequestDispatcher("registro.jsp").forward(request, response); 
        }      
    }
}
