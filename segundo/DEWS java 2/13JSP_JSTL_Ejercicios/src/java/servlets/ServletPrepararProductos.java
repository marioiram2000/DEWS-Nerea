package servlets;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletPrepararProductos extends HttpServlet {

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        String cat = request.getParameter("cat");
        HttpSession ses = request.getSession();
        ArrayList<String> productos = new ArrayList();
        //if(ses.getAttribute("prodCat")==null){
            BufferedReader bf = new BufferedReader(new FileReader(this.getServletContext().getRealPath(this.getInitParameter("productos"))));
            String linea = bf.readLine();
            while (linea != null) {
                String[] partes = linea.split(";");                
                if(partes.length > 1){
                    if(partes[0].equals(cat) || cat == null){
                        productos.add(partes[1]);
                        System.err.println(cat+"adio");
                    }else{
                        System.err.println(cat+"Hola");
                    }
                }
                linea = bf.readLine();
            }            
            bf.close();
        //}
        ses.setAttribute("cat", cat);
        ses.setAttribute("productos", productos);
        response.sendRedirect("compra.jsp");
    } 

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        response.sendError(403);
    }
}
