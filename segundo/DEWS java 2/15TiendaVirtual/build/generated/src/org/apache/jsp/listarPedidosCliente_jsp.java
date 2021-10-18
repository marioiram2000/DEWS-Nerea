package org.apache.jsp;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;
import java.util.HashSet;
import beans.LineaPedido;
import java.util.HashMap;
import java.util.Map;
import beans.Pedido;
import beans.Pedido;
import beans.Cliente;

public final class listarPedidosCliente_jsp extends org.apache.jasper.runtime.HttpJspBase
    implements org.apache.jasper.runtime.JspSourceDependent {

  private static final JspFactory _jspxFactory = JspFactory.getDefaultFactory();

  private static java.util.List<String> _jspx_dependants;

  private org.glassfish.jsp.api.ResourceInjector _jspx_resourceInjector;

  public java.util.List<String> getDependants() {
    return _jspx_dependants;
  }

  public void _jspService(HttpServletRequest request, HttpServletResponse response)
        throws java.io.IOException, ServletException {

    PageContext pageContext = null;
    HttpSession session = null;
    ServletContext application = null;
    ServletConfig config = null;
    JspWriter out = null;
    Object page = this;
    JspWriter _jspx_out = null;
    PageContext _jspx_page_context = null;

    try {
      response.setContentType("text/html;charset=UTF-8");
      pageContext = _jspxFactory.getPageContext(this, request, response,
      			null, true, 8192, true);
      _jspx_page_context = pageContext;
      application = pageContext.getServletContext();
      config = pageContext.getServletConfig();
      session = pageContext.getSession();
      out = pageContext.getOut();
      _jspx_out = out;
      _jspx_resourceInjector = (org.glassfish.jsp.api.ResourceInjector) application.getAttribute("com.sun.appserv.jsp.resource.injector");

      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("\n");
      out.write("<!DOCTYPE html>\n");
      out.write("<html>\n");
      out.write("    <head>\n");
      out.write("        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">\n");
      out.write("        <title>JSP Page</title>\n");
      out.write("    </head>\n");
      out.write("    <body>\n");
      out.write("        <h1>TUS PEDIDOS</h1>\n");
      out.write("        <table>\n");
      out.write("            <tr><th>Id</th><th>Coste</th><th>Fehca</th><th>Detalles</th><th>Anular pedido</th></tr>\n");
      out.write("            ");

            HashMap<Integer, Pedido> pedidos = ((Cliente)request.getSession().getAttribute("cliente")).getPedidos();
            
            for (Map.Entry<Integer, Pedido> entry : pedidos.entrySet()) {
                Integer idPedido = entry.getKey();
                Pedido pedido = entry.getValue();
                out.print("<tr>");
                    out.print("<td>"+idPedido+"<td>");
                    out.print("<td>"+pedido.getTotal()+"€<td>");
                    out.print("<td>"+pedido.getFecha()+"<td>");
                    out.print("<td><p><a href='listarPedidosCliente.jsp?idpedido="+idPedido+"'>Detalles del pedido</a></p>");
                    if(request.getParameter("idpedido").equals(idPedido+"")){
                        HashSet<LineaPedido> lineas = pedido.getLineas();
                        for (LineaPedido linea : lineas) {
                            out.print("<p>"+linea.getId()+". "+linea.getItem().getNombre()+" ("+linea.getItem().getPrecio()+"€) "+linea.getCantidad()+" unidades"+"</p>");
                        }
                    }
                    out.print("<td>");
                    out.print("<td><input type='radio' name='anular' value='"+idPedido+"'></td>");
                out.print("</tr>");
            }   
                
            
      out.write("\n");
      out.write("        </table>\n");
      out.write("    </body>\n");
      out.write("</html>\n");
    } catch (Throwable t) {
      if (!(t instanceof SkipPageException)){
        out = _jspx_out;
        if (out != null && out.getBufferSize() != 0)
          out.clearBuffer();
        if (_jspx_page_context != null) _jspx_page_context.handlePageException(t);
        else throw new ServletException(t);
      }
    } finally {
      _jspxFactory.releasePageContext(_jspx_page_context);
    }
  }
}
