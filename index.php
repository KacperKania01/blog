<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php
        $conn = new mysqli("remotemysql.com", "fdvZGG67Fb", "liGhckjUa1", "fdvZGG67Fb");

        if(isset($_GET['akcja'])){  //sprawdzenie czy został klikniety jakis tag
            $zmienna = $_GET['akcja'];
            $result = $conn->query("SELECT Distinct post, zawartosc, post.id FROM post, post_tag, tag WHERE post_tag.id_post = post.id AND post_tag.id_tag = tag.id AND tag.tag = '$zmienna'"); 
        }else{
            $result = $conn->query("SELECT Distinct post, zawartosc, id FROM post");  
        }     
    ?>

<div class="calo">
    <div class="a">
    <div class="tytul">
        <h1>BLOG Kacper Kania IV Ti</h1>
        <a href="index.php">Reset</a>
    </div>
    </div>
    <div class="b">
        <?php
            while($wiersz = $result->fetch_assoc()){
                echo("<div class='header'>");
                    echo("<h1>".$wiersz['post']."</h1>");
                    $posty = $wiersz["id"];
                    $result2 = $conn->query("SELECT tag.tag FROM `post_tag`, post, tag WHERE post_tag.id_post = post.id AND post_tag.id_tag = tag.id AND post_tag.id_post = $posty");
                while($wiersz2 = $result2->fetch_assoc()){
                    echo("<tr><b><a href='?akcja=".$wiersz2['tag']."'>".$wiersz2['tag']."</a></b></tr>, ");
                } 
                echo("</div>");
                echo("<div class='main'>");
                    echo("<p>".$wiersz['zawartosc']."</p>");
                echo("</div>");
            }
        ?>
    </div>
</div>
</body>
</html>
