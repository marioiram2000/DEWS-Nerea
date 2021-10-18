package mbeans;

import beans.Pregunta;
import java.util.ArrayList;


public class MBTest {

    private int index;
    private int aciertos;
    private Pregunta[] preguntas;
    private boolean[] respuestas;
    private Pregunta[] pregs;
    private int cantPregs;
    
    public MBTest() {
        preguntas = new Pregunta[] {new Pregunta("Capital de Españita", "Mandril"),
                    new Pregunta("Mejor ave no voladora", "Pingüino"),
                    new Pregunta("Ave más peligrosa", "Casuario"),
                    new Pregunta("Mamifero terrestre con el pene más grande", "Tapir"),
                    new Pregunta("Profesión de carrero", "Astronauta")};
        index = 0;
        aciertos = 0;
        respuestas = new boolean[preguntas.length];
        cantPregs = 0;
    }

    public Pregunta[] getPreguntas() {
        return preguntas;
    }
    public void setPreguntas(Pregunta[] preguntas) {
        this.preguntas = preguntas;
    }
    public int getIndex() {
        return index;
    }
    public void setIndex(int index) {
        this.index = index;
    }
    public int getAciertos() {
        return aciertos;
    }
    public void setAciertos(int aciertos) {
        this.aciertos = aciertos;
    }
    public boolean[] getRespuestas() {
        return respuestas;
    }
    public void setRespuestas(boolean[] respuestas) {
        this.respuestas = respuestas;
    }
    public int getLength(){
        return preguntas.length;
    }
    public Pregunta[] getPregs() {
        return pregs;
    }
    public void setPregs(Pregunta[] pregs) {
        this.pregs = pregs;
    }
    public int getCantPregs() {
        return cantPregs;
    }
    public void setCantPregs(int cantPregs) {
        this.cantPregs = cantPregs;
        pregs = new Pregunta[cantPregs];
    }
    
    public void setPregs(){
        ArrayList<Pregunta> aux = new ArrayList<Pregunta>();
        while(aux.size()< pregs.length){
            Pregunta p = preguntas[(int) (Math.random()*preguntas.length)];
            if(!aux.contains(p)){
                aux.add(p);
            }
        }
        for (int i = 0; i < aux.size(); i++) {
            pregs[i] = aux.get(i);
        }
        
    }
    
    public String comprobar(){
        System.out.println("INDEX: "+index);
        if(pregs[index].getRespOK().toLowerCase().equals(pregs[index].getRespUsu().toLowerCase())){
            aciertos ++;
            respuestas[index] = true;
        }else{
            respuestas[index] = false;
        }
        index ++;
        if(index==pregs.length){
            System.out.println("Pregs.length: "+pregs.length);
            return "resultTest";
        }
        return "test";
    }
    
}
