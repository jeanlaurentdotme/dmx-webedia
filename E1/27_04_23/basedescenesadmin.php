<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Gestion de scènes</title>
    <link rel='stylesheet' href='css/main.css'/>
  <!---
    <script src='main.js'></script>
  -->
    <link rel="icon" type="image/png" href="images/icone.png"/>
    <script>
    function allowDrop(ev)
    {
        ev.preventDefault();
    }
    
    function drag(ev)
    {
        ev.dataTransfer.setData("text", ev.target.id);
    }
    
    function drop(ev)
    {
        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        ev.target.appendChild(document.getElementById(data));
    }
    function recup()
    {
        var donnees="";
        let iduser = document.getElementById("button").value;
        console.log(iduser);
        var xhr_object = new XMLHttpRequest();
        var method = "POST";
        var filename = "listesceneuser.php";
        xhr_object.open(method, filename, true);
        xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
        let nbscene = 0;
	    for (let i=1; i<21; i++) 
        {
	    	var c = "tab"+i;
            let tabid = document.getElementById(c);
    		
		    if (tabid.hasChildNodes())
            {
  			    const enfant = tabid.firstElementChild;
                var e = enfant.id;
                const d = [c, enfant.id];
                console.log(enfant);
                console.log(e);
                donnees = donnees+"postab"+nbscene+"="+i+"&idscene"+nbscene+"="+e+"&";
                nbscene = nbscene + 1;
		    }
	    }
        xhr_object.onreadystatechange = function()
        { 
            if (xhr_object.readyState == 4)
            {
                console.log("Donnnees enregistrées");
            }
        }
        donnees = donnees+"iduser="+iduser+"&nbscene="+nbscene;
        xhr_object.send(donnees);
    }
    </script>
</head>
<body>
<?php
    include ("connect.php");
    session_start();
    if (!isset($_SESSION['login'])){header('Location: index.php');
        exit();}
    $pseudo = $_SESSION['login'];
    $iduser = $_SESSION['id'];
    $connexion = mysqli_connect (SERVEUR, LOGIN, MDP);    
    if (!$connexion)
    {
       echo "LA CONNEXION AU SERVEUR MYSQL A ECHOUE\n";
       exit();
    }
    $oui = new mysqli(SERVEUR, LOGIN, MDP, BDD);
    // on parcourt la bdd et on range les éventuels login identiques existants dans un tableau
    $sql = 'SELECT * FROM SceneTest';
    $resultat = $oui->query($sql);
    ?>
    <header><?php echo $pseudo;?></header>
        <div height="1800px" width="100%">
            <div id="divConteneur1">
                <table class="base">
                    <tr>
                        <td colspan="5">
                            <img class="avatar" src="images/logo.jpg" alt="Logo de user">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="oui"><a href="admin.php">Retour à l'interface</a><button id ="button" value ="<?php echo $iduser; ?>" onclick="recup()">Engistrer</button></td>

                    </tr>
                    <tr class="div2">
                    <?php 
                    $nbscene = 0;
                    while($data = $resultat->fetch_assoc())
                    {
                        if($nbscene%5==0 AND $nbscene!=0)
                        {
                            ?>
                            </tr>
                            <tr class="div3">
                            <td ondrop="drop(event)" ondragover="allowDrop(event)"><div class ="div3" style=background-color:<?php echo $data['couleurscene']?> id="<?php echo $data['id']?>" draggable="true" ondragstart="drag(event)" id="drag<?php echo $data['id']?>"><?php echo $data['nom']?></div></td>
                            <?php
                        }
                        else
                        {
                            ?>
                            <td ondrop="drop(event)" ondragover="allowDrop(event)"><div class ="div3" style=background-color:<?php echo $data['couleurscene']?> id="<?php echo $data['id']?>" draggable="true" ondragstart="drag(event)" id="drag<?php echo $data['id']?>"><?php echo $data['nom']?></div></td>                        
                            <?php
                        }
                    $nbscene++;
                    } ?>
                    </tr>
                </table>
                </div>
                <div>
                    <table class="scenes">
                        <tr>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab1></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab2></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab3></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab4></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab5></td>
                        </tr>
                        <tr>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab6></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab7></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab8></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab9></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab10></td>
                        </tr>
                        <tr>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab11></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab12></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab13></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab14></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab15></td>
                        </tr>
                        <tr>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab16></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab17></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab18></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab19></td>
                            <td class="div1" ondrop="drop(event)" ondragover="allowDrop(event)" id=tab20></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
</body>
</html>