<!-- "Варіант 3" -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurses</title>
    <script>
        let ajax = new XMLHttpRequest();
        function getListOfWards() 
        {
            let nurseName = document.getElementById("nurseName").value;
            
            ajax.onreadystatechange = load1();
            ajax.open("GET","getListOfWards.php?nurseName=" + nurseName);
            ajax.send();
        }
        function load1()
        {
            if(ajax.readyState === 4)
            {   if(ajax.status === 200)
                console.log(ajax);
                document.getElementById("res1").innerHTML = ajax.response;
            }
            
        }
    </script>



    <script>
        function getListOfNurse_Dep(url, callback, format) {
    const ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (ajax.readyState === 4 && ajax.status === 200) {
            if (format === 'json') {
                console.log("json");
                callback(JSON.parse(ajax.responseText));
            } 
        }
    };
    ajax.open('GET', url);
    ajax.send();
}

function getListOfNurse_Departments() {
    const departmentName = document.getElementById('departmentName').value;
    getListOfNurse_Dep('getListOfNurse_Dep.php?departmentName=' + departmentName, 
        function(response) {
            console.log(response);
            document.getElementById('res2').innerHTML = response;
        },
        'json');
} 
    </script>



    <script>
        function getListOfShift(url, callback, format) {
    const ajax3 = new XMLHttpRequest();
    ajax3.onreadystatechange = function() {
        if (ajax3.readyState === 4 && ajax3.status === 200) {
            if (format === 'xml') {
                console.log("xml");
                callback(ajax3.responseXML);
            }           
        }
    };
    ajax3.open('GET', url);
    ajax3.send();
    
}
function ShiftOfNurse(){
        const shiftWard = document.getElementById('shiftWard').value;
        getListOfShift('getListOfShift.php?shiftWard=' + shiftWard, 
        function(response) {
            console.log(response);

            const nodes = response.getElementsByTagName('shiftWard');
            let list = '<ul>';
            for (let i = 1; i < nodes.length; i++) {
                list += '<li>' + nodes[i].childNodes[0].nodeValue + '</li>';
            }
            list += '</ul>';
            document.getElementById('res3').innerHTML = list;
        },
         'xml');
    }
    </script>



</head>
<body>
    <h2>Перелік палат, у яких чергує обрана медсестра</h2>
        <select name="nurseName" id="nurseName">
    <?php
    include("connect.php");

    try 
    {
         foreach($dbh->query("SELECT DISTINCT name FROM nurse") as $row)
        {
            echo "<option value=$row[0]>$row[0]</option>";
        }
    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    ?>
    </select>
        <input type="button" value="Результат" onclick="getListOfWards()">
    <table border = '1'>
    <thead><tr><th>Name</th><th>Ward</th><th>Department</th><th>Shift</th></tr></thead>
    <tbody id= "res1"></tbody>
    </table>
<!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------------->
   
    <h2>Mедсестри обраного відділення</h2>
        <select name="departmentName" id="departmentName">
    <?php
    include("connect.php");

    try 
    {
         foreach($dbh->query("SELECT DISTINCT department FROM nurse") as $row)
        {
            echo "<option value=$row[0]>$row[0]</option>";
        }
    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    ?>
    </select>
        <input type="button" value="Результат" onclick="getListOfNurse_Departments()">
    <table border = '1'>
    <tbody id= "res2"></tbody>
    </table>


<!---------------------------------------------------------------------------------------------------------------------------->

<h2>Чергування (у будь-яких палатах) у зазначену зміну</h2>
        <select name="shiftWard" id="shiftWard">
    <?php
    include("connect.php");

    try 
    {
         foreach($dbh->query("SELECT DISTINCT shift FROM nurse") as $row)
        {
            echo "<option value=$row[0]>$row[0]</option>";
        }
    }
    catch(PDOException $ex)
    {
        echo $ex->GetMessage();
    }
    ?>
    </select>
        <input type="submit" value="Результат" onclick="ShiftOfNurse()">
        <table border = '1'>
    <tbody id= "res3"></tbody>
    </table>

</body>
</html>