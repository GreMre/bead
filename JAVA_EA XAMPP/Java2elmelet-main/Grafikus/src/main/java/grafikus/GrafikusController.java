package grafikus;
import com.oanda.v20.Context;
import com.oanda.v20.ContextBuilder;
import com.oanda.v20.ExecuteException;
import com.oanda.v20.RequestException;
import com.oanda.v20.account.AccountID;
import com.oanda.v20.account.AccountSummary;
import com.oanda.v20.order.MarketOrderRequest;
import com.oanda.v20.order.OrderCreateRequest;
import com.oanda.v20.order.OrderCreateResponse;
import com.oanda.v20.pricing.ClientPrice;
import com.oanda.v20.pricing.PricingGetRequest;
import com.oanda.v20.pricing.PricingGetResponse;
import com.oanda.v20.primitives.InstrumentName;
import com.oanda.v20.trade.Trade;
import com.oanda.v20.trade.TradeCloseRequest;
import com.oanda.v20.trade.TradeSpecifier;
import javafx.application.Platform;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.control.*;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.layout.GridPane;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;
import org.hibernate.cfg.Configuration;

import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.List;
import javax.net.ssl.HttpsURLConnection;
import java.io.*;
import java.net.URL;
import java.util.stream.Collectors;
import java.util.stream.Stream;

public class GrafikusController {
    static Context ctx;
    static AccountID accountId;
@FXML
private TextField ForD;
    @FXML
    private TableView TS2;
    @FXML
    private RadioButton radioButton1;

    @FXML
    private RadioButton radioButton2;
    @FXML
    private Button ForDD;

    @FXML
    private ToggleGroup dij;
    @FXML
    public int n=0;
    public TableView parh1;
    public TableView parh2;
    @FXML
    private Label lbdel;
    @FXML
    public ComboBox cb1;
    @FXML
    private ComboBox cb2;
    @FXML
    private TableView tv2;
    @FXML
    private Label lb2;
    @FXML
    private Label lb1;
    @FXML
    private GridPane gp1;
    @FXML
    private GridPane gp2;
    @FXML
    private GridPane gp6;
    @FXML GridPane gp7;
    @FXML
    private TextField uNév, uTipus, uDijazott;
    @FXML
    private TextField tfNév, tfTipus, tfDijazott;

    // FXML annotációval megjelölt változók
    @FXML
    private ComboBox<Integer> idComboBox;
    @FXML
    private Button deleteButton;
//--------------------------------------------------------
    @FXML
    private Button rsDelete;
    @FXML
    private Button rsUpdate;
    @FXML
    private TextField rsemail;
    @FXML
    private TextField rsname;
    @FXML
    private TextField rsstatus;
    @FXML
    private TextField rsgend;
    @FXML
    private TextField rsID;
    @FXML
    private TextArea textArea;
    @FXML
    private ScrollPane SC;
    @FXML
    private  Button DFa;
    @FXML
    private  Button GTa;
    @FXML
    private ComboBox<String> Box;



//---------------------------------------------------------
    @FXML
    private TableView tv1;
    @FXML
    private TableColumn<suti, String> IDCol;
    @FXML
    private TableColumn<suti, String> névCol;
    @FXML
    private TableColumn<suti, String> tipusCol;
    @FXML
    private TableColumn<suti, String> dijazottCol;
    @FXML
    private ComboBox<Integer> algorit;
    @FXML
    private Button Cho;
    @FXML
    private TextArea geptext;
    @FXML
    private ScrollPane GC;
    @FXML private Label Par1;
    @FXML private Label Par2;
    @FXML private Button ParB;
    @FXML private TableView tvS;
    @FXML private TableColumn<suti, Integer> IDCol2;
    @FXML private TableColumn<suti, String> névCol2;
    @FXML private TableColumn<suti, String> tipusCol2;
    @FXML private TableColumn<suti, Boolean> dijazottCol2;
    @FXML Button va1;
    @FXML Button va2;
    @FXML Button va3;
    @FXML Button va4;
    @FXML Button va5;
    @FXML Button va6;
    @FXML Button rsPut;
    @FXML TextArea welcomeText;
    @FXML Button RSPost;
    @FXML TextField Ertek;

    SessionFactory factory;

    @FXML
    private TextField tfNev;

    @FXML
    void initialize() {
        this.ElemekTörlése();
        Configuration cfg = new Configuration().configure("hibernate.cfg.xml");
        factory = cfg.buildSessionFactory();

        // Töltsd be az id-ket az idComboBox-ba
        Session session = factory.openSession();
        Transaction t = session.beginTransaction();
        List<suti> lista = session.createQuery("FROM suti").list();
        for (suti suti : lista) {
            idComboBox.getItems().add(suti.getId());
        }
        t.commit();
        session.close();

        for (int i = 1; i <= 5; i++) {
            algorit.getItems().add(i);
        }


        // Alapértelmezetten kiválasztott RadioButton beállítása (opcionális)


    }


    void ElemekTörlése() {
        this.parh1.setVisible(false);
        this.parh1.setManaged(false);
        this.parh2.setVisible(false);
        this.parh2.setManaged(false);

        this.cb1.setVisible(false);
        this.cb2.setManaged(false);
        this.cb1.setVisible(false);
        this.cb2.setManaged(false);
        this.lb1.setVisible(false);
        this.lb1.setManaged(false);
        this.gp1.setVisible(false);
        this.gp1.setManaged(false);
        this.tv1.setVisible(false);
        this.tv1.setManaged(false);
        this.tv2.setVisible(false);
        this.tv2.setManaged(false);
        this.lb2.setVisible(false);
        this.lb2.setManaged(false);
        this.gp2.setVisible(false);
        this.gp2.setManaged(false);
        this.lbdel.setManaged(false);
        this.lbdel.setVisible(false);
        ForD.setManaged(false);
        ForD.setVisible(false);

        this.idComboBox.setVisible(false);
        this.idComboBox.setManaged(false);
        this.deleteButton.setVisible(false);
        this.deleteButton.setManaged(false);
        rsID.setVisible(false);
        rsID.setManaged(false);
        rsDelete.setVisible(false);
        rsDelete.setManaged(false);
        textArea.setVisible(false);
        textArea.setManaged(false);
        SC.setVisible(false);
        SC.setManaged(false);
        DFa.setVisible(false);
        DFa.setManaged(false);
        GTa.setVisible(false);
        GTa.setManaged(false);
        algorit.setVisible(false);
        algorit.setManaged(false);
        Cho.setVisible(false);
        Cho.setManaged(false);
        geptext.setVisible(false);
        geptext.setManaged(false);
        GC.setVisible(false);
        GC.setManaged(false);
        Par1.setManaged(false);
        Par1.setVisible(false);
        Par2.setVisible(false);
        Par2.setManaged(false);
        ParB.setVisible(false);
        ParB.setManaged(false);
        tvS.setVisible(false);
        tvS.setManaged(false);
        rsPut.setManaged(false);
        rsPut.setVisible(false);
        va1.setManaged(false);
        va1.setVisible(false);
        va2.setManaged(false);
        va2.setVisible(false);
        va3.setManaged(false);
        va3.setVisible(false);
        va4.setManaged(false);
        va4.setVisible(false);
        va5.setManaged(false);
        va5.setVisible(false);
        va6.setManaged(false);
        va6.setVisible(false);
        welcomeText.setVisible(false);
        welcomeText.setManaged(false);
        Box.setVisible(false);
        Box.setManaged(false);
        rsname.setVisible(false);
        rsname.setManaged(false);
        rsstatus.setVisible(false);
        rsstatus.setManaged(false);
        rsgend.setVisible(false);
        rsgend.setManaged(false);
        rsemail.setVisible(false);
        rsemail.setManaged(false);
        rsID.setVisible(false);
        rsID.setManaged(false);
        RSPost.setVisible(false);
        RSPost.setManaged(false);
        radioButton1.setVisible(false);
        radioButton1.setManaged(false);
        radioButton2.setVisible(false);
        radioButton2.setManaged(false);
        ForDD.setManaged(false);
        ForDD.setVisible(false);
        Ertek.setVisible(false);
        Ertek.setManaged(false);
    }
    //Gépi tanulás
    //-----------------------------------------------------------------------------------------
    @FXML
    protected void Adatb_Dontesi_Fa()
    {
        this.ElemekTörlése();
        DFa.setVisible(true);
        DFa.setManaged(true);


    }
    @FXML
    protected void DFa() throws Exception {
        GépiTanulás gep = new GépiTanulás();
gep.run();
    }

    @FXML
    protected void Adatb_tobbalgo() {
        this.ElemekTörlése();
        GTa.setVisible(true);
        GTa.setManaged(true);

    }
    @FXML
    protected void GTaG() throws Exception {
        GépiTanulás gep2 = new GépiTanulás();
        gep2.arg2();

    }

    @FXML
    protected void Adatb_tobbalgo2() {
        this.ElemekTörlése();
        GC.setManaged(true);
        GC.setVisible(true);
        geptext.setManaged(true);
        geptext.setVisible(true);
        algorit.setManaged(true);
        algorit.setVisible(true);
        Cho.setManaged(true);
        Cho.setVisible(true);
    }
    @FXML
    protected void gena() throws Exception {
        GépiTanulás gep = new GépiTanulás();



        // Assuming algorit is a ComboBox<Integer>
        Integer selectedValue = algorit.getValue();

        if (selectedValue != null) {
            gep.arg3(selectedValue);
        } else {
            // Handle the case when no value is selected
            System.out.println("No value selected");
        }
        try {
            List<String> sorok = Files.readAllLines(Paths.get("seged.txt"));
            StringBuilder tartalom = new StringBuilder();

            for (String sor : sorok) {
                tartalom.append(sor).append("\n");
            }

            geptext.setText(tartalom.toString());
        } catch (Exception e) {
            e.printStackTrace();
        }
    }


    //-----------------------------------------------------------------------------------------
    @FXML
    protected void menuCreateClick() {
        this.ElemekTörlése();
        gp1.setVisible(true);
        gp1.setManaged(true);
    }

    @FXML
    protected void menuUpdateClick() {
        this.ElemekTörlése();
        gp2.setVisible(true);
        gp2.setManaged(true);
        cb1.setVisible(true);
        cb1.setManaged(true);
        Session session = factory.openSession();
        Transaction t = session.beginTransaction();

        List<suti> lista = session.createQuery("FROM suti").list();
        cb1.setPromptText("Válassz egy id-t!");
        for (suti suti : lista){
            cb1.getItems().add(suti.Id);}

    }
    void Create() {
        Session session = factory.openSession();
        Transaction t = session.beginTransaction();
        suti termek = new suti(tfNév.getText(), tfTipus.getText(), Boolean.parseBoolean(tfDijazott.getText()));
        session.save(termek);
        t.commit();
    }
    @FXML
    void bt1Click() {
        Create();
        this.ElemekTörlése();
        lb1.setVisible(true);
        lb1.setManaged(true);
        lb1.setText("Adatok beírva az adatbázisba");
    }

    @FXML
    protected void menuReadClick() {
        this.ElemekTörlése();
        tv1.setVisible(true);
        tv1.setManaged(true);
        tv1.getColumns().removeAll(tv1.getColumns());
        IDCol = new TableColumn("Id");
        névCol = new TableColumn("Név");
        tipusCol = new TableColumn("Típus");
        dijazottCol = new TableColumn("Díjazott");
        tv1.getColumns().addAll(IDCol, névCol, tipusCol, dijazottCol);
        IDCol.setCellValueFactory(new PropertyValueFactory<>("Id"));
        névCol.setCellValueFactory(new PropertyValueFactory<>("Név"));
        tipusCol.setCellValueFactory(new PropertyValueFactory<>("Típus"));
        dijazottCol.setCellValueFactory(new PropertyValueFactory<>("Díjazott"));
        tv1.getItems().clear();
        Session session = factory.openSession();
        Transaction t = session.beginTransaction();
        List<suti> lista = session.createQuery("FROM suti").list();
        for (suti suti : lista)
            tv1.getItems().add(suti);
        System.out.println();
        t.commit();
    }


    @FXML
    void Update() {

        Session session = factory.openSession();
        Transaction t = session.beginTransaction();

        System.out.println("Update..");
         int n = cb1.getVisibleRowCount();
        suti suti = session.load(grafikus.suti.class, n);

        suti.setNév(uNév.getText());
        suti.setTípus(uTipus.getText());
        suti.setDíjazott(Boolean.parseBoolean((uDijazott.getText())));

        session.update(suti);
        t.commit();

    }

    public void bt2Click(ActionEvent actionEvent) {
        this.ElemekTörlése();
        Update();

        lb2.setVisible(true);
        lb2.setManaged(true);
        lb2.setText("Update lefutott!");
    }

    @FXML
    protected void menuDeleteClick() {
        ElemekTörlése();
        idComboBox.setVisible(true);
        idComboBox.setManaged(true);
        deleteButton.setVisible(true);
        deleteButton.setManaged(true);
        lbdel.setVisible(true);
        lbdel.setManaged(true);

    }
    @FXML
    protected void DeleteButton() {
        tv1.getColumns().removeAll(tv1.getColumns());
        Session session = factory.openSession();
        System.out.println("Delete..");
        Transaction t = session.beginTransaction();
        suti suti = session.load(suti.class, idComboBox.getValue());
        session.delete(suti);
        t.commit();
        lbdel.setText("A kiválasztott sor törlésre került");
    }

    @FXML
    protected void menuReadClick_2() {
        this.ElemekTörlése();
        tv1.setVisible(true);
        tv1.setManaged(true);
        tv1.getColumns().removeAll(tv1.getColumns());
        IDCol = new TableColumn("Id");
        névCol = new TableColumn("Név");
        tipusCol = new TableColumn("Típus");
        dijazottCol = new TableColumn("Díjazott");
        tv1.getColumns().addAll(IDCol, névCol, tipusCol, dijazottCol);
        IDCol.setCellValueFactory(new PropertyValueFactory<>("Id"));
        névCol.setCellValueFactory(new PropertyValueFactory<>("Név"));
        tipusCol.setCellValueFactory(new PropertyValueFactory<>("Típus"));
        dijazottCol.setCellValueFactory(new PropertyValueFactory<>("Díjazott"));
        tv1.getItems().clear();
        Session session = factory.openSession();
        Transaction t = session.beginTransaction();
        List<suti> lista = session.createQuery("FROM suti").list();
        for (suti suti : lista)
            tv1.getItems().add(suti);
        System.out.println();
        t.commit();

    }
    static String token = "f397fac59a5584161d316ac0e6fafa49e9983e82f8d04a5ab6139f2317c4be59";
    static HttpsURLConnection connection;

    // GET metódus
    static void GET(String ID) throws IOException {
        System.out.println("\nGET...");
        String url = "https://gorest.co.in/public/v1/users";
        if (ID != null)
            url = url + "/" + ID;
        URL usersUrl = new URL(url);
        connection = (HttpsURLConnection) usersUrl.openConnection();
        connection.setRequestMethod("GET");
        if (ID != null)
            connection.setRequestProperty("Authorization", "Bearer " + token);
        segéd3(HttpsURLConnection.HTTP_OK);
    }

    // POST metódus
    static void POST(String name, String gender, String email, String status) throws IOException {
        System.out.println("\nPOST...");
        URL url = new URL("https://gorest.co.in/public/v1/users");
        connection = (HttpsURLConnection) url.openConnection();
        connection.setRequestMethod("POST");
        segéd1();
        String params = "{\"name\":\"" + name + "\", \"gender\":\"" + gender + "\", \"email\":\"" + email + "\", \"status\":\"" + status + "\"}";
        segéd2(params);
        segéd3(HttpsURLConnection.HTTP_CREATED);
    }

    // PUT metódus
    static void PUT(String ID, String name, String gender, String email, String status) throws IOException {
        System.out.println("\nPUT...");
        URL url = new URL("https://gorest.co.in/public/v1/users" + "/" + ID);
        connection = (HttpsURLConnection) url.openConnection();
        connection.setRequestMethod("PUT");
        segéd1();
        String params = "{\"name\":\"" + name + "\", \"gender\":\"" + gender + "\", \"email\":\"" + email + "\", \"status\":\"" + status + "\"}";
        segéd2(params);
        segéd3(HttpsURLConnection.HTTP_OK);
    }

    // DELETE metódus
    static void DELETE(String ID) throws IOException {
        System.out.println("\nDELETE...");
        URL url = new URL("https://gorest.co.in/public/v1/users" + "/" + ID);
        connection = (HttpsURLConnection) url.openConnection();
        connection.setRequestMethod("DELETE");
        segéd1();
        segéd3(HttpsURLConnection.HTTP_NO_CONTENT);
    }

    // segéd1 metódus
    static void segéd1() {
        connection.setRequestProperty("Content-Type", "application/json");
        connection.setRequestProperty("Authorization", "Bearer " + token);
        connection.setUseCaches(false);
        connection.setDoOutput(true);
    }

    // segéd2 metódus
    static void segéd2(String params) throws IOException {
        BufferedWriter wr = new BufferedWriter(new OutputStreamWriter(connection.getOutputStream(), "UTF-8"));
        wr.write(params);
        wr.close();
        connection.connect();
    }

    // segéd3 metódus
   static String strk="";
    static void segéd3(int code) throws IOException {
        int statusCode = connection.getResponseCode();
        System.out.println("statusCode: " + statusCode);
        if (statusCode == code) {
            BufferedReader beolv = new BufferedReader(new InputStreamReader(connection.getInputStream()));
            StringBuffer strKi = new StringBuffer();
            String readLine = null;
            while ((readLine = beolv.readLine()) != null)
                strKi.append(readLine);
            strk=strKi.toString();
            beolv.close();
            System.out.println("List of users: " + strKi.toString());
        } else {
            System.out.println("Hiba!!!");

        }
        connection.disconnect();
    }



    @FXML
    protected void Rest1Create1() {
        ElemekTörlése();

        lbdel.setVisible(true);
        lbdel.setManaged(true);
        lbdel.setText("");

        rsemail.setVisible(true);
        rsemail.setManaged(true);
        rsgend.setManaged(true);
        rsgend.setVisible(true);
        rsname.setVisible(true);
        rsname.setManaged(true);
        rsstatus.setManaged(true);
        rsstatus.setVisible(true);
        RSPost.setVisible(true);
        RSPost.setManaged(true);


        rsname.setText("Chakor");
        rsstatus.setText("inactive");
        rsgend.setText("female");
        rsemail.setText("gowda_chakor@hodkiewicz.test");

    }
    @FXML
    protected void RSPost() throws IOException {
        POST(rsname.getText(), rsgend.getText(), rsemail.getText(), rsstatus.getText());
    }


    @FXML
    protected void Rest1Read1() {
        ElemekTörlése();
        lbdel.setVisible(true);
        lbdel.setManaged(true);
        lbdel.setText("");
        textArea.setManaged(true);
        textArea.setVisible(true);
        SC.setVisible(true);
        SC.setManaged(true);

        try {
            // Make the GET request
            GET(null);




            textArea.setText(strk);

        } catch (IOException e) {
            e.printStackTrace(); // vagy kezeld máshogy a kivételt
            lbdel.setText("Hiba történt a GET kérés során.");
        }
    }




    @FXML
    protected void Rest1Update1() {
        ElemekTörlése();
       rsemail.setVisible(true);
       rsemail.setManaged(true);
       rsgend.setManaged(true);
       rsgend.setVisible(true);
       rsname.setVisible(true);
       rsname.setManaged(true);
       rsstatus.setManaged(true);
       rsstatus.setVisible(true);
       rsPut.setVisible(true);
       rsPut.setManaged(true);
       rsID.setVisible(true);
       rsID.setManaged(true);
       rsID.setText("5775256");
       rsname.setText("Chakor");
        rsstatus.setText("inactive");
        rsgend.setText("female");
        rsemail.setText("gowda_chakor@hodkiewicz.test");

    }

    @FXML
    protected void RSPut() throws IOException {
        PUT(rsID.getText(),rsname.getText(),rsgend.getText(),rsemail.getText(),rsstatus.getText());
    }

    @FXML
    protected void Rest1Delete1() {
        ElemekTörlése();
        rsID.setVisible(true);
        rsID.setManaged(true);
        rsDelete.setVisible(true);
        rsDelete.setManaged(true);
        rsDelete.setMaxWidth(80);
        lbdel.setVisible(true);
        lbdel.setManaged(true);
        lbdel.setText("Kérem adja meg a ID-t amit törölni szeretne");


    }
    @FXML
    protected void RSDELETE() {
        String id = rsID.getText();
        if (!id.isEmpty()) {
            try {
                DELETE(id);
            } catch (IOException e) {
                e.printStackTrace();

            }
        } else {
            // Hibaüzenet vagy valamilyen visszajelzés a felhasználónak
            System.out.println("Az ID mező nem lehet üres!");
            lbdel.setText("Az ID mező nem lehet üres!");

        }
        rsID.setText("");
    }
    @FXML
    protected void Rest2Create() {
        Session session = factory.openSession();
        Transaction t = session.beginTransaction();
        suti termek = new suti(tfNév.getText(), tfTipus.getText(), Boolean.parseBoolean(tfDijazott.getText()));
        session.save(termek);
        t.commit();
    }

    @FXML
    protected void Rest2Read1() {
        this.ElemekTörlése();
        tv1.setVisible(true);
        tv1.setManaged(true);
        tv1.getColumns().removeAll(tv1.getColumns());
        IDCol = new TableColumn("Id");
        névCol = new TableColumn("Név");
        tipusCol = new TableColumn("Típus");
        dijazottCol = new TableColumn("Díjazott");
        tv1.getColumns().addAll(IDCol, névCol, tipusCol, dijazottCol);
        IDCol.setCellValueFactory(new PropertyValueFactory<>("Id"));
        névCol.setCellValueFactory(new PropertyValueFactory<>("Név"));
        tipusCol.setCellValueFactory(new PropertyValueFactory<>("Típus"));
        dijazottCol.setCellValueFactory(new PropertyValueFactory<>("Díjazott"));
        tv1.getItems().clear();
        Session session = factory.openSession();
        Transaction t = session.beginTransaction();
        List<suti> lista = session.createQuery("FROM suti").list();
        for (suti suti : lista)
            tv1.getItems().add(suti);
        System.out.println();
        t.commit();
    }

    @FXML
    protected void Rest2Update1() {

        Session session = factory.openSession();
        Transaction t = session.beginTransaction();

        System.out.println("Update..");
        int n = cb1.getVisibleRowCount();
        suti suti = session.load(grafikus.suti.class, n);

        suti.setNév(uNév.getText());
        suti.setTípus(uTipus.getText());
        suti.setDíjazott(Boolean.parseBoolean((uDijazott.getText())));

        session.update(suti);
        t.commit();
    }

    @FXML
    protected void Rest2Delete1() {
        ElemekTörlése();
        lbdel.setVisible(true);
        lbdel.setManaged(true);
        tv1.getColumns().removeAll(tv1.getColumns());
        Session session = factory.openSession();

        System.out.println("Delete..");
        Transaction t = session.beginTransaction();
        suti suti = session.load(suti.class, 3);
        session.delete(suti);
        t.commit();
        lbdel.setText("Rest2_Delete! 3-as id törlésre került!!");
    }

    @FXML
    protected void Soapletoltes() {
    }

    @FXML
    protected void Soapletoltes2() {
    }

    @FXML
    protected void Soapgrafikon() {
    }



    @FXML
    protected void Parhuzamos() throws InterruptedException {
        ElemekTörlése();
        Par1.setVisible(true);//label1
        Par1.setManaged(true);
        Par2.setVisible(true);//label2
        Par2.setManaged(true);
        ParB.setVisible(true);//Button
        ParB.setManaged(true);


    }
    @FXML
    protected void ParhuzamosB() {
        Thread label1Thread = new Thread(() -> {
            try {
                while (true) {
                    Platform.runLater(() -> Par1.setText("Valami1"));
                    Thread.sleep(1000);
                    Platform.runLater(() -> Par1.setText("Valami2"));
                    Thread.sleep(1000);
                }
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        });

        Thread label2Thread = new Thread(() -> {
            try {
                while (true) {
                    Platform.runLater(() -> Par2.setText("test2"));
                    Thread.sleep(2000);
                    Platform.runLater(() -> Par2.setText("test1"));
                    Thread.sleep(2000);
                }
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        });

        label1Thread.setDaemon(true);
        label2Thread.setDaemon(true);

        label1Thread.start();
        label2Thread.start();
    }



    @FXML
    protected void Stream() {

        this.ElemekTörlése();
        tvS.setManaged(true);
        tvS.setVisible(true);
        radioButton1.setManaged(true);
        radioButton1.setVisible(true);
        radioButton2.setManaged(true);
        radioButton2.setVisible(true);
        

        Session session = factory.openSession();
        Transaction t = session.beginTransaction();

        List<suti> lista = session.createQuery("FROM suti", suti.class).list();

        // Stream használata a szűréshez, majd a végeredmény egy listába gyűjtése
        List<suti> filteredList = lista.stream()
                .filter(p -> p.getDíjazott() == false)
                .collect(Collectors.toList());

        // ObservableList létrehozása és feltöltése a szűrt listával
        ObservableList<suti> observableList = FXCollections.observableArrayList(filteredList);

        // TableView-hez hozzáadása az ObservableList-tel
        tvS.setItems(observableList);

        // Oszlopok létrehozása és hozzáadása a TableView-hez
        TableColumn<suti, Integer> IDCol2 = new TableColumn<>("Id");
        TableColumn<suti, String> névCol2 = new TableColumn<>("Név");
        TableColumn<suti, String> tipusCol2 = new TableColumn<>("Típus");
        TableColumn<suti, Boolean> dijazottCol2 = new TableColumn<>("Díjazott");

        tvS.getColumns().addAll(IDCol2, névCol2, tipusCol2, dijazottCol2);

        // Oszlopoknak megfelelően beállítjuk a cellaértékek megjelenítését
        IDCol2.setCellValueFactory(new PropertyValueFactory<>("id"));
        névCol2.setCellValueFactory(new PropertyValueFactory<>("név"));
        tipusCol2.setCellValueFactory(new PropertyValueFactory<>("típus"));
        dijazottCol2.setCellValueFactory(new PropertyValueFactory<>("dijazott"));

        t.commit();
        session.close();
    }





    @FXML
    protected void Sz1()
    {
        this.ElemekTörlése();
        welcomeText.setManaged(true);
        welcomeText.setVisible(true);
        va1.setVisible(true);
        va1.setManaged(true);

    }
    @FXML
    protected void oninf()
    {
        try {
            welcomeText.clear();


            Context ctx = new Context("https://api-fxpractice.oanda.com","a009684030d54e926f78808de9bbac47-2e623eb6c54241c890031dd5200df0ae");
            AccountSummary summary = ctx.account.summary(new AccountID("101-004-27562201-001")).getAccount();

            // Replace commas with commas followed by a newline character
            String formattedSummary = summary.toString().replace(",", ",\n");



            welcomeText.setText(formattedSummary);
        } catch (Exception e) {
            e.printStackTrace();
        }

    }
    @FXML
    protected void Sz2()
    {
        this.ElemekTörlése();
        welcomeText.setManaged(true);
        welcomeText.setVisible(true);
        va2.setVisible(true);
        va2.setManaged(true);
        welcomeText.clear();
        Box.getItems().clear();
        Box.setManaged(true);
        Box.setVisible(true);

        Box.getItems().add("EUR_USD");
        Box.getItems().add("USD_JPY");
        Box.getItems().add("GBP_USD");
        Box.getItems().add("USD_CHF");


    }
    @FXML
    protected void onKiir()
    {


        try {
            Context ctx = new ContextBuilder(Config.URL).setToken(Config.TOKEN).setApplication("PricePolling").build();
            AccountID accountId = Config.ACCOUNTID;
            String selectedInstrument = Box.getSelectionModel().getSelectedItem();
            List<String> instruments = new ArrayList<>(Collections.singletonList(selectedInstrument));
            PricingGetRequest request = new PricingGetRequest(accountId, instruments);
            PricingGetResponse resp = ctx.pricing.get(request);

            for (ClientPrice price : resp.getPrices())
                welcomeText.setText(welcomeText.getText() + "\n" +price.getBids() +price.getInstrument());
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    @FXML
    protected void Sz3()
    {
        this.ElemekTörlése();

    }
    @FXML
    protected void onHHist()
    {

    }
    @FXML
    protected void Sz4()
    {
        this.ElemekTörlése();
        welcomeText.setManaged(true);
        welcomeText.setVisible(true);
        va4.setVisible(true);
        va4.setManaged(true);
        welcomeText.clear();
        Box.getItems().clear();
        Box.setManaged(true);
        Box.setVisible(true);
        Ertek.setVisible(true);
        Ertek.setManaged(true);
        Ertek.setText("'Mennyiség'");
        Box.getItems().add("EUR_USD");
        Box.getItems().add("USD_JPY");
        Box.getItems().add("GBP_USD");
        Box.getItems().add("USD_CHF");

    }
    @FXML
    protected void onPozo()
    {
        welcomeText.clear();
        try {
            ctx = new ContextBuilder(Config.URL).setToken(Config.TOKEN).setApplication("StepByStepOrder").build();
            accountId = Config.ACCOUNTID;
            if(true) Nyitás();
            welcomeText.setText(welcomeText.getText() + "\n" +"Done");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    @FXML
    protected void onPozz()
    {

    }
    @FXML
    protected void Sz5()
    {
        this.ElemekTörlése();
        welcomeText.setManaged(true);
        welcomeText.setVisible(true);
        welcomeText.clear();
        ForD.setManaged(true);
        ForD.setVisible(true);
        ForDD.setManaged(true);
        ForDD.setVisible(true);


    }
    @FXML
    protected void onForDD()
    {

        welcomeText.clear();
        try {
            ctx = new ContextBuilder(Config.URL).setToken(Config.TOKEN).setApplication("StepByStepOrder").build();
            accountId = Config.ACCOUNTID;
            if(true) Zárás();
            welcomeText.setText(welcomeText.getText() + "\n" +"Done");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    @FXML
    protected void onPozk()
    {

    }
    @FXML
    protected void Sz6()
    {
        this.ElemekTörlése();
        welcomeText.clear();
        welcomeText.setVisible(true);
        welcomeText.setManaged(true);
        tvS.setVisible(true);
        tvS.setManaged(true);
        tvS.getItems().clear();
        tvS.getColumns().clear();
        TableColumn<String, String> idCol = new TableColumn<>("ID");
        TableColumn<String, String> instrumentCol = new TableColumn<>("Instrument");
        TableColumn<String, String> openTimeCol = new TableColumn<>("Open Time");
        TableColumn<String, String> currentUnitsCol = new TableColumn<>("Current Units");
        TableColumn<String, String> priceCol = new TableColumn<>("Price");
        TableColumn<String, String> unrealizedPLCol = new TableColumn<>("Unrealized P&L");
        idCol.setCellValueFactory(new PropertyValueFactory<>("id"));
        instrumentCol.setCellValueFactory(new PropertyValueFactory<>("instrument"));
        openTimeCol.setCellValueFactory(new PropertyValueFactory<>("openTime"));
        currentUnitsCol.setCellValueFactory(new PropertyValueFactory<>("currentUnits"));
        priceCol.setCellValueFactory(new PropertyValueFactory<>("price"));
        unrealizedPLCol.setCellValueFactory(new PropertyValueFactory<>("unrealizedPL"));
        tvS.getColumns().addAll(idCol, instrumentCol, openTimeCol, currentUnitsCol, priceCol, unrealizedPLCol);

        try {
            ctx = new ContextBuilder(Config.URL).setToken(Config.TOKEN).setApplication("StepByStepOrder").build();
            accountId = Config.ACCOUNTID;
            if(true) NyitotttradekKiír();
            welcomeText.setText(welcomeText.getText() + "\n" +"Done");
        } catch (Exception e) {
            e.printStackTrace();
        }

    }
    void Nyitás(){
        welcomeText.setText(welcomeText.getText() + "\n" +"Place a Market Order");
        InstrumentName instrument = new InstrumentName("AUD_USD");
        try {
            OrderCreateRequest request = new OrderCreateRequest(accountId);
            MarketOrderRequest marketorderrequest = new MarketOrderRequest();
            marketorderrequest.setInstrument(instrument);
// Ha pozitív, akkor LONG, ha negatív, akkor SHORT:
            marketorderrequest.setUnits(Ertek.getText());
            request.setOrder(marketorderrequest);
            OrderCreateResponse response = ctx.order.create(request);
            welcomeText.setText(welcomeText.getText() + "\n" +"tradeId: "+response.getOrderFillTransaction().getId());
        } catch (Exception e) {
            throw new RuntimeException(e);
        }
    }
    void Zárás(){
        welcomeText.setText(welcomeText.getText() + "\n" +"Close a Trade");

        try {
            String tradeId=ForD.getText();;    // a zárni kívánt tradeId
            ctx.trade.close(new TradeCloseRequest(accountId, new TradeSpecifier(tradeId)));
            welcomeText.setText(welcomeText.getText() + "\n" +"tradeId: "+tradeId);
        } catch (Exception e) {   throw new RuntimeException(e);   }
    }
    void NyitotttradekKiír() throws ExecuteException, RequestException {
        ObservableList<Trade> tradeList = FXCollections.observableArrayList();
        welcomeText.setText(welcomeText.getText() + "\n" +"Nyitott tradek:");
        List<Trade> trades = ctx.trade.listOpen(accountId).getTrades();
        for(Trade trade: trades) {
            welcomeText.setText(welcomeText.getText() + "\n" + trade.getId() + "\t" + trade.getInstrument() + "\t" + trade.getOpenTime() + "\t" + trade.getCurrentUnits() + "\t" + trade.getPrice() + "\t" + trade.getUnrealizedPL());
            tradeList.add(trade);
        }
        tvS.setItems(tradeList);
    }


}




