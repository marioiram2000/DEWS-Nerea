package beans;
public class Pregunta {

    private String pregunta;
    private String respOK;
    private String respUsu;

    public Pregunta() {
    }

    public Pregunta(String pregunta, String respOK, String respUsu) {
        this.pregunta = pregunta;
        this.respOK = respOK;
        this.respUsu = respUsu;
    }

    public Pregunta(String pregunta, String respOK) {
        this.pregunta = pregunta;
        this.respOK = respOK;
    }

    public String getPregunta() {
        return pregunta;
    }

    public void setPregunta(String pregunta) {
        this.pregunta = pregunta;
    }

    public String getRespOK() {
        return respOK;
    }

    public void setRespOK(String respOK) {
        this.respOK = respOK;
    }

    public String getRespUsu() {
        return respUsu;
    }

    public void setRespUsu(String respUsu) {
        this.respUsu = respUsu;
    }

    public boolean testCorrecta(){
        if(respOK.toLowerCase().equals(respUsu.toLowerCase())){
            return true;
        }
        return false;
    }
    
    @Override
    public String toString() {
        return "Pregunta{" + "pregunta=" + pregunta + ", respOK=" + respOK + ", respUsu=" + respUsu + '}';
    }
    
    
}
