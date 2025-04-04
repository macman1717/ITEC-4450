<html>
<head>
    <title>Activity 21</title>
    <style>
        .error {color:red;}
    </style>
</head>
<body>
<h1>Introducing Ajax - March 31, 2025</h1>
<p>Submitted by Connor Griffin</p>
<hr>

<div id="mydoc">
    <h2>Ajax example 1: Loading a very long article</h2>
    <p>This is an article about topic so and so ...</p>
    <button type="button" onclick="LoadDoc();">Click here to read more</button>
</div>
<script>
    function LoadDoc(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && this.status == 200) {
                document.getElementById("mydoc").innerHTML = this.responseText;
            }
        }

        xhttp.open("GET", "AjaxFile.txt", true);
        xhttp.send();
    }
</script>
<hr>
<h2>Ajax Example 2: Update Price</h2>
<h3>The most recent stock price for AAPL is $<span id="myprice">201.58</span></h3>

<script>
    var alarm=setInterval(LoadPrice, 500);
    function LoadPrice(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("myprice").innerHTML = this.responseText;
            }
        }
        xhttp.open("GET", "AjaxAction1.php", true);
        xhttp.send();
    }
</script>
<hr>
<h2>Ajax Example 3: Using progress bar when loading something that takes a long time</h2>
<h3>Progress make: <span id="pvalue">0</span>%</h3>
<progress min="0" max="100" value="0" id="myprogress" style="display: none"></progress>
<button type="button" onclick="LoadInfo();">Start to Load</button>
<script>
    function LoadInfo(){
        var alarm2 = setInterval(showProgress, 300);
    }
    function showProgress(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
                document.getElementById("pvalue").innerHTML = this.responseText;
        }

        var p = document.getElementById("pvalue").innerHTML;
        xhttp.open("GET", "AjaxAction2.php?cp="+p, true);
        xhttp.send();
        if(p>=100)
            clearInterval(alarm2);
        document.getElementById("myprogress").style.display="block";
        document.getElementById("myprogress").value = p;

    }
</script>
</body>
</html>
