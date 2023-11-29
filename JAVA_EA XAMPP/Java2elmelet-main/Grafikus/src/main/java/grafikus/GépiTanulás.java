package grafikus;

import weka.classifiers.bayes.NaiveBayes;
import weka.classifiers.functions.SMO;
import weka.classifiers.lazy.IBk;
import weka.classifiers.trees.J48;
import weka.classifiers.trees.RandomForest;
import weka.core.Utils;

public class GépiTanulás {

    public void run() throws Exception {
        String fájlNév = "data/labor.arff";
        int classIndex = 16; // 20. oszlopot kell előre jelezni

        new GépiTanulás1(fájlNév, classIndex);

        // Különböző osztályozási algoritmusokkal való keresztvalidáció


        IBk classifier = new IBk();
        // 10 legközelebbi szomszéd:
        classifier.setOptions(Utils.splitOptions("-K 10"));
        new GépiTanulás2CrossValidation(fájlNév, classIndex, classifier);


    }

    public void arg2()
    {
        String fájlNév = "data/labor.arff";
        int classIndex = 16; // 20. oszlopot kell előre jelezni
        new GépiTanulás2CrossValidation(fájlNév, classIndex, new J48());
        new GépiTanulás2CrossValidation(fájlNév, classIndex, new SMO());
        new GépiTanulás2CrossValidation(fájlNév, classIndex, new NaiveBayes());
        new GépiTanulás2CrossValidation(fájlNév, classIndex, new RandomForest());
    }
    public void arg3(int choice) throws Exception {
        String fájlNév = "data/labor.arff";
        int classIndex = 16; // 20. oszlopot kell előre jelezni

        IBk classifier = new IBk();
        // 10 legközelebbi szomszéd:
        classifier.setOptions(Utils.splitOptions("-K 10"));
        int valami=choice;

        switch (valami) {

            case 1:
                // Kezelés a választásnak 1
                new GépiTanulás2CrossValidation(fájlNév, classIndex, new J48());
                break;
            case 2:
                // Kezelés a választásnak 2
                new GépiTanulás2CrossValidation(fájlNév, classIndex, new SMO());
                break;
            case 3:
                // Kezelés a választásnak 3
                new GépiTanulás2CrossValidation(fájlNév, classIndex, new NaiveBayes());
                break;
            case 4:
                // Kezelés a választásnak 4
                new GépiTanulás2CrossValidation(fájlNév, classIndex, new RandomForest());
                break;
            case 5:
                // Kezelés a választásnak 5
                new GépiTanulás2CrossValidation(fájlNév, classIndex, classifier);
                break;
            default:
                // Ha az érték nem esik egyik case-be sem
                System.out.println("Nem érvényes választás");
                break;
        }
    }

}






