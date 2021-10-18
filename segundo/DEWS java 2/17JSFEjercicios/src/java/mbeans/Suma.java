
package mbeans;


public class Suma {

    private int n1;
    private int n2;
    private int resp;
    private String respuestas;
            
    public Suma() {
        n1 = (int) (Math.random()*101) +1;
        n2 = (int) (Math.random()*101) +1;
        respuestas = "";
    }

    public String comprobar(){
        if((n1+n2)==resp){
            respuestas += n1 + " + "+n2+" = "+resp+" CORRECTO" + "<br>";
        }else{
            respuestas += n1 + " + "+n2+" = "+resp+" MAL "+ "<br>";
        }
        
        n1 = (int) (Math.random()*101) +1;
        n2 = (int) (Math.random()*101) +1;
        
        return null;
    }
    
    
    
    
    public int getN1() {
        return n1;
    }

    public void setN1(int n1) {
        this.n1 = n1;
    }

    public int getN2() {
        return n2;
    }

    public void setN2(int n2) {
        this.n2 = n2;
    }

    public int getResp() {
        return resp;
    }

    public void setResp(int resp) {
        this.resp = resp;
    }

    public String getRespuestas() {
        return respuestas;
    }

    public void setRespuestas(String respuestas) {
        this.respuestas = respuestas;
    }

    
}
