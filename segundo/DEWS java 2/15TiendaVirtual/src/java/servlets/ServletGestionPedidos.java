package servlets;
import beans.Pedido;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashSet;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletGestionPedidos extends HttpServlet {

    private void recopilarPedidos(HttpSession ses){
        Pedido[][] pedidos =  dao.PedidoDAO.getPedidosSemanaEstado();
        ses.setAttribute("pedidos", pedidos);
        /*
        for (int i = 0; i < pedidos.length; i++) {
            for (int j = 0; j < pedidos[i].length; j++) {
                Pedido pedido = pedidos[i][j];
                System.out.println("ESTADO "+i+" PEDIDO "+j+" "+pedido.toString());
            }
        }
        */
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        
        if(request.getParameter("recibido")!=null){
            if(request.getSession().getAttribute("recibidos")==null){
                request.getSession().setAttribute("recibidos", new HashSet<Integer>());
            }
            ((HashSet<Integer>)request.getSession().getAttribute("recibidos")).add(Integer.parseInt(request.getParameter("recibido")));
        }
        
        if(request.getParameter("norecibido")!=null){
            ((HashSet<Integer>)request.getSession().getAttribute("recibidos")).remove(Integer.parseInt(request.getParameter("norecibido")));
        }
        if(request.getParameter("guardar")!=null){
            if(request.getSession().getAttribute("recibidos")!=null){
                for (Integer id : ((HashSet<Integer>)request.getSession().getAttribute("recibidos"))) {
                    dao.PedidoDAO.recibirPedido(id);
                }
            }
        }
        
        recopilarPedidos(request.getSession());
        response.sendRedirect("gestionPedidos.jsp");
        
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        if(request.getParameter("submitEnviar")==null)response.sendError(403);
        
        String[] ids = request.getParameterValues("enviar");
        if(ids!=null && ids.length>0){
            for (String id : ids) {
                int idPedido = Integer.parseInt(id);
                dao.PedidoDAO.enviarPedido(idPedido);
            }
        }
        
        
        recopilarPedidos(request.getSession());
        response.sendRedirect("gestionPedidos.jsp");
    }
}
