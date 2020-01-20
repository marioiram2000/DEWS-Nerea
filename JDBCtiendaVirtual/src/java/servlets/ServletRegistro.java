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
        if(GestionClientes.guardaCliente(c)){
            request.setAttribute("registrado", c);
            
        }else{
            
        }
        
        
    }
}
