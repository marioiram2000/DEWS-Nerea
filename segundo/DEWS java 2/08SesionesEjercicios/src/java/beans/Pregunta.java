package beans;

import java.util.Objects;

public class Pregunta {
    private String enunciado;
    private String pista;
    private String[] respuestas;
    private int correcta;

    public Pregunta(String enunciado, String pista, String[] respuestas, int correcta) {
        this.enunciado = enunciado;
        this.pista = pista;
        this.respuestas = respuestas;
        this.correcta = correcta;
    }

    @Override
    public int hashCode() {
        int hash = 5;
        hash = 17 * hash + Objects.hashCode(this.enunciado);
        return hash;
    }

    @Override
    public boolean equals(Object obj) {
        if (obj == null) {
            return false;
        }
        if (getClass() != obj.getClass()) {
            return false;
        }
        final Pregunta other = (Pregunta) obj;
        if (!Objects.equals(this.enunciado, other.enunciado)) {
            return false;
        }
        return true;
    }

    @Override
    public String toString() {
        return "Pregunta{" + "enunciado=" + enunciado + ", pista=" + pista + ", respuestas=" + respuestas + ", correcta=" + correcta + '}';
    }

    public String getEnunciado() {
        return enunciado;
    }

    public void setEnunciado(String enunciado) {
        this.enunciado = enunciado;
    }

    public String getPista() {
        return pista;
    }

    public void setPista(String pista) {
        this.pista = pista;
    }

    public String[] getRespuestas() {
        return respuestas;
    }

    public void setRespuestas(String[] respuestas) {
        this.respuestas = respuestas;
    }

    public int getCorrecta() {
        return correcta;
    }

    public void setCorrecta(int correcta) {
        this.correcta = correcta;
    }
    
}
