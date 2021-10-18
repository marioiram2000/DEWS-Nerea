package beans;

import java.io.Serializable;
import java.util.Collection;
import java.util.HashMap;
import java.util.Map;
import jdk.nashorn.internal.runtime.arrays.ArrayLikeIterator;

public class CarroCompra implements Serializable{

    //HashMap<idItem, LineaPedido>
    private HashMap<Integer, LineaPedido> carro;

    public CarroCompra() {
        carro = new HashMap<>();
    }
    
    public void aniadeLinea(LineaPedido l){
        int iditem = l.getItem().getId();
        if(carro.containsKey(iditem)){
            LineaPedido linea = carro.get(iditem);
            linea.setCantidad(linea.getCantidad()+l.getCantidad());
        }else{
            carro.put(iditem, l);
        }
    }
    
    public void borraLinea(int iditem){
        carro.remove(iditem);
    }
    
    public LineaPedido getLineaPedido(int iditem){
        return carro.get(iditem);
    }
    
    public Collection<LineaPedido> getLineasPedido(){
        return carro.values();
    }
    
    public double total(){
        double total = 0;
        
        for (Map.Entry<Integer, LineaPedido> entry : carro.entrySet()) {
            Integer iditem = entry.getKey();
            LineaPedido linea = entry.getValue();
            
            total += linea.getItem().getPrecio()*linea.getCantidad();            
        }
        
        return total;
    }
    
    public void removeAll(){
        carro.clear();
    }
    
    public boolean vacio(){
        return carro.isEmpty();
    }

    @Override
    public String toString() {
        String str = "CarroCompra{" + "carro=";
        for (Map.Entry<Integer, LineaPedido> entry : carro.entrySet()) {
            Integer key = entry.getKey();
            LineaPedido value = entry.getValue();
            str+=value;
        }
        return  str + '}';
    }

    public HashMap<Integer, LineaPedido> getCarro() {
        return carro;
    }
    
    
    
}