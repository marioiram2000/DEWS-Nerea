package converters;

import beans.Ciclo;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.convert.Converter;

public class ConversorCiclo implements Converter{

    @Override
    public Object getAsObject(FacesContext context, UIComponent component, String value) {
        String[] partes = value.split(":");
        int id = Integer.parseInt(partes[0]);
        String nombre = partes[1];
        int duracion = Integer.parseInt(partes[2]);
        return new Ciclo(id, nombre, duracion);
    }

    @Override
    public String getAsString(FacesContext context, UIComponent component, Object value) {
        //Pasar objeto ciclo a String
        Ciclo ciclo = (Ciclo) value;
        return ciclo.getId()+":"+ciclo.getNombre()+":"+ciclo.getDuracion();
    }

}
