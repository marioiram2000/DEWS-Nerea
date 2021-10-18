package mbeans;

import beans.Cliente;
import dao.DaoClientes;
import java.io.Serializable;
import java.util.ArrayList;


public class MBRegistro implements Serializable{

    private ArrayList<Cliente> clientes;
    private Cliente cliente;
    
    public MBRegistro() {
        instanciarValores();
    }

    public Cliente getCliente() {
        return cliente;
    }
    public void setCliente(Cliente cliente) {
        this.cliente = cliente;
    }
    public ArrayList<Cliente> getClientes() {
        return clientes;
    }
    public void setClientes(ArrayList<Cliente> clientes) {
        this.clientes = clientes;
    }
    
    public void registro(){
        //DaoClientes.insertCliente(cliente);
        instanciarValores();
    }

    private void instanciarValores(){
        clientes = DaoClientes.getClientes();
        cliente = new Cliente();
    }
}
