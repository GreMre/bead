package grafikus;

import weka.classifiers.Evaluation;
import weka.classifiers.trees.J48;
import weka.core.Instances;
import java.io.BufferedReader;
import java.io.FileReader;
import java.io.PrintWriter;
import java.util.Random;

public class GépiTanulás1 {
    GépiTanulás1(String fájlNév, int classIndex) {
        try {
            // Adatok beolvasása
            BufferedReader bufferedReader = new BufferedReader(new FileReader(fájlNév));
            Instances instances = new Instances(bufferedReader);
            System.out.println("instances.size():" + instances.size());
            instances.setClassIndex(classIndex);

            // Tanító és kiértékelő adathalmazok elkészítése
            Instances tanító, kiértékelő;
            J48 classifier;
            Evaluation evaluation;
            classifier = new J48();

            // Randomizálás (opcionális)
            if (false) instances.randomize(new Random());
            tanító = new Instances(instances, 0, 9 * instances.size() / 10);
            System.out.println("tanító.size():" + tanító.size());
            kiértékelő = new Instances(instances, 9 * instances.size() / 10, instances.size() / 10);
            System.out.println("kiértékelő.size():" + kiértékelő.size());

            // Döntési fa tanítása
            classifier.buildClassifier(tanító);
            evaluation = new Evaluation(kiértékelő);
            double[] eredmeny = evaluation.evaluateModel(classifier, kiértékelő);

            // Eredmények kiíratása
            System.out.println(evaluation.toSummaryString("\nResults", false));
            System.out.println("Correctly Classified Instances:" + (int) evaluation.correct());
            System.out.println("Incorrectly Classified Instances:" + (kiértékelő.size() - (int) evaluation.correct()));
            System.out.println(classifier.toString());

            // Döntési fa kiírása fájlba
            PrintWriter kiir = new PrintWriter("Döntési fa.txt");
            kiir.println(classifier.toString());
            kiir.close();
        } catch (Exception e) {
            System.out.println("Error Occurred!!!! \n" + e.getMessage());
        }
    }
}