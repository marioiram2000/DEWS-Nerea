package servlets;

import beans.CarroCompra;
import beans.Cliente;
import beans.LineaPedido;
import beans.Pedido;
import conex.Conexion;
import dao.GestionClaves;
import dao.GestionClientes;
import dao.GestionPedidos;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.util.Collection;
import java.util.Iterator;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletGrabarCompra extends HttpServlet {
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.sendError(403);
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //sessionScope.carroCompra.getLineasPedido()
        HttpSession ses = request.getSession();
        CarroCompra carro = (CarroCompra) ses.getAttribute("carroCompra");
        try{
            if(carro.getLineasPedido().size()<1){
                request.getRequestDispatcher("tienda.jsp").forward(request, response);
            } 
        }catch(NullPointerException e){
            request.getRequestDispatcher("tienda.jsp").forward(request, response);
        }
        
        Cliente cliente = (Cliente) ses.getAttribute("cliente");        
        System.out.print("---------------------------------------"+cliente);
        int idCliente = cliente.getId();        
        String nombre = cliente.getNombre();        
        String password = cliente.getPassword();
        String domicilio = request.getParameter("direccion");
        String codigopostal = request.getParameter("zip");
        String telefono = request.getParameter("telefono");
        String email = request.getParameter("email");
        
        Cliente c = new Cliente(idCliente, nombre, password, domicilio, codigopostal, telefono, email);
        GestionClientes.actualizaCliene(c);
        ses.setAttribute("cliente", c);
        
        Connection cn = Conexion.conexion();
        
        java.sql.Date sateSQL = new java.sql.Date(new java.util.Date().getTime());
        
        Pedido p = new Pedido();
        p.setId(GestionClaves.siguienteId(cn, "pedidos"));
        p.setIdcliente(idCliente);
        p.setFecha(sateSQL);
        p.setTotal(carro.total());
        GestionPedidos.guardaPedido(p);
        System.out.print("-------------------------------------PEDIDO: "+p);
        
        Collection lineas = carro.getLineasPedido();
        for (Iterator iterator = lineas.iterator(); iterator.hasNext();) {
            LineaPedido linea = (LineaPedido)iterator.next();
            linea.setId(GestionClaves.siguienteId(cn, "LineasPedido"));
            linea.setPedido(p);
            System.out.print("-------------------------------------LINEA: "+linea);
            GestionPedidos.guardaLineaPedido(linea);
        }
        
        Conexion.devolverConexion(cn);
        
        request.getRequestDispatcher("gracias.jsp").forward(request, response);
        
    }
}
