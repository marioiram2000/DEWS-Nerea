/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package mbeans;

public class Sumador {

    private int num1;
    private int num2;
    
    private int respUsu;
    
    
    public Sumador() {
        
        num1=(int)(Math.random()*101);
        num2=(int)(Math.random()*101);
    }

    public int getNum1() {
        return num1;
    }

    public void setNum1(int num1) {
        this.num1 = num1;
    }

    public int getNum2() {
        return num2;
    }

    public void setNum2(int num2) {
        this.num2 = num2;
    }

    public int getRespUsu() {
        return respUsu;
    }

    public void setRespUsu(int respUsu) {
        this.respUsu = respUsu;
    }
    
    public String comprobar(){
        
        
        if (respUsu==(num1+num2))
            return "exito";  //Caso de navegacion
        else
            return "fracaso"; //Caso de navegacion
    }
    
    
    
}
