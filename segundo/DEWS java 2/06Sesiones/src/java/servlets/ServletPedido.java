package servlets;

import beans.Comida;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletPedido extends HttpServlet {

    private HashMap<String, Comida> mapaComidas;
    
    public void init() throws ServletException {
        super.init();
        
        ObjectInputStream ois = null;
        try {
            mapaComidas = new HashMap<String, Comida>();
            String ruta = getServletContext().getRealPath(getServletContext().getInitParameter("ficherocomidas"));
            ois = new ObjectInputStream(new FileInputStream(ruta));
            
            Comida comida = (Comida) ois.readObject();
            while(comida!=null){
                mapaComidas.put(comida.getNombre(), comida);
                comida = (Comida) ois.readObject();
            }
        } catch (IOException ex) {
            
        } catch (ClassNotFoundException ex) {
            Logger.getLogger(ServletPedido.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        this.getServletContext().setAttribute("mapaComidas", mapaComidas);
        
    }

    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        HashMap<String, Comida> mapaComidas = (HashMap<String, Comida>)this.getServletContext().getAttribute("mapaComidas");
        
        HttpSession s = request.getSession();
        if(s.getAttribute("pedido")==null){
            s.setAttribute("pedido", new ArrayList<Comida>());
        }
        ArrayList<Comida> listaComidaSesion = (ArrayList<Comida>)s.getAttribute("pedido");
        if(request.getParameter("nombre")!=null){
            listaComidaSesion.add(mapaComidas.get(request.getParameter("nombre")));
        }
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletPedido</title>");  
            out.println("</head>");
            out.println("<body>");
            verTablaPedido(out, request);
            out.println("</body>");
            out.println("</html>");
        }
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    }
    
    private void verTablaPedido(PrintWriter out, HttpServletRequest request){
         HttpSession s = request.getSession();
        ArrayList<Comida> listaComidaSesion = (ArrayList<Comida>)s.getAttribute("pedido");
        HashMap<String, Comida> mapaComidas = (HashMap<String, Comida>)this.getServletContext().getAttribute("mapaComidas");
        
        out.print("<table>");
        Iterator<String> it = mapaComidas.keySet().iterator();
        while(it.hasNext()){
            String nombre = it.next();
            Comida comida = mapaComidas.get(nombre);
            String enlace = request.getRequestURI()+"?nombre="+nombre;
            out.print("<tr>");
                out.print("<td>"+nombre+"</td>");
                out.print("<td>"+comida.getPrecio()+"</td>");
                if(!listaComidaSesion.contains(comida)){
                   out.print("<td><a href='"+enlace+"'>pedir</a></td>"); 
                }else{
                    out.print("<td>pedido</td>");
                }
                
            out.print("</tr>");
        }
            
        out.print("</table>");
    }
}
