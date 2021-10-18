package servlets;

import beans.Correccion;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletPregunta extends HttpServlet {

    private int[] numsAzar(){
        int[] nums = new int[2];
        
        int liminf = Integer.parseInt(this.getInitParameter("n1"));
        int limsup = Integer.parseInt(this.getInitParameter("n2"));
        
        int n1 = (int) (liminf + (Math.random()*(limsup-liminf+1)));
        nums[0] = n1;
        
        int n2;
        do{
           n2 =  (int) (liminf + (Math.random()*(limsup-liminf+1)));
        } while (n2==n1);
        
        nums[1] = n2;
        
        return nums;
    }
    private void dibujarSuma(PrintWriter out){
        int[] nums = numsAzar();
        String pregunta = nums[0]+" + "+nums[1]+"?";
        int rptaOK = nums[0] + nums[1];
        int rptaMal1 = rptaOK+1;
        int rptaMal2 = rptaOK-1;
        
        out.print("<form method='post' action='ServletPregunta'>");
            out.print("<label>"+pregunta+"</label>");
            out.print("<input type='radio' name='rpta' value='"+rptaOK+"'>"+rptaOK );
            out.print("<input type='radio' name='rpta' value='"+rptaMal1+"'>"+rptaMal1);
            out.print("<input type='radio' name='rpta' value='"+rptaMal2+"'>"+rptaMal2);
            out.print("<input type='hidden' name='n1' value='"+nums[0]+"'>");
            out.print("<input type='hidden' name='n2' value='"+nums[1]+"'>");
            out.print("<input type='submit' value='Enviar' name='submitrpta'>");
        out.print("</form>");
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ServletPregunta</title>");            
            out.println("</head>");
            out.println("<body>");
                if(request.getAttribute("correccion")!=null){
                    Correccion c = (Correccion) request.getAttribute("correccion");
                    if(c.isCorrecta()){
                        out.print("<p style='color:green'>Acertada</p>");
                    }else{
                        out.print("<p style='color:red'>Fallada, la respuesta correcta era "+c.getNum_correcto()+"</p>");
                    }
                }
                dibujarSuma(out);
            out.println("</body>");
            out.println("</html>");
        }
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        if(request.getParameter("submitrpta")!=null){
            int n1 = Integer.parseInt(request.getParameter("n1"));
            int n2 = Integer.parseInt(request.getParameter("n2"));
            int rpta = Integer.parseInt(request.getParameter("rpta"));
            Correccion c;
            if((n1+n2)==rpta){
                //request.setAttribute("acertada", true);
                c = new Correccion(true, rpta);
            }else{
                //request.setAttribute("acertada", false);
                c = new Correccion(false, rpta);
            }
            request.setAttribute("correccion", c);
            doGet(request, response);
        }
    }

}
