
package beans;

import java.util.ArrayList;


public class AlmacenMensajes {
    
    
    private static ArrayList<Mensaje> mensajes=new ArrayList<Mensaje>();

    public static ArrayList<Mensaje> getMensajes() {
        return mensajes;
    }
    
    
    public static void aniadirMensaje(Mensaje m){
        mensajes.add(m);
    }
    
    
    public static Mensaje dameMensaje(int i){
        return mensajes.get(i);
    }
    
    public static int tamAlmacen(){
        return mensajes.size();
    }
    
    public static void votoAFavor(int i){
        mensajes.get(i).votarAFavor();
    }
    
      public static void votoEnContra(int i){
        mensajes.get(i).votarEnContra();
    }
    
}
