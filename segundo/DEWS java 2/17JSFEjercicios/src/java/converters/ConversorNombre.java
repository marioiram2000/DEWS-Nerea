package converters;

import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;

public class ConversorNombre implements Converter{

    @Override
    public Object getAsObject(FacesContext context, UIComponent component, String value) {
        //throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
        return new String(value);
    }

    @Override
    public String getAsString(FacesContext context, UIComponent component, Object value) {
        String str=((String)value);
        
        String[] partes = str.split(" ");
        String aux = "";
        for (int i = 0; i < partes.length; i++) {
            String parte = partes[i];
            aux += (parte.charAt(0)+"").toUpperCase();
            aux += parte.substring(1).toLowerCase();
            aux += " ";
        }  
        return aux;
    }

}
