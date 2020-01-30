package mbeans;

import beans.Punto;
import java.util.ArrayList;
import javax.faces.application.FacesMessage;
import javax.faces.component.UIComponent;
import javax.faces.context.FacesContext;

/**
 *
 * @author dw2_alum4
 */
public class GestorDePuntos {

    private ArrayList<Punto> puntos;
    private String punto;
    private Punto puntoEscogido;
    private Punto puntoAleatorio;
    private Double resul;
    private boolean acierto;
    
    public GestorDePuntos() {
        puntos = new ArrayList<>();
        puntos.add(new Punto(3, 4));
        puntos.add(new Punto(0, 0));
        puntos.add(new Punto(2, 2));
        puntos.add(new Punto(6, 1));
        puntos.add(new Punto(3, 3));
    }

    public String sacarPunto(){
        int x = (int) (Math.random()*11);
        int y = (int) (Math.random()*11);
        puntoAleatorio = new Punto(x, y);
        return null;
    }
    
    
    public double calcularDistancia() {
        int cateto1 = puntoEscogido.getX() - puntoAleatorio.getX();
        int cateto2 = puntoEscogido.getY() - puntoAleatorio.getY();
        double hipotenusa = Math.sqrt(cateto1*cateto1 + cateto2*cateto2);
        return hipotenusa;
    }
    
    public String comprobarResul(){            
        if(resul==calcularDistancia()){
            
            acierto=true;
        }else{
            
            acierto=false;
        }
        
        return null;
    }
    
    
    
    public ArrayList<Punto> getPuntos() {
        return puntos;
    }

    public void setPuntos(ArrayList<Punto> puntos) {
        this.puntos = puntos;
    }

    public String getPunto() {
        return punto;
    }

    public void setPunto(String punto) {
        puntoEscogido = new Punto(Integer.parseInt(punto.charAt(1)+""), Integer.parseInt(punto.charAt(4)+""));
        this.punto = punto;
    }

    public Punto getPuntoAleatorio() {
        return puntoAleatorio;
    }

    public void setPuntoAleatorio(Punto puntoAleatorio) {
        this.puntoAleatorio = puntoAleatorio;
    }

    public Punto getPuntoEscogido() {
        return puntoEscogido;
    }

    public void setPuntoEscogido(Punto puntoEscogido) {
        this.puntoEscogido = puntoEscogido;
    }

    public Double getResul() {
        return resul;
    }

    public void setResul(Double resul) {
        this.resul = resul;
    }

    public boolean isAcierto() {
        return acierto;
    }

    public void setAcierto(boolean acierto) {
        this.acierto = acierto;
    }

    
    
    
}