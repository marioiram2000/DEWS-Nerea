package servlets;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;


public class Ej3EscribeApuesta extends HttpServlet {

    private static String ruta;

    @Override
    public void init() throws ServletException {
        ruta = this.getServletContext().getRealPath(this.getInitParameter("ruta"));
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException{
        doPost(request, response);
    }
    
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    throws ServletException, IOException {
        BufferedReader bf = new BufferedReader(new FileReader(ruta));
        HttpSession s = request.getSession();
        
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {

        out.println("<!DOCTYPE html>");
        out.println("<html>");
        out.println("<head>");
        out.println("<title>Servlet EscribeApuesta</title>");  
        out.println("</head>");
        out.println("<body>");
        out.print("<h1>"+request.getParameter("nombre")+", rellena tu apuesta</h1>");
        out.println("<form method='POST' action='Ej3procesaApuesta'>");
        out.println("<table>");
            int cont = 0;
            String linea = bf.readLine();
            while(linea!=null){
                    out.print("<tr>");
                    String[] l = linea.split("\t");
                    out.print("<td>"+l[0]+"</td>");
                    out.print("<td>"+l[1]+"</td>");
                    out.print("<td>");
                        out.print("<select name='apuestas'>");
                            if(s.getAttribute("apuestas")!=null){
                                String[] apuestas = (String[]) s.getAttribute("apuestas");
                                switch(apuestas[cont]){
                                    case "0":
                                            out.print("<option value='0'></option>");
                                            out.print("<option value='1'>1</option>");
                                            out.print("<option value='X'>X</option>");
                                            out.print("<option value='2'>2</option>");
                                            break;
                                    case "1":
                                            out.print("<option value='0'></option>");
                                            out.print("<option value='1' selected>1</option>");
                                            out.print("<option value='X'>X</option>");
                                            out.print("<option value='2'>2</option>");
                                            break;
                                    case "X":
                                            out.print("<option value='0'></option>");
                                            out.print("<option value='1'>1</option>");
                                            out.print("<option value='X' selected>X</option>");
                                            out.print("<option value='2'>2</option>");
                                            break;
                                    case "2":
                                            out.print("<option value='0'></option>");
                                            out.print("<option value='1'>1</option>");
                                            out.print("<option value='X'>X</option>");
                                            out.print("<option value='2' selected>2</option>");
                                            break;
                                            
                                }
                            }else{
                                out.print("<option value='0'></option>");
                                out.print("<option value='1'>1</option>");
                                out.print("<option value='X'>X</option>");
                                out.print("<option value='2'>2</option>");
                            }
                            
                        out.print("</select>");
                    out.print("</td>");
                out.print("</tr>");
                out.print("<input type='hidden' value='"+l[0]+":"+l[1]+"' name='partidos'>");
                linea = bf.readLine();
                cont ++;
            }
        out.println("</table>");
        out.print("<input type='hidden' value='"+request.getParameter("nombre")+"' name='nombre'>");
        out.print("<input type='submit' name='submit' value='GUARDAR APUESTA'/>");
        out.println("</form>");
        out.println("</body>");
        out.println("</html>");
        }
        bf.close();        
    }
}
