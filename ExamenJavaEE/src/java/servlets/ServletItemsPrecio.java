package servlets;

import dao.DaoExam;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashSet;
import java.util.Iterator;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletItemsPrecio extends HttpServlet {

    double[] preciosMinMax;
    @Override
    public void init() throws ServletException {
        super.init();      
        preciosMinMax = DaoExam.preciosMinMax();
        
        //System.out.println(precios[0]+"-"+precios[1]);
    }

    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //System.out.println("------------servlets.ServletItemsPrecio.doGet()");
        HttpSession ses = request.getSession(true);
        ses.setAttribute("precioMin", preciosMinMax[0]);
        ses.setAttribute("precioMax", preciosMinMax[1]);
        response.sendRedirect("selectItems.jsp");
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        //System.out.println("-----------------------servlets.ServletItemsPrecio.doPost()");
        String smin = request.getParameter("min");
        String smax = request.getParameter("max");
        
        request.setAttribute("error", " ");
       
        try{
            double min = Double.parseDouble(smin);
            double max = Double.parseDouble(smax);
            
            if(min>max || min<0 || max<0){
                request.setAttribute("error", "Debes introducir unos datos válidos");
                request.getRequestDispatcher("selectItems.jsp").forward(request, response);
            }
            HttpSession ses = request.getSession();
            ses.setAttribute("precioMin", min);
            ses.setAttribute("precioMax", max);
            
            HashSet hs = DaoExam.itemsPorPrecio(min, max);
            //System.out.println("----------------------------------HS: "+hs.toString());
            
            ses.setAttribute("itemsPorPrecio", hs);
            request.getRequestDispatcher("selectItems.jsp").forward(request, response);
            
        }catch(NumberFormatException ex){
            request.setAttribute("error", "Debes introducir una cifra");
            request.getRequestDispatcher("selectItems.jsp").forward(request, response);
        }
        //System.out.println("----------min:"+min+" max:"+max);
    }


}
