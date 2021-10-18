package validators;

import java.util.ArrayList;
import java.util.Collection;
import javax.faces.application.FacesMessage;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;
import javax.faces.validator.Validator;
import javax.faces.validator.ValidatorException;

public class ValidadorEmail implements Validator{

    private final static String[] DOMINIOSPROHIBIDOS = {"es","en"}; 
    @Override
    public void validate(FacesContext context, UIComponent component, Object value) throws ValidatorException {
        
        String email = (String)value;
        if(!email.matches("^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$")){
            context.addMessage(component.getClientId(context),new FacesMessage("Email invalido"));
        }else{
            boolean prohibido = false;
            String dominio = email.substring(email.lastIndexOf(".")+1);
            for (int i = 0; i < DOMINIOSPROHIBIDOS.length; i++) {
                String string = DOMINIOSPROHIBIDOS[i];
                if(dominio.equals(string)){
                    prohibido = true;
                    break;
                }
            }
            if(prohibido){
                context.addMessage(component.getClientId(context),new FacesMessage("Ese dominio está prohibido en este sitio web"));
            }
        }
    }

}
