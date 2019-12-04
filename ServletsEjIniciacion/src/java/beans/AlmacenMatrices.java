package beans;

import java.util.ArrayList;

public class AlmacenMatrices {
    public static ArrayList<Integer[][]> matrices = new ArrayList<>();

    public static void meterMatriz(Integer[][] matriz){
        matrices.add(matriz);
    }
    public static ArrayList<Integer[][]> getMatrices() {
        return matrices;
    }    
}
