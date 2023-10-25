<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('empresa');


$sql_marcas      = "SELECT codigo, nome FROM marcas ";
$pesquisar_marcas = mysql_query($sql_marcas);

 

$sql_categorias       = "SELECT codigo, nome FROM categorias ";
$pesquisar_categorias = mysql_query($sql_categorias);



$sql_generos       = "SELECT codigo, nome FROM generos ";
$pesquisar_generos = mysql_query($sql_generos);


$vazio = 0;


if(!empty($_POST['pesq_marcas']))
{
    $marcas  = (empty($_POST['codmarca']))? 'null' : $_POST['codmarca'];

    if ($marcas <> '')
    {
     $sql_tenis = "SELECT tenis.fotochamada, tenis.nome, tenis.cor, tenis.descricao
                      FROM tenis
                      WHERE tenis.codmarca ='$marcas'";
     
     $seleciona_tenis = mysql_query($sql_tenis);
     $vazio = 1;
     }
}

if(!empty($_POST['pesq_categoria']))
{                                                                                          
    $categoria  = (empty($_POST['codcategoria']))? 'null' : $_POST['codcategoria'];

    if ($categoria <> '')
    {
     $sql_tenis = "SELECT tenis.fotochamada, tenis.nome, tenis.cor, tenis.descricao
                      FROM tenis
                      WHERE tenis.codcategoria ='$categoria'";

     $seleciona_tenis = mysql_query($sql_tenis);
     $vazio = 1;
     }
}

if(!empty($_POST['pesq_genero']))
{
    $genero  = (empty($_POST['codgenero']))? 'null' : $_POST['codgenero'];

    if ($genero <> '')
    {
     $sql_tenis = "SELECT tenis.fotochamada, tenis.nome, tenis.cor, tenis.descricao
                      FROM tenis
                      WHERE tenis.codgenero ='$genero'";

     $seleciona_tenis = mysql_query($sql_tenis);
     $vazio = 1;
     }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css" />
    <title>Catálogo</title>
</head>
<body>
    <div id="superior">
        <b>-THE BEST SHOES-</b>
    </div>

    <br>

    <div id="pesquisa">

<form name="form_marcas" method="post" action="catalogo.php">
<b>Marcas: </b><select name="codmarca" id="codmarca">
<option value=0 selected="selected">Marcas ...</option>
<?php
if(mysql_num_rows($pesquisar_marcas) == 0)
{
   echo '<h1>Sua busca por marcas não retornou resultados ... </h1>';
}
else
{
  while($resultado = mysql_fetch_array($pesquisar_marcas))
  {
     echo '<option value="'.$resultado['codigo'].'">'.
                utf8_encode($resultado['nome']).'</option>';
  }
}
?>
</select>
<input type="submit" name="pesq_marcas" id="pesq_marcas" value="Pesquisar">

ㅤㅤ

<b>Categorias: </b><select name="codcategoria" id="codcategoria">
<option value=0 selected="selected">Categoria ...</option>
<?php
if(mysql_num_rows($pesquisar_categorias) == 0)
{
   echo '<h1>Sua busca por categorias não retornou resultados ... </h1>';
}
else
{
  while($resultado = mysql_fetch_array($pesquisar_categorias))
  {
     echo '<option value="'.$resultado['codigo'].'">'.
                utf8_encode($resultado['nome']).'</option>';
  }
}
?>
</select>
<input type="submit" name="pesq_categoria" id="pesq_categoria" value="Pesquisar">

ㅤㅤ

<b>Genero: </b><select name="codgenero" id="codgenero">
<option value=0 selected="selected">Genero ...</option>
<?php
if(mysql_num_rows($pesquisar_generos) == 0)
{
   echo '<h1>Sua busca por generos não retornou resultados ... </h1>';
}
else
{
  while($resultado = mysql_fetch_array($pesquisar_generos))
  {
     echo '<option value="'.$resultado['codigo'].'">'.
                utf8_encode($resultado['nome']).'</option>';
  }
}
?>
</select>
<input type="submit" name="pesq_genero" id="pesq_genero" value="Pesquisar">
</form>
</div>
<!-- <hr> -->


<div id="resultados">

<!-------- Mostrar o resultado da pesquisa ----------->
<?php

    if ($vazio == 0)
    {
     $sql_tenis = "select fotochamada, nome, cor, descricao
                      from tenis
                      ORDER BY codigo LIMIT 3";

     $seleciona_tenis = mysql_query($sql_tenis);
     ?>
     <table border=0>
     
     <?php
     echo "<br><b><h1>TÊNIS EM DESTAQUE: </h1></b>"."<br><br>";
     echo '<tr align:>';
 	 while($res = mysql_fetch_array($seleciona_tenis))
			{
              echo '<td width= 400px>'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="280" width="380" />').'<br>';
              echo $res['nome'].'<br>'. $res['cor'].'<br>'.utf8_encode($res['descricao']).'</td>';
			}
     echo '</tr></table>';
    }
    
    else
    {

      ?>
     <table border=0>
     
     <?php
  	 echo "<br><b><h1>TÊNIS PESQUISADOS: </h1></b>"."<br><br>";
  	 echo '<tr>';
 	 while($res = mysql_fetch_array($seleciona_tenis))
			{
              echo '<td width= 400px>'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="280" width="380" />').'<br>';
              echo $res['nome'].'<br>'. $res['cor'].'<br>'.utf8_encode($res['descricao']).'</td>';
			}
     echo '</tr></table>';
    }
?>
    
</div>

<br><br><br><br><br><br>
    <div id="rodape">
        © Desenvolvido por Diogo Kulckamp Alberton
    </div>




</body>
</html>




<!-- <a href="materiacompleta.php">
<a href="materiacompleta.php"> -->


<!-- <div id="resultados">

<?php

    if ($vazio == 0)
    {
     $sql_tenis = "select fotochamada, nome, cor, descricao
                      from tenis
                      ORDER BY codigo LIMIT 4";

     $seleciona_tenis = mysql_query($sql_tenis);
     ?>
     <table border=0>
     <tr>
     <th><b>Tênis em Destaque: </b></th>
     </tr>
     <?php
     echo '<tr>';
 	 while($res = mysql_fetch_array($seleciona_tenis))

			{
              echo '<td>'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="190" width="260" />').'<br>';
              echo $res['nome'].'<br>'. $res['cor'].'<br>'.utf8_encode($res['descricao']).'</td>';
			}
     echo '</tr>';
    }
    else
    {
  	 echo "<b>Tênis pesquisados: </b>"."<br><br>";
  	 echo '<tr>';
 	 while($res = mysql_fetch_array($seleciona_tenis))
			{
              echo '<td>'.utf8_encode('<img src="'.$res['fotochamada'].'"  height="190" width="260" />').'<br>';
              echo $res['nome'].'<br>'. $res['cor'].'<br>'.utf8_encode($res['descricao']).'</td>';
			}
     echo '</tr>';
    }
?>

</div> -->