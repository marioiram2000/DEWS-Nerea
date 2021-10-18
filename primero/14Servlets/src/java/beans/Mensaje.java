
package beans;


public class Mensaje {
    
    private String emisor;
    private String texto;
    private int aFavor;
    private int enContra;

    public Mensaje(String emisor, String texto) {
        this.emisor = emisor;
        this.texto = texto;
        aFavor=0;
        enContra=0;
    }
    
    public void votarAFavor(){
        aFavor++;
    }
    
    public void votarEnContra(){
        enContra++;
    }

    public String getEmisor() {
        return emisor;
    }

    public String getTexto() {
        return texto;
    }

    public int getaFavor() {
        return aFavor;
    }

    public int getEnContra() {
        return enContra;
    }
}
