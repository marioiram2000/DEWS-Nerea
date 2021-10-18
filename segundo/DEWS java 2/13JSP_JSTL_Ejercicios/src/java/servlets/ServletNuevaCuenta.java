package servlets;
import beans.Cuenta;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletNuevaCuenta extends HttpServlet {

    @Override
    public void init() throws ServletException {
        super.init(); 
        ArrayList<String> nombres = new ArrayList<>();
        nombres.add("caca");
        nombres.add("salama");
        nombres.add("admin");
        this.getServletContext().setAttribute("nombresProhibidos", nombres);
        
    }

    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.sendError(403);
        
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitNuevaCuenta")==null){
            response.sendError(403);
        }
        
        Cuenta c = new Cuenta();
        request.getSession().setAttribute("cuenta", c);
        
        String error = "";
        
        if(request.getParameter("titular").equals("")){
            error = "titular";
        }else{
            if(((ArrayList)this.getServletContext().getAttribute("nombresProhibidos")).contains(request.getParameter("titular"))){
                error = "titularProhibido";
            }else{
                c.setTitular(request.getParameter("titular"));
                
                if(request.getParameter("saldo").equals("")){
                    error = "saldo";
                }else{
                    try{
                        c.setSaldo(Double.parseDouble(request.getParameter("saldo")));
                    }catch(NumberFormatException e){
                        error = "saldoNoNum";
                    }
                }
            }
        }
        if(!error.equals("")){
            response.sendRedirect("nuevacuenta.jsp?error="+error);
        }else{
            response.sendRedirect("movimientos.jsp");
        }
        
        
    }
}
