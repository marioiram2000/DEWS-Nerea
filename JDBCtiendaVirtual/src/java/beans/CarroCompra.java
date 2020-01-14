
package beans;

import java.util.Collection;
import java.util.HashMap;
import java.util.Iterator;

public class CarroCompra {

    HashMap<Integer, LineaPedido> carro = new HashMap();
    
    public void aniadeLinea(LineaPedido l){
        if(carro.containsKey(l.getId())){
            carro.get(l.getId()).setCantidad((l.getCantidad()+1));
        }else{
            carro.put(l.getId(), l);
        }
    }
    
    public void borrarLinea(int idItem){
        carro.remove(idItem);
    }
    
    public LineaPedido getLineaPedido(int idItem){
        return carro.get(idItem);
    }
    
    public Collection<LineaPedido> getLineasPedido(){
        return carro.values();
    }
    
    public double total(){
        double total = 0;
        Iterator it = carro.keySet().iterator();
        while(it.hasNext()){
            Integer id = (Integer) it.next();
            LineaPedido lp = carro.get(id);
            Item item = lp.getItem();
            int cantidad = lp.getCantidad();
            double precio = item.getPrecio();
            
            total += cantidad*precio;
        }
        return total;
    }
    
    public void removeAll(){
        Iterator it = carro.keySet().iterator();
        while(it.hasNext()){
            Integer id = (Integer) it.next();
            carro.remove(id);
        }
    }
    
    public boolean vacio(){
        return carro.isEmpty();
    }
    
}
