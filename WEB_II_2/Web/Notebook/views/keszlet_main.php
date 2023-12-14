
<script type="text/javascript" src = "\Notebook\js\jquery.min.js"></script>
<script type="text/javascript" src = "\Notebook\js\keszlet.js"></script>
  <title>Felsőfokú intézmények</title>
  <style>
    #informaciosdiv {
      width: 400px;
    }
    #intezmenyinfo {
      float: right;
      border: 1px solid black;
      width: 190px;
      height: 100px;
    }
    .cimke{
      display: inline-block;
      width: 60px;
      text-align: right;
    }
    span {
      margin: 3px 5px;
    }
    label {
      display: inline-block;
      width: 70px;
      text-align: right;
    }
    select {
      width: 115px;
    }
  </style>
  
  <style>
  #keszletTable {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
  }

  #keszletTable th,
  #keszletTable td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
  }

  #keszletTable th {
    background-color: #f2f2f2;
  }

  #keszletTable tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  #keszletTable tr:hover {
    background-color: #dddddd;
  }

  /* Az alábbi stílusok az lenyíló menük formázásához */
  .dropdown {
    display: inline-block;
  }

  select {
    padding: 5px;
  }

  
</style>
    <h1>Készleten lévő termékek:</h1>
   
        <label for='oprec'>Operációs rendszer:</label>
      <select id = 'oprec'></select>
      <br><br>
      <label for = 'proc'>Processzor típusa:</label>
      <select id = 'proc'></select>
      <br><br>
      <label for = 'mark'>Márka:</label>
      <select id = 'mark'></select>
      <button id="redirectToPageButton">PDF generálása</button>



      <table id="keszletTable">
    <thead>
        <tr>
            <th>Gyártó</th>
            <th>Tipus</th>
            <th>Ár</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

     
 