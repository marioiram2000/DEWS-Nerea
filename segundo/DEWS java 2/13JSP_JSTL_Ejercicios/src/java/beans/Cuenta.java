package beans;
public class Cuenta {
    
    private String titular;
    private double saldo;
    
    public Cuenta(String titular, double saldo) {
        this.titular = titular;
        this.saldo = saldo;
    }

    public Cuenta() {
    }
    
    
    public boolean gastar(double n){
        if(n>saldo){
            return false;
        }else{
            saldo -= n;
            return true;
        }
    }
    
    public void ingresar(double n){
        saldo += n;
    }
        
    public String getTitular() {
        return titular;
    }

    public void setTitular(String titular) {
        this.titular = titular;
    }

    public double getSaldo() {
        return saldo;
    }

    public void setSaldo(double saldo) {
        this.saldo = saldo;
    }
    
    
}
