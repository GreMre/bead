<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px; /* A kívánt távolság a sorok között */
        column-gap:0;
        

    }

    .box {
        color: white;
        margin-top: 30px;
        vertical-align: middle;
        background: linear-gradient(to bottom, #ABA8B2, #949396);
        z-index: 1;
        width: 600px; /* Az egyes dobozok szélessége (50% az oldal szélességéből, mínusz a távolság) */
        height: 400px; /* Az egyes dobozok magassága */
         /* A dobozok háttérszíne */
        
    }
    .box img {
        max-width: 100%;
        max-height: 100%;
        width: 100%;
    }
    .main {
        margin-top: 30px;
        width: 100%;
        height: 300px;
        background-color: #orange;
    }
    .main img {
        max-width: 100%;
        max-height: 100%;
        width: 100%;
    }
</style>


<div class="main"><img src="img/welc.jpg" alt="Kép leírása"></div>
<div class="container">
    <div class="box">Köszöntjük Önt a [Kereskedés neve] online laptop áruházában! Választékunkban számos kiváló minőségű laptop található, amelyekkel segíteni szeretnénk a mindennapi életét hatékonyabbá és izgalmasabbá tenni. Legyen szó munkáról, tanulásról vagy szórakozásról, nálunk megtalálja a megfelelő eszközt, amely kiszolgálja az Ön igényeit.</div>
    <div class="box"><img src="img/main.jpg" alt="Kép leírása"></div>
</div>
<div class="container">
    <div class="box"><img src="img/5.jpg" alt="Kép leírása"></div>
    <div class="box">sss</div>
</div>
<div class="container">
    <div class="box">href</div>
    <div class="box"><img src="img/gar.jpg" alt="Kép leírása"></div>
</div>