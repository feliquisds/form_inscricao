<?php
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $data_nasc = $_POST['dataNascimento'];
    $genero = $_POST['genero'];
    $tipo_insc = $_POST['tipoInscricao'];
    $mensagem = $_POST['mensagem'];

    $genero = ($genero == 'Masculino') ? 'M' : (($genero == 'Feminino') ? 'F' : 'O');
    $tipo_insc = ($tipo_insc == 'Palestrante') ? 'PL' : (($tipo_insc == 'Participante') ? 'PR' : 'VO');

    $banco = new PDO('sqlite:../database.db');
    $sql = "INSERT INTO Inscrito (nome, email, telefone, data_nasc, genero, tipo_insc, mensagem) VALUES (:nome, :email, :telefone, :data_nasc, :genero, :tipo_insc, :mensagem)";
    $stmt = $banco->prepare($sql);

    $stmt->execute([
            ':nome'=>$nome,
            ':email'=>$email,
            ':telefone'=>$telefone,
            ':data_nasc'=>$data_nasc,
            ':genero'=>$genero,
            ':tipo_insc'=>$tipo_insc,
            ':mensagem'=>$mensagem
    ]);

    echo "Dados inseridos:";
    echo '<br>';
    echo $nome;
    echo '<br>';
    echo $email;
    echo '<br>';
    echo $telefone;
    echo '<br>';
    echo $data_nasc;
    echo '<br>';
    echo $genero;
    echo '<br>';
    echo $tipo_insc;
    echo '<br>';
    echo $mensagem;
?>