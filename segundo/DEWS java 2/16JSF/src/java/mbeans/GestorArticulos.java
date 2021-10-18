/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

import beans.Articulo;
import java.util.ArrayList;

/**
 *
 * @author dw2
 */
public class GestorArticulos {
    
    private ArrayList<Articulo> lstarticulos;
    private ArrayList<String> pedido;

    /**
     * Creates a new instance of GestorArticulos
     */
    public GestorArticulos() {
        
        lstarticulos = new ArrayList<>();
        lstarticulos.add(new Articulo("cebada", 50));
        lstarticulos.add(new Articulo("pan", 26.50f));
        lstarticulos.add(new Articulo("gel", 5));
        
        pedido= new ArrayList<>();
    }

    public ArrayList<Articulo> getLstarticulos() {
        return lstarticulos;
    }

    public void setLstarticulos(ArrayList<Articulo> lstarticulos) {
        this.lstarticulos = lstarticulos;
    }
    
    public String aniadir(String nomArt){
        
        if(!pedido.contains(nomArt)){
            pedido.add(nomArt);
        }
        
        
        return null;
    }
        
    public String quitar(String nomArt){
        
        if(pedido.contains(nomArt)){
            pedido.remove(nomArt);
        }
        
        
        return null;
    }

    public ArrayList<String> getPedido() {
        return pedido;
    }

    public void setPedido(ArrayList<String> pedido) {
        this.pedido = pedido;
    }
    
    
}
