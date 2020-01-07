package Servlets;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashMap;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

public class ServletPrepararProductos extends HttpServlet {

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
        String cat = request.getParameter("cat");
        BufferedReader br = new BufferedReader(new FileReader(getServletContext().getRealPath("archivosTexto/productos.txt")));
        HashMap<String, ArrayList<String>> mapa = new HashMap<String, ArrayList<String>>();
        String linea;
        
        if(cat==null){
            while((linea = br.readLine()) != null){
                String categoria = linea.split(";")[0];
                String producto = linea.split(";")[1];
                if(mapa.containsKey(categoria)){
                    mapa.get(categoria).add(producto);
                }else{
                    ArrayList<String> arl = new ArrayList<>();
                    arl.add(producto);
                    mapa.put(categoria, arl);
                }
            }
        }else{
            ArrayList<String> arl = new ArrayList<>();
            mapa.put(cat, arl);
            while((linea = br.readLine()) != null){
                String categoria = linea.split(";")[0];
                String producto = linea.split(";")[1];
                if(mapa.containsKey(categoria)){
                    mapa.get(categoria).add(producto);
                }
            }
        }
        HttpSession ses = request.getSession(true);
        ses.setAttribute("productos", mapa);
        System.out.println("ha pasado al get");
        response.sendRedirect("compra.jsp");
    }
    
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        
    }
}
