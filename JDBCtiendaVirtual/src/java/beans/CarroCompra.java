
package beans;

import java.util.Collection;
import java.util.HashMap;
import java.util.Iterator;

public class CarroCompra {

    public HashMap<Integer, LineaPedido> carro = new HashMap();
    
    public void aniadeLinea(LineaPedido l){
        boolean control = false;
        for(HashMap.Entry <Integer, LineaPedido> linea : this.carro.entrySet()){
            Integer idItem = linea.getKey();            
            if(idItem == l.getItem().getId()){
                control = true;
            }
        }
        
        if(control){
            LineaPedido lp = carro.get(l.getItem().getId());
            lp.setCantidad((l.getCantidad()+lp.getCantidad()));
            carro.put(l.getItem().getId(), lp);
        }else{
            carro.put(l.getItem().getId(), l);
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

    @Override
    public String toString() {
        return "CarroCompra{" + "carro=" + carro + '}';
    }
    
}
