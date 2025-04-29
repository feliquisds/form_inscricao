<?php
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = preg_replace("/[^0-9]/", '', $_POST['telefone']);
    $data_nasc = $_POST['dataNascimento'];
    $genero = $_POST['genero'];
    $tipo_insc = $_POST['tipoInscricao'];
    $mensagem = $_POST['mensagem'];

    if (! in_array($genero, ['Masculino', 'Feminino', 'Outro']) or // variable is valid
        ! in_array($tipo_insc, ['Palestrante', 'Participante', 'Voluntário']) or // variable is valid
        strtotime('-18 years') < strtotime($data_nasc) or // older than 18
        strlen($telefone) != 11 ) { // valid phone number length
            echo 'Dados não inseridos.';
    }
    else {
        $nome = strlen($nome) > 50 ? substr($nome, 0, 50) : $nome; // limit length
        $genero = ($genero == 'Masculino') ? 'M' : (($genero == 'Feminino') ? 'F' : 'O'); // format for database
        $tipo_insc = ($tipo_insc == 'Palestrante') ? 'PL' : (($tipo_insc == 'Participante') ? 'PR' : 'VO'); // format for database
        $mensagem = strlen($mensagem) > 300 ? substr($mensagem, 0, 300) : $mensagem; // limit length

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
    }
?>