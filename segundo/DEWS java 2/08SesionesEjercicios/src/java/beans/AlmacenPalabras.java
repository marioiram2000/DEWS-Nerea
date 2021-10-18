package beans;

public class AlmacenPalabras {
    private String[] palabras;

    public AlmacenPalabras() {
        this.palabras = new String[]{"jon", "casa", "merienda", "murcielago"};
    }
    
    public String getPalabra(){
        int i = (int)(Math.random()*(palabras.length-1))+1;
        return palabras[i];
    }
    
}
