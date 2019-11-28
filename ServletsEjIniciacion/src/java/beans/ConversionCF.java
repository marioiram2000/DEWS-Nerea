package beans;
public class ConversionCF {
    
    float c;
    float f;

    public ConversionCF(float t, char tipo) {
        if(tipo=='c'){
            c = t;
            f = c * (float) 9/5 + 32;
        }
        if(tipo=='f'){
            f = t;
            c = (f-32) * (float) 5/9;
        }
    }

    public float getC() {
        return c;
    }
    
    public float getF() {
        return f;
    }

    
    
}
