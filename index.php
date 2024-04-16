<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naplo</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    document.getElementById("keres").addEventListener("click", function() {//A kattintásra az évfolyam és az osztály   értéke ellesz küldve az adatbázisnak .
  var evfolyam = document.getElementById("evfolyam").value;
  var osztaly = document.getElementById("osztaly").value;

  
  var xhr = new XMLHttpRequest();//xml objektum
  xhr.open("POST", "rest.php", true);//Post kérést küld a rest.php-nak
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//Kódolt adatok beállítása
  xhr.onreadystatechange = function() {//Függvény létrehozása
    if (xhr.readyState === 4 && xhr.status === 200) {//4-re Vált a kérés tehát  befejezett és 200 azért , hogy a kérés sikeres volt 
      var nevsor = JSON.parse(xhr.responseText);//Json válasszá 
      nevsor.sort(); // ABC sorrendbe rendezés

      
      var nevHalmaz = new Set(); //Az ismétlődések kiszűrése miatt kell
      var nevsorHTML = "<ol>";//Számozott lista

      nevsor.forEach(function(nev) {
        if (!nevHalmaz.has(nev)) { // Ellenőrizzük, hogy a név szerepel-e már a halmazban ha igen akkor kihagyjuk
          nevHalmaz.add(nev); // Ha nem, hozzáadjuk a halmazhoz
          nevsorHTML += "<li>" + nev + "</li>"; // Név hozzáadása a listához
        }
      });

      nevsorHTML += "</ol>";
      document.getElementById("eredmeny").innerHTML = nevsorHTML;//Kiírjuk az eredményt az eredmény listába 
    }
  };
  xhr.send("evfolyam=" + evfolyam + "&osztaly=" + osztaly);//Post kérés küldése a servernek 
});

</script>


</head>
<body>
    

    <label for="evfolyam">Válassz évfolyamot:</label>
    <select id="evfolyam">
        <option value="9">9. évfolyam</option>
        <option value="9">10. évfolyam</option>
      
    </select>

   
    <label for="osztaly">Válassz osztályt:</label>
    <select id="osztaly">
        <option value="A">A osztály</option>
        <option value="B">B osztály</option>
        <option value="C">C osztály</option>
       
    </select>

    
    <button id="keres">Keres</button>

    <h1>Tanulók nevei:</h1>
    <div id="eredmeny"></div>

  
    
   

</body>
</html>
