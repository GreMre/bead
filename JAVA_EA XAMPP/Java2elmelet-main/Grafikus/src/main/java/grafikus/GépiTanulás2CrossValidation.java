package grafikus;

import weka.classifiers.Classifier;
import weka.classifiers.Evaluation;
import weka.core.Instances;
import java.io.BufferedReader;
import java.io.FileReader;
import java.util.Random;
import java.io.FileWriter;
import java.io.PrintWriter;

public class GépiTanulás2CrossValidation {
    public GépiTanulás2CrossValidation(String fájlNév, int classIndex, Classifier classifier) {
        try {
            BufferedReader bufferedReader = new BufferedReader(new FileReader(fájlNév));
            Instances instances = new Instances(bufferedReader);
            instances.setClassIndex(classIndex);

            if (false) instances.randomize(new Random());
            Evaluation evaluation = new Evaluation(instances);
            evaluation.crossValidateModel(classifier, instances, 10, new Random(1));



            // Kiírás a GepiTanulas.txt fájlba
            String outputFileName = "GepiTanulas.txt";
            PrintWriter kiir = new PrintWriter(new FileWriter(outputFileName, true)); // true: append módban nyitja meg a fájlt
            kiir.println("Algorithm: " + classifier.getClass().getSimpleName()); // Az algoritmus nevét használja
            kiir.println(evaluation.toSummaryString("\nResults", false));
            kiir.println("Correctly Classified Instances: " + (int) evaluation.correct() + "\t" + 100 * evaluation.correct() / instances.size() + "%");
            kiir.println("Incorrectly Classified Instances: " + (instances.size() - (int) evaluation.correct()));
            kiir.println();
            kiir.close();


        } catch (Exception e) {
            System.out.println("Error Occurred!!!! \n" + e.getMessage());
        }
        try {
            BufferedReader bufferedReader = new BufferedReader(new FileReader(fájlNév));
            Instances instances = new Instances(bufferedReader);
            instances.setClassIndex(classIndex);

            if (false) instances.randomize(new Random());
            Evaluation evaluation = new Evaluation(instances);
            evaluation.crossValidateModel(classifier, instances, 10, new Random(1));

            // Kiírás a seged.txt fájlba
            String outputFileName = "seged.txt";
            PrintWriter kiir = new PrintWriter(new FileWriter(outputFileName, false)); // false: mindig felülírja a fájlt
            kiir.println("Algorithm: " + classifier.getClass().getSimpleName()); // Az algoritmus nevét használja
            kiir.println(evaluation.toSummaryString("\nResults", false));
            kiir.println("Correctly Classified Instances: " + (int) evaluation.correct() + "\t" + 100 * evaluation.correct() / instances.size() + "%");
            kiir.println("Incorrectly Classified Instances: " + (instances.size() - (int) evaluation.correct()));
            kiir.println();
            kiir.close();

        } catch (Exception e) {
            System.out.println("Error Occurred!!!! \n" + e.getMessage());
        }

    }
}

