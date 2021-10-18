<%-- 
    Document   : visor_imagenes
    Created on : 18-dic-2019, 8:31:09
    Author     : dw2_alum4
--%>

<%@page import="java.util.Iterator"%>
<%@page import="java.io.File"%>
<%@page import="java.util.ArrayList"%>
<%@page import="Beans.Imagen"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        <%! 
            String nomcarpeta = "imagenes";  
            Imagen imagenSeleccionada = null;
            private ArrayList<Imagen> sacarImagenes(){
                File carpeta = new File(getServletContext().getRealPath(nomcarpeta));
                String[] array = carpeta.list();
                ArrayList<Imagen> imagenes = new ArrayList<Imagen>();
                for (int i = 0; i < array.length; i++) {
                        String nombre = array[i];     
                        File foto = new File(carpeta+"\\"+nombre);
                        String ruta = nomcarpeta+"\\"+nombre;
                        //nombre = nombre.substring(0, nombre.lastIndexOf("."));
                        nombre = nombre.split("\\.")[0];
                        
                        long tamanio = foto.length();
                        Imagen img = new Imagen(ruta, nombre, tamanio);
                        imagenes.add(img);
                    }
                return imagenes;
            }

            private Imagen sacarImagen(String ruta){
                ArrayList<Imagen> imagenes = sacarImagenes();
                for (Iterator it = imagenes.iterator(); it.hasNext();) {
                    
                }
                return null;
            }
        %>
    </head>
    <body>
        <form action="">
            <p>Imagen:
                <select name="imagen">
                    <%
                        ArrayList<Imagen> imagenes = sacarImagenes();
                        for (Iterator it = imagenes.iterator(); it.hasNext();) {
                                Imagen imagen = (Imagen)it.next();
                                String ruta = imagen.getRuta();
                                String nombre = imagen.getNombre();
                                String selected = "";
                                if(request.getParameter("imagen") != null && request.getParameter("imagen").equals(ruta)){
                                    selected = "selected";
                                    imagenSeleccionada = imagen;
                                }
                                out.println("<option value='"+ruta+"'"+selected+">"+nombre+"</option>");
                        }
                    %>
                </select>
            </p>         
            <p>
                Tamaño:
                <br><br>
                <input type="radio" name="tam" value="300px" required>300px<br>
                <input type="radio" name="tam" value="400px" required>400px<br>
                <input type="radio" name="tam" value="500px" required>500px<br>
            </p>
            <p><input type="submit" value="VER IMAGEN" name="submit" id="submit"></p>
        </form>
        <%  
            if(imagenSeleccionada!=null){
                out.println("<p>Tamaño  "+imagenSeleccionada.tamanioDesglosado()+"</p>");
                out.println("<img src='"+imagenSeleccionada.getRuta()+""
                        + "'alt='"+imagenSeleccionada.getNombre()+"'"
                        + "width='"+request.getParameter("tam")+"'>");
            }
            %>
    </body>
</html>
