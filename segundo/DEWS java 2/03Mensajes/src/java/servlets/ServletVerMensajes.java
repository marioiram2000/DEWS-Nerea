package servlets;

import beans.AlmacenMensajes;
import beans.Mensaje;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Iterator;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletVerMensajes extends HttpServlet {

    private void verMensajes(PrintWriter out){
        ArrayList<Mensaje> lstMens = AlmacenMensajes.getMensajes();
        out.print("<table>");
        out.print("<tr><th>Emisor</th><th>Mensaje</th><th>A favor</th><th>En contra</th></tr>");
        int i = 0;
        Iterator it = lstMens.iterator();
        while(it.hasNext()){
            Mensaje m = (Mensaje)it.next();
            String enlace = "ServletVerMensajes?posicion="+i;
            out.print("<tr>");
                out.print("<td>"+m.getEmisor()+"</td>");
                out.print("<td>"+m.getTexto()+"</td>");
                out.print("<td>"+m.getaFavor()+"</td>");
                out.print("<td>"+m.getEnContra()+"</td>");
                out.print("<td><a href='"+enlace+"&favor'>Votar a favor</a></td>"); 
                out.print("<td><a href='"+enlace+"&contra'>Votar en contra</a></td>"); 
            out.print("</tr>");
            i++;
        }
        out.print("</table>");
    }
    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        
        if(request.getParameter("posicion")!=null){
            int i = Integer.parseInt(request.getParameter("posicion"));
            ArrayList<Mensaje> lstMensajes = AlmacenMensajes.getMensajes();
            if(request.getParameter("favor")!=null)
                lstMensajes.get(i).unoMasAFavor();
            if(request.getParameter("contra")!=null)
                lstMensajes.get(i).unoMasEnContra();
        }
        
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletVerMensajes</title>");  
            out.println("</head>");
            out.println("<body>");
            verMensajes(out);
            out.println("</body>");
            out.println("</html>");
        }
    } 

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        doGet(request, response);
    }

}
