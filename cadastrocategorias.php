<?php
//conectar ao servidor e ao banco de dados
$conectar = mysql_connect("localhost","root","");
//conectar ao banco (sql)
$banco = mysql_select_db("empresa");

//se escolher opção GRAVAR
if(isset($_POST["gravar"]))
{
    //receber as variavies do html
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];

    //comandoMYSQL para gravar banco
    $sql = "insert into categorias (codigo,nome) 
            values ('$codigo','$nome')";

    //executar o comando sql no banco dados
    $resultado = mysql_query($sql);

    //verificar se gravou (sem erros)
    if ($resultado)
    {
        echo "Dados gravados com sucesso!";
    }
    else
    {
        echo "ERRO ao gravar!";
    }
}

//se escolher opção ALTERAR
if(isset($_POST["alterar"]))
{
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];

    $sql = "update categorias set nome = '$nome'
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
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];

    $sql = "delete from categorias
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
    $sql = "select * from categorias";
    $resultado = mysql_query($sql);

    //verifica o resultado da pesquisa (0 ou 1)
    if (mysql_num_rows($resultado) == 0)
    {
        echo "Sua pesquisa não retornou resultados... ";
    }
    else
    {
        echo "Resultado da Pesquisa das categorias: "."<br>";
        //mostrar na tela os valores encontrados
        while($categorias = mysql_fetch_array($resultado))
        {
            echo "Codigo: ".$categorias['codigo']."<br>".
                 "Nome: ".$categorias['nome']."<br><br>";
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
    <title>Cadastro categorias</title>
</head>
<body>
    <form name="formulario" method="post" action="cadastrocategorias.php">
        <h1>Cadastro das Categorias - Empresa

        </h1>
        Codigo: 
        <input type="text" name="codigo" id="codigo" size=30>
        <br><br>
        Nome:
        <input type="text" name="nome" id="nome" size=30>
        <br><br>
        <input type="submit" name="gravar" id="gravar" value="Gravar">
        <input type="submit" name="alterar" id="alterar" value="Alterar">
        <input type="submit" name="excluir" id="excluir" value="Excluir">
        <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
    </form>
</body>
</html>