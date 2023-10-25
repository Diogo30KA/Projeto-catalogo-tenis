<?php
$conectar = mysql_connect('localhost','root','');
$banco    = mysql_select_db('empresa');

//pesquisar para select

$sql_marcas      = "SELECT codigo, nome FROM marcas ";
$pesquisar_marcas = mysql_query($sql_marcas);

 //--- pesquisar categorias para select -------

$sql_categorias       = "SELECT codigo, nome FROM categorias ";
$pesquisar_categorias = mysql_query($sql_categorias);

 //--- pesquisar colunistas para select -------

$sql_generos       = "SELECT codigo, nome FROM generos ";
$pesquisar_generos = mysql_query($sql_generos);


if (isset($_POST['gravar']))
{
$codigo       = $_POST['codigo'];
$nome       = $_POST['nome'];
$codmarca    = $_POST['codmarca'];
$codcategoria = $_POST['codcategoria'];
$codgenero = $_POST['codgenero'];
$cor       = $_POST['cor'];
$descricao       = $_POST['descricao'];
$fotochamada  = $_FILES['fotochamada'];
$foto1        = $_FILES['foto1'];
$foto2        = $_FILES['foto2'];

$pasta = "fotos/";

 if(!file_exists($pasta))
 {
     mkdir($pasta);
 }

$foto_chamada = $pasta.$fotochamada["name"];
$foto1_nome   = $pasta.$foto1["name"];
$foto2_nome   = $pasta.$foto2["name"];

move_uploaded_file($foto_chamada["tmp_name"], $foto_chamada);
move_uploaded_file($foto1["tmp_name"], $foto1_nome);
move_uploaded_file($foto2["tmp_name"], $foto2_nome);

$sql = "INSERT INTO tenis (codigo,nome,codmarca,codcategoria,codgenero,
                              cor,descricao,fotochamada,foto1,foto2)
        VALUES ('$codigo','$nome','$codmarca','$codcategoria','$codgenero',
                '$cor','$descricao','$foto_chamada','$foto1_nome','$foto2_nome')";

$resultado = mysql_query($sql);

if ($resultado)
     {  echo 'Dados cadastrados com Sucesso'; }
else
     {  echo "Erro ao cadastrar os dados..."; }
}


//se escolher opção ALTERAR
if(isset($_POST["alterar"]))
{
    $codigo       = $_POST['codigo'];
    $nome       = $_POST['nome'];
    $codmarca    = $_POST['codmarca'];
    $codcategoria = $_POST['codcategoria'];
    $codgenero = $_POST['codgenero'];
    $cor       = $_POST['cor'];
    $descricao       = $_POST['descricao'];
    $fotochamada  = $_FILES['fotochamada'];
    $foto1        = $_FILES['foto1'];
    $foto2        = $_FILES['foto2'];

    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",$fotochamada['name'],$ext);
    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",$foto1['name'],$ext);
    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i",$foto2['name'],$ext);

    // Gera um nome unico para a imagem
    $nome_fotochamada = md5(uniqid(time())).".".$ext[1];
    $nome_imagem1 = md5(uniqid(time())).".".$ext[1];
    $nome_imagem2 = md5(uniqid(time())).".".$ext[1];

    // Caminho de onde armazena a imagem (pasta criada para fotos)
    $caminho_fotochamada = "fotos/".$nome_fotochamada;
    $caminho_imagem1 = "fotos/".$nome_imagem1;
    $caminho_imagem2 = "fotos/".$nome_imagem2;

    // Faz o upload da imagem para seu respectivo caminho (pasta criada para fotos)
    move_uploaded_file($fotochamada['tmp_name'],$caminho_fotochamada );
    move_uploaded_file($foto1['tmp_name'],$caminho_imagem1);
    move_uploaded_file($foto2['tmp_name'],$caminho_imagem2);


    $sql = "update tenis set descricao = '$descricao', fotochamada = '$caminho_fotochamada', 
            foto1 = '$caminho_imagem1', foto2 = '$caminho_imagem2'
            where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado)
    {
        echo "Dados alterados com sucesso!";
    }
    else
    {
        echo "ERRO ao alterar dados!";
    }
}

//se escolher opção EXCLUIR
if(isset($_POST["excluir"]))
{
    $codigo       = $_POST['codigo'];
    $nome       = $_POST['nome'];
    $codmarca    = $_POST['codmarca'];
    $codcategoria = $_POST['codcategoria'];
    $codgenero = $_POST['codgenero'];
    $cor       = $_POST['cor'];
    $descricao       = $_POST['descricao'];
    $fotochamada  = $_FILES['fotochamada'];
    $foto1        = $_FILES['foto1'];
    $foto2        = $_FILES['foto2'];

    $sql = "delete from tenis
            where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado)
    {
        echo "Dados excluídos com sucesso!";
    }
    else
    {
        echo "ERRO ao excluir dados!";
    }
}

//se escolher opção PESQUISAR
if(isset($_POST["pesquisar"]))
{
    $sql = "select * from tenis";
    $resultado = mysql_query($sql);

    //verifica o resultado da pesquisa (0 ou 1)
    if (mysql_num_rows($resultado) == 0)
    {
        echo "Sua pesquisa não retornou resultados... ";
    }
    else
    {
        echo "Resultado da Pesquisa dos tênis: "."<br>";
        //mostrar na tela os valores encontrados
        while($tenis = mysql_fetch_array($resultado))
        {
            echo "Codigo: ".$tenis['codigo']."<br>".
                 "Nome: ".$tenis['nome']."<br>".
                 "Codmarca: ".$tenis['codmarca']."<br>".
                 "Cod Categoria: ".$tenis['codcategoria']."<br>".
                 "Cod genero: ".$tenis['codgenero']."<br>".
                 "Cor: ".$tenis['cor']."<br>".
                 "Descricao: ".$tenis['descricao']."<br>".
                 "Foto Chamada: "."<br>".
                 utf8_encode('<img src="'.$tenis['fotochamada'].'"height="100" width="150" />')."<br><br>".
                 "Foto1: "."<br>".
                 utf8_encode('<img src="'.$tenis['foto1'].'"height="100" width="150" />')."<br><br>".
                 "Foto2: "."<br>".
                 utf8_encode('<img src="'.$tenis['foto2'].'"height="100" width="150" />')."<br><br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro tenis</title>
</head>
<body>
    <form name="formulario" method="post" action="cadastrotenis.php" enctype="multipart/form-data">
        <h1>Cadastro dos Tenis - Empresa

        </h1>
        Codigo: 
        <input type="text" name="codigo" id="codigo" size=30>
        <br><br>
        Nome:
        <input type="text" name="nome" id="nome" size=30>
        <br><br>
        Cod marca:
        <select name="codmarca" id="codmarca">
        <option value=0>Selecionar a marca</option>
        <?php
        if(mysql_num_rows($pesquisar_marcas) <> 0)
        {
            while($marcas = mysql_fetch_array($pesquisar_marcas))
            {
                echo '<option value="'.$marcas['codigo'].'">'.
                                       $marcas['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        Cod Categoria:
        <select name="codcategoria" id="codcategoria">
        <option value=0>Selecionar a categoria</option>
        <?php
        if(mysql_num_rows($pesquisar_categorias) <> 0)
        {
            while($categorias = mysql_fetch_array($pesquisar_categorias))
            {
                echo '<option value="'.$categorias['codigo'].'">'.
                                       $categorias['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        Cod genero:
        <select name="codgenero" id="codgenero">
        <option value=0>Selecionar o genero</option>
        <?php
        if(mysql_num_rows($pesquisar_generos) <> 0)
        {
            while($generos = mysql_fetch_array($pesquisar_generos))
            {
                echo '<option value="'.$generos['codigo'].'">'.
                                       $generos['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        Cor: 
        <input type="text" name="cor" id="cor" size=30>
        <br><br>
        Descricao: <br>
        <textarea name="descricao" id="descricao" rows=6 cols=70></textarea>
        <br><br>
        <!-- Descricao: 
        <input type="text" name="descricao" id="descricao" size=30>
        <br><br> -->
        Foto Chamada: 
        <input type="file" name="fotochamada" id="fotochamada" size=30>
        <br><br>
        Foto 1: 
        <input type="file" name="foto1" id="foto1" size=30>
        <br><br>
        Foto 2: 
        <input type="file" name="foto2" id="foto2" size=30>
        <br><br>

        <input type="submit" name="gravar" id="gravar" value="Gravar">
        <input type="submit" name="alterar" id="alterar" value="Alterar">
        <input type="submit" name="excluir" id="excluir" value="Excluir">
        <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
    </form>
</body>
</html>