<title>Belépés</title>
    <style>
    

        h2 {
            text-align: center;
        }

        form {
            text-align: center;
            width: 700px;
            align-items: center;
            justify-content: center;
        }

        label {
            display: block;
            
        }

        input[type="text"],
        input[type="password"] {
            width: 700px;
            padding: 10px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #5386E4;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        h2:last-of-type {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <br>
    <br>
    <br>
    <br>
    <br>
<h2>Belépés</h2>
<div class="container">
    <form action="<?= SITE_ROOT ?>beleptet" method="post">
        <label for="login">Felhasználó:</label><input type="text" name="login" id="login" required pattern="[a-zA-Z][\-\.a-zA-Z0-9_]{3}[\-\.a-zA-Z0-9_]+"><br>
        <label for="password">Jelszó:</label><input type="password" name="password" id="password" required pattern="[\-\.a-zA-Z0.9_]{4}[\-\.a-zA-Z0-9_]+"><br>
        <input type="submit" value="Küldés">
    </form>
    </div>
    <h2><br><?= (isset($viewData['uzenet']) ? $viewData['uzenet'] : "") ?><br></h2>
    
    <h2>Regisztráció</h2>
    <div class="container">
    <form action="<?= SITE_ROOT ?>regisztral" method="post">
        <label for="csaladi_nev">Családi név: <input type = "text" name="csaladi_nev" id = "csaladi_nev"></label><br>
        <label for="utonev">Utónév: <input type = "text" name="utonev" id = "utonev"></label><br>
        <label for="login_nev">Login: <input type = "text" name="login_nev" id = "login_nev"></label><br>
        <label for="jelszo_reg">Jelszó: <input type = "password" name="jelszo_reg" id = "jelszo_reg"></label><br> 
        <input type="submit" name="regisztracio" value="Regisztráció"><br>
    </form>
     </div>
     

