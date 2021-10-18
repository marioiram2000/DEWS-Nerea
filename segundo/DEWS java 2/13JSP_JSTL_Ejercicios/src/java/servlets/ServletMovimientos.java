package servlets;
import beans.Cuenta;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ServletMovimientos extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.sendError(403);
        
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        if(request.getParameter("submitIngresar")==null && request.getParameter("submitGastar")==null){
            response.sendError(403);
        }
        
        Cuenta c = (Cuenta)request.getSession().getAttribute("cuenta");
        String error = "";
        try{
            double cant = Double.parseDouble(request.getParameter("cantidad"));
            
            if(request.getParameter("submitIngresar")!=null){
                c.ingresar(cant);
            }else{
                if(!c.gastar(cant)){
                    error="La cuenta solo dispone de "+c.getSaldo()+"€";
                }
            }
        }catch(NumberFormatException e){
            error="Ingrese una cantidad valida";
        }
        
        if(!error.equals("")){
            response.sendRedirect("movimientos.jsp?error="+error);
        }else{
            response.sendRedirect("movimientos.jsp");
        }
        
    }
}
