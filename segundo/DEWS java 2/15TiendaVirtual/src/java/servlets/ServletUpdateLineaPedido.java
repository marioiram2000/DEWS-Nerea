package servlets;
import beans.CarroCompra;
import beans.LineaPedido;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletUpdateLineaPedido extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.sendError(403);
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {

        out.println("<!DOCTYPE html>");
        out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet ServletUpdateLineaPedido</title>");  
        out.println("</head>");
        out.println("<body>");
        out.println("<h1>Mario Orozco ha patrocinado este servlet</h1>");
        out.println("</body>");
        out.println("</html>");
                }
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(Integer.parseInt(request.getParameter("cantidad"))>0){
            CarroCompra c = (CarroCompra) request.getSession().getAttribute("carro");
            if(request.getParameter("submitBorrar")!=null){
                c.borraLinea(Integer.parseInt(request.getParameter("iditem")));
                response.sendRedirect("listarCesta.jsp?borrado");
            }else if(request.getParameter("submitCambiar")!=null){
                int iditem = Integer.parseInt(request.getParameter("iditem"));
                int cantidad = Integer.parseInt(request.getParameter("cantidad"));
                c.getLineaPedido(iditem).setCantidad(cantidad);
                response.sendRedirect("listarCesta.jsp?cantidad="+request.getParameter("iditem"));
            }
        }else{
            response.sendRedirect("listarCesta.jsp");
        }
    }
}
