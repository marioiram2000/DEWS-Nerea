package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import javax.servlet.ServletException;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class ServletCompra extends HttpServlet {

    @Override
    public void init() throws ServletException {
        super.init(); 
        HashMap<String, Integer> mapaProductosCantidad = new HashMap<>();
        ArrayList<String> productos = (ArrayList<String>)this.getServletContext().getAttribute("productos");
        for (Iterator<String> it = productos.iterator(); it.hasNext();) {
            String producto = it.next();
            mapaProductosCantidad.put(producto, 0);
        }
        this.getServletContext().setAttribute("mapaProductosCantidad", mapaProductosCantidad);
    }
    
    private void dibujar(HttpServletRequest request, HttpServletResponse response) throws IOException{
        ArrayList<String> productos = (ArrayList<String>)this.getServletContext().getAttribute("productos");
        HttpSession ses = request.getSession();
        if(request.getAttribute("submitFinalizar")!=null){
            finalizarCompra(request);
            ses.invalidate();
            ses = request.getSession();
        }
        
        String maxProducto = getMaxProducto();
        
        HashMap<String, Integer> carro = (HashMap<String, Integer>) ses.getAttribute("carro");
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
        out.println("<!DOCTYPE html>");
        out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet ServletCompra</title>");  
        out.println("</head>");
        out.println("<body>");
            out.print("<table>"
                        + "<tr><th>Producto</th><th>Cantidad</th><th>En el carro</th></tr>");
                        for (Iterator<String> iterator = productos.iterator(); iterator.hasNext();) {
                            String producto = iterator.next();
                            int cantidad = 0;
                            if(carro.containsKey(producto)){
                                cantidad = carro.get(producto);
                            }
                            out.print("<tr>");
                                out.print("<form action='ServletCompra' method='POST'>");
                                    out.println("<td>"+producto+"</td>");
                                    out.println("<td><input type='text' name='cantidad'></td>");
                                    out.print("<td>Llevas "+cantidad+"</td>");
                                    out.print("<td><input type='submit' name='submitAniadir' value='AÑADIR'></td>");
                                    
                                    if(request.getAttribute("NumberFormatError") != null && request.getAttribute("NumberFormatError").equals(producto)){
                                        out.print("<td style='color:red;'>Introduce un número, cazurro</td>");
                                    }else{
                                        out.print("<td></td>");
                                    }
                                    
                                    if(maxProducto==producto){
                                        out.print("<td>!!!Compra</td>");
                                    }
                                    //out.print("<td>"+(HashMap<String, Integer>)this.getServletContext().getAttribute("mapaProductosCantidad").get(producto)+"</td>");
                                    
                                    out.print("<input type='hidden' name='producto' value='"+producto+"'>");
                                out.print("</form>");
                            out.print("</tr>");
                        }
            out.print("</table>");
            out.print("<form action='ServletCompra' method='POST'><input type='submit' name='submitFinalizar' value='FINALIZAR COMPRA'></form>");
        out.println("</body>");
        out.println("</html>");
        }
    }
    
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        HttpSession ses = request.getSession();
        
        HashMap<String, Integer> carro = new HashMap<>();
        ses.setAttribute("carro", carro);
        
        
        
        dibujar(request, response);
    }
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        HttpSession ses = request.getSession();
        HashMap<String, Integer> carro = (HashMap<String, Integer>) ses.getAttribute("carro");
        
        String producto = request.getParameter("producto");
        String c = request.getParameter("cantidad");
        Integer cantidad = -1;
        try{
            cantidad = Integer.parseInt(c);
            if(carro.containsKey(producto)){
                carro.put(producto, (carro.get(producto)+cantidad));
            }else{
                carro.put(producto, cantidad);
            }
        }catch(NumberFormatException e){
            request.setAttribute("NumberFormatError", producto);
        }
        
        dibujar(request, response);
    }
    
    private void finalizarCompra(HttpServletRequest request){
        HttpSession ses = request.getSession();
        HashMap<String, Integer> carro = (HashMap<String, Integer>) ses.getAttribute("carro");
        HashMap<String, Integer> mapaProductosCantidad = (HashMap<String, Integer>)this.getServletContext().getAttribute("mapaProductosCantidad");
        for (Map.Entry<String, Integer> entry : carro.entrySet()) {
            String nombre = entry.getKey();
            Integer cantidad = entry.getValue();
            Integer c = cantidad + mapaProductosCantidad.get(nombre);
            mapaProductosCantidad.put(nombre, c);
        }
        
    }
    
    private String getMaxProducto(){
        int maxCant = -1;
        String maxN = "";
        HashMap<String, Integer> mapaProductosCantidad = (HashMap<String, Integer>)this.getServletContext().getAttribute("mapaProductosCantidad");
        for (Map.Entry<String, Integer> entry : mapaProductosCantidad.entrySet()) {
            String nombre = entry.getKey();
            Integer cantidad = entry.getValue();
            if(cantidad>maxCant){
                maxCant = cantidad;
                maxN = nombre;
            }
        }
        return maxN;
    }
}
