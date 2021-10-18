package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletConversor extends HttpServlet {

    private final static String[] DIVISAS={"$","Yenes","Libras"};
    
    private static float convertir(float cantidad, String divisa){
        float c = -1;
        switch(divisa){
            case("$"): 
                c = (float) (cantidad*1.29);                
                break;
            case("Yenes"):
                c = (float) (cantidad*124);              
                break;
            case("Libras"):
                c = (float) (cantidad*1.19);              
                break;
        }
        
        return c;
    }
    private void dibujarForm(PrintWriter out, HttpServletRequest request){
        String cantidad="";
        if(request.getParameter("cantidad")!=null){
            cantidad = request.getParameter("cantidad");
        }
        
        String divisa="";
        if(request.getParameter("divisa")!=null){
            divisa = request.getParameter("divisa");
        }
        
        out.print("<form method='post' action='"+request.getRequestURI()+"'>");
            out.print("<label>Introduce cantidad</label>");
            out.print("<input type='text' name='cantidad' value='"+cantidad+"'>€ ");
            out.print("<label>Introduce divisa </label>");
            out.print("<select name='divisa'>");
                for (String d : DIVISAS) {
                    String selected = "";
                    if(!divisa.equals(""))
                        selected = selected;
                    out.print("<option value='"+d+"' "+selected+">"+d+"</option>");
                }
            out.print("</select>");
            out.print("<input type='submit' value='CONVERTIR' name='submitConvertir'>");
        out.print("</form>");
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletConversor</title>");            
            out.println("</head>");
            out.println("<body>");
            dibujarForm(out, request);
            out.println("</body>");
            out.println("</html>");
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        boolean convertido = false;
        float conversion = 0;
        if(request.getParameter("submitConvertir")!=null){
            try{
                float cantidad = Float.parseFloat(request.getParameter("cantidad"));
                String divisa = request.getParameter("divisa");
                conversion = convertir(cantidad, divisa);
                convertido = true;
                
            }catch (NumberFormatException e){
                
            }
            
            response.setContentType("text/html;charset=UTF-8");
            try (PrintWriter out = response.getWriter()) {
                /* TODO output your page here. You may use following sample code. */
                out.println("<!DOCTYPE html>");
                out.println("<html>");
                out.println("<head>");
                out.println("<title>Servlet ServletConversor</title>");            
                out.println("</head>");
                out.println("<body>");
                dibujarForm(out, request);
                if(convertido){
                    out.print("<p>"+conversion + " " + request.getParameter("divisa")+"</p>");
                }else{
                    out.print("<p>No se ha podido convertir</p>");
                }
                out.println("</body>");
                out.println("</html>");
            }
        }else{
            response.sendError(403);
        }
    }


}
