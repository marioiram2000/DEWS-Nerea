
package beans;

import java.util.ArrayList;
import javax.sound.midi.SysexMessage;
import jdk.nashorn.internal.runtime.arrays.ArrayLikeIterator;


public class Test {
    private int nPregs;
    private ArrayList<Pregunta> preguntas;
    private static Pregunta[] PREGS = new Pregunta[]{
        new Pregunta("2+2", "Más te vale saberlo", new String[]{"4", "2", "6"}, 0),
        new Pregunta("6+6", "Más te vale saberlo", new String[]{"4", "12", "6"}, 1),
        new Pregunta("numero de continentes",  "menor de 100", new String[]{"2","7","99"}, 1),
        new Pregunta("¿Oceania es un continente?", "no es no", new String[]{"si","no","¿ como ?"}, 0),
        new Pregunta("¿ aprobaré servidor ?", "suerte", new String[]{"no","si","con ayuda de dios"}, 2),
        new Pregunta("2+1", "Más te vale saberlo", new String[]{"4", "2", "3"}, 2)};

    public Test(int nPregs) {
        this.nPregs = nPregs;
        this.preguntas = new ArrayList<>();
        int max;
        if(nPregs<PREGS.length){
            max = nPregs;
        }else{
            max = PREGS.length;
        }
        
        while(preguntas.size()<max){
            int i = (int) (Math.random()*PREGS.length);
            
            if(!preguntas.contains(PREGS[i])){
                preguntas.add(PREGS[i]);
            }
        }
        //System.err.println(preguntas.toString());
    }
    
    public int comprobar(ArrayList<Integer> resps){
        int aciertos = 0;
        
        for (int i = 0; i < resps.size(); i++) {
            Integer resp = resps.get(i);
            if(preguntas.get(i).getCorrecta()==resp){
                aciertos++;
            }
        }
        
        return aciertos;
    }

    public int getnPregs() {
        return nPregs;
    }

    public void setnPregs(int nPregs) {
        this.nPregs = nPregs;
    }

    public ArrayList<Pregunta> getPreguntas() {
        return preguntas;
    }

    public void setPreguntas(ArrayList<Pregunta> preguntas) {
        this.preguntas = preguntas;
    }

    public static Pregunta[] getPREGS() {
        return PREGS;
    }

    public static void setPREGS(Pregunta[] PREGS) {
        Test.PREGS = PREGS;
    }
    
    
}
