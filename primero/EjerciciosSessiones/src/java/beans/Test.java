package beans;

import java.util.ArrayList;
import java.util.Iterator;

public class Test {
    
    private int n_preguntas;
    private ArrayList<Pregunta> preguntas;
    private static Pregunta p1 = new Pregunta("1+", "es dos", new String[]{"4","2","5"}, 2);
    private static Pregunta p2 = new Pregunta("5+5", "es diez", new String[]{"4","10","5","r","i"}, 2);
    private static Pregunta p3 = new Pregunta("2+5", "es siete", new String[]{"4","3","7","5"}, 3);
    private static Pregunta p4 = new Pregunta("2-1", "es 1", new String[]{"4","3","7","1"}, 4);
    private static final Pregunta[] preguntasPreparadas = {p1, p2,p3,p4};
    
    public Test(int n_preguntas) {        
        this.n_preguntas = n_preguntas;
        if(n_preguntas>preguntasPreparadas.length){
            n_preguntas=preguntasPreparadas.length;
        }
        
        for (int i = 0; i < n_preguntas; i++) {
            int j = (int) (Math.random()*(preguntasPreparadas.length));
            Pregunta p = preguntasPreparadas[j];
            while(preguntas.indexOf(p)<0){
                j = (int) (Math.random()*(preguntasPreparadas.length));
                p = preguntasPreparadas[j];
            }
            preguntas.add(p);
        }
    }
    
    public int comprobar(ArrayList<Integer> respuestas){
        int cont = 0;
        Iterator<Integer> resp = respuestas.iterator();
        for (Iterator<Pregunta> iterator = preguntas.iterator(); iterator.hasNext();) {
            Pregunta nextP = iterator.next();
            Integer nextR = resp.next();
            if(nextP.getRespuestaCorrecta()==nextR){
                cont++;
            }
        }        
        return cont;
    }

    public ArrayList<Pregunta> getPreguntas() {
        return preguntas;
    }   
}
