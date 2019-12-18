<%-- 
    Document   : visor_imagenes
    Created on : 18-dic-2019, 8:31:09
    Author     : dw2_alum4
--%>

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
            String imagenes = "imagenes"; 
            private ArrayList<Imagen> sacarImagenes(){
                File carpeta = new File(getServletContext().getRealPath(imagenes));
                String[] array = carpeta.list();
                ArrayList<Imagen> imagenes = new ArrayList<Imagen>();
                for (int i = 0; i < array.length; i++) {
                        String nombre = array[i];                        
                        String ruta = carpeta+"/"+nombre;
                        File foto = new File(ruta);
                        long tamanio = foto.length();
                        Imagen img = new Imagen(ruta, nombre, tamanio);
                    }
                return imagenes;
            }
        %>
    </head>
    <body>
        <h1>Hello World!</h1>
    </body>
</html>
