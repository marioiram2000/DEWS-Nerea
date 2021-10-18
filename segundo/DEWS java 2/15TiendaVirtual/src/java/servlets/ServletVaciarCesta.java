package servlets;
import beans.CarroCompra;
import beans.LineaPedido;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletVaciarCesta extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.sendError(403);
        /* response.setContentType("text/html;charset=UTF-8"); try (PrintWriter out = response.getWriter()) {

        out.println("<!DOCTYPE html>");
        out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet ServletVaciarCesta</title>");  
        out.println("</head>");
        out.println("<body>");
        out.println("<h1>Mario Orozco ha patrocinado este servlet</h1>");
        out.println("</body>");
        out.println("</html>");
                }*/
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitVaciarCesta")==null)response.sendError(403);
        CarroCompra c = (CarroCompra)(request.getSession().getAttribute("carro"));
        c.removeAll();
        response.sendRedirect("listarCesta.jsp");
    }
}
