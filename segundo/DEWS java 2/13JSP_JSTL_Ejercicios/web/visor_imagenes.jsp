<%@page import="java.io.File"%>
<%@page import="beans.Imagen"%>
<%@page import="java.util.ArrayList"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <%! private final String RUTAIMAGENES = "imagenes/"; %>
        <%! private ArrayList<Imagen> getImagenes(){
                ArrayList<Imagen> imagenes = new ArrayList<Imagen>();
                File carpeta = new File(getServletContext().getRealPath(RUTAIMAGENES));
                File[] listImgs = carpeta.listFiles();
                for (int i = 0; i < listImgs.length; i++) {
                    String ruta = RUTAIMAGENES+listImgs[i].getName();
                    String nombre = listImgs[i].getName().split("\\.")[0];
                    long tamanio = listImgs[i].length();

                    Imagen img = new Imagen(ruta, nombre, tamanio);
                    imagenes.add(img);
                }
                return imagenes;
            }
        %>
        <% ArrayList<Imagen> imagenes = getImagenes(); %>
    </head>
    <body>
        <h1>Ejercicio 1</h1>
        <div>
            <form method="POST" action="visor_imagenes.jsp">
                <p> Imagen:
                    <select name="ruta">
                    <% for (Imagen img : imagenes) { 
                        out.print("<option value='"+img.getRuta()+"'>"+img.getNombre()+"</option>");
                    } %>
                    </select>
                    Tamaño:
                    <input type="radio" name="tamano" value="300"/> 300px
                    <input type="radio" name="tamano" value="400"/> 400px
                    <input type="radio" name="tamano" value="500"/> 500px
                    <input type="submit" value="VER IMAGEN" name="submitVer"/>
                </p>
            </form>
        </div>
        <div>
            <%
            if(request.getParameter("submitVer")!=null && request.getParameter("ruta")!=null && request.getParameter("tamano")!=null){
                
                String ruta = request.getParameter("ruta");
                Imagen i = null;
                for (Imagen img : imagenes) { 
                    if(img.getRuta().equals(ruta)){
                        i = img;
                    }
                }
                out.print("<p>Tamaño: "+i.tamanioDesglosado()+"</p>");
                out.print("<img src='"+i.getRuta()+"' width='"+request.getParameter("tamano")+"px' alt='img'>");
            }
            %>
        </div>
    </body>
</html>
