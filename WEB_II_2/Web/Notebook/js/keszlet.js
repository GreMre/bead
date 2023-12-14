var lista;

function oprec() {
    $.post(
        "/Notebook/models/keszletjs_model.php",
        {"op" : "oprec"},
        function(data) {
            $("<option>").val("0").text("Válasszon ...").appendTo("#oprec");
            lista = data.lista;
            for(i=0; i<lista.length; i++) {
                $("<option>").val(lista[i].id).text(lista[i].nev).appendTo("#oprec");
            }
        },
        "json"
    );
    }
    function proc(){
        $("#proc").html("");
        $.post(
            "/Notebook/models/keszletjs_model.php",
            {"op" : "proc"},
            function(data) {
                $("<option>").val("0").text("Válasszon ...").appendTo("#proc");
               lista = data.lista;
                for(i=0; i<lista.length; i++) {
                    $("<option>").val(lista[i].id).text(lista[i].gyarto).appendTo("#proc");
                }
            },
            "json"
        );
    }

    function gep() {
        var oprecnev = $("#oprec option:selected").text();
        var procnev = $("#proc option:selected").text();
        $("#mark").html("");
        $.post(
            "/Notebook/models/keszletjs_model.php",
            {"op": "gep", "proc": procnev, "oprec": oprecnev},
            function(data) {
                $("<option>").val("0").text("Válasszon ...").appendTo("#mark");
                lista = data.lista;
                for (var i = 0; i < lista.length; i++) {
                    $("<option>").val(lista[i].id).text(lista[i].gyarto).appendTo("#mark");
                }
            },
            "json"
        );
    }

    function First() {
        $.post(
            "/Notebook/models/keszletjs_model.php",
            { "op": "First" },
            function (data) {
                lista = data.lista;
                var table = $("<table></table>");
    
                // Fejléc létrehozása
                var headerRow = $("<tr></tr>");
                for (var field in lista[0]) {
                    headerRow.append("<th>" + field + "</th>");
                }
                table.append(headerRow);
    
                // Adatok hozzáadása a táblázathoz
                for (var i = 0; i < lista.length; i++) {
                    var dataRow = $("<tr></tr>");
                    for (var field in lista[i]) {
                        dataRow.append("<td>" + lista[i][field] + "</td>");
                    }
                    table.append(dataRow);
                }
    
                // Táblázatot cserélj ki az aktuálisra
                $("#keszletTable").html(table);
            },
            "json"
        );
    }
    function Resp()
    {
        var oprecnev = $("#oprec option:selected").text();
        var procnev = $("#proc option:selected").text();
        var mark = $("#mark option:selected").text();

        $("#keszletTable").empty();
        $.post(
            "/Notebook/models/keszletjs_model.php",
            { "op": "Resp", "proc": procnev, "oprec": oprecnev , "mark" : mark},
            function (data) {
                lista = data.lista;
                var table = $("<table></table>");
    
                // Fejléc létrehozása
                var headerRow = $("<tr></tr>");
                for (var field in lista[0]) {
                    headerRow.append("<th>" + field + "</th>");
                }
                table.append(headerRow);
    
                // Adatok hozzáadása a táblázathoz
                for (var i = 0; i < lista.length; i++) {
                    var dataRow = $("<tr></tr>");
                    for (var field in lista[i]) {
                        dataRow.append("<td>" + lista[i][field] + "</td>");
                    }
                    table.append(dataRow);
                }
    
                // Táblázatot cserélj ki az aktuálisra
                $("#keszletTable").html(table);
            },
            "json"
        );  
    }

   
   

    $(document).ready(function() {
        oprec();
        First();
        
        $("#oprec").change(proc);
        $("#proc").change(gep);
        $("#mark").change(Resp);
    
        $(".adat").hover(function() {
            $(this).css({"color" : "white", "background-color" : "black"});
        }, function() {
            $(this).css({"color" : "black", "background-color" : "white"});
        });
        $("#oprec, #proc, #mark").change(function() {
            var oprecSelected = $("#oprec option:selected").val();
            var procSelected = $("#proc option:selected").val();
            var markSelected = $("#mark option:selected").val();
    
            if (oprecSelected !== "0" && procSelected !== "0" && markSelected !== "0" &&
                oprecSelected !== "Válasszon ..." && procSelected !== "Válasszon ..." && markSelected !== "Válasszon ...") {
                $("#redirectToPageButton").prop("disabled", false);
            } else {
                $("#redirectToPageButton").prop("disabled", true);
            }
        });
    
        // Alapértelmezésben letiltod a gombot, mert eleinte nincsenek kiválasztva értékek
        $("#redirectToPageButton").prop("disabled", true);
    
        // ...
    });
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("redirectToPageButton").addEventListener("click", function() {
            var oprecnev = $("#oprec option:selected").text();
            var procnev = $("#proc option:selected").text();
            var mark = $("#mark option:selected").text();
            
            // Készítsd el a query string-et az adatokkal
            var queryString = "?oprecnev=" + encodeURIComponent(oprecnev) + "&procnev=" + encodeURIComponent(procnev) + "&mark=" + encodeURIComponent(mark);
            
            // Állítsd össze a teljes URL-t
            var url = "/Notebook/models/generate_pdf.php" + queryString;
            
            // Nyisd meg a PHP oldalt
            window.location.href = url;
        });
    });
    