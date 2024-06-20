<form id="form1" name="form1" method="post" action="">
    <table width="409" height="135" border="0">
        <tr>
            <td width="142" align="left"><span> &raquo; Nome completo:</span></td> echo"";
            <td width="257" align="left"><input type="text" name="nome" id="form_text" /></td>
        </tr>
        <tr>
            <td align="left"><span> &raquo; Email:</span></td>
            <td align="left"><input type="text" name="email" id="form_text" /></td>
        </tr>
        <tr>
            <td align="left"><span> &raquo; Login:</span></td>
            <td align="left"><input type="text" name="login" id="form_text" /></td>
        </tr>
        <tr>
            <td align="left"><span> &raquo; Senha:</span></td>
            <td align="left"><input type="password" name="senha" id="form_text" /></td>
        </tr>
        <tr>
            <td align="left"><span> &raquo; Confirmar senha:</span></td>
            <td align="left"><input type="password" name="cfsenha" id="form_text" /></td>
        </tr>
        <tr>
            <td style="position:absolute; margin-left:30px; color:#CCC;" align="center"><input type="checkbox" name="checkbox" id="checkbox" />Eu li com atenção e concordo com os <a class="text_alink1" href="index.php?pag=regras">Termos de Uso</a>...</td>
        </tr>
        <tr>
            <td align="center"><input type="reset" name="button" id="submit_limpar" value="Limpar" /></td>
            <td align="center"><input type="submit" name="cadastrar" id="submit_cadastro" value="Cadastrar" /></td>
        </tr>
    </table>
    <p>&nbsp;</p>
</form>
<?php
if(isset($_POST['cadastrar'])) {
    if(!isset($_POST['checkbox'])) {
        echo '<div id="msg_alert">Antes de prosseguir você precisa ler e aceitar o <a class="text_alink" href="index.php?pag=regras">Termo de Uso</a>...</div>';
    } else {
        $error = 0;
        $nome_completo = $_POST['nome'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $cfsenha = $_POST['cfsenha'];
        
        // Validando os campos
        if(empty($nome_completo) || empty($email) || empty($login) || empty($senha) || empty($cfsenha)) {
            echo '<div id="msg_alert"><b>ATENÇÃO:</b> Todos os campos devem ser preenchidos...</div>';
            $error = 1;
        } elseif(strlen($nome_completo) < $min_nome_completo || strlen($nome_completo) > $max_nome_completo) {
            echo '<div id="msg_alert">O Nome deve ter no mínimo '.$min_nome_completo.' caracteres e no máximo '.$max_nome_completo.' caracteres...</div>';
            $error = 1;
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div id="msg_alert"><b>ATENÇÃO:</b> O Email digitado não é válido ou não existe...</div>';
            $error = 1;
        } elseif(strlen($login) < $min_login || strlen($login) > $max_login) {
            echo '<div id="msg_alert">O Login deve ter no mínimo '.$min_login.' caracteres e no máximo '.$max_login.' caracteres...</div>';
            $error = 1;
        } elseif(strlen($senha) < $min_senha || strlen($senha) > $max_senha) {
            echo '<div id="msg_alert">A Senha deve ter no mínimo '.$min_senha.' caracteres e no máximo '.$max_senha.' caracteres...</div>';
            $error = 1;
        } elseif($senha != $cfsenha) {
            echo '<div id="msg_alert">A senha digitada não confere com a Confirmação da senha...</div>';
            $error = 1;
        }
        
        if($error == 0) {
            include('config/connect.php');
            include('func/func_protect.php');
            
            // Criptografar a senha com prefixo $2a$
            $salt = '$2a$10$' . substr(str_replace('+', '.', base64_encode(random_bytes(16))), 0, 22);
            $senha_hash = crypt($senha, $salt);
            
            // Verificar se o login já está em uso
            $result_login = $conn->query("SELECT * FROM accounts WHERE login = '$login'");
            if($result_login->num_rows > 0) {
                echo '<div id="msg_alert"><b>ATENÇÃO:</b> O Login digitado já está em uso, tente outro...</div>';
                $error = 1;
            }
            
            // Verificar se o email já está em uso
            $result_email = $conn->query("SELECT * FROM accounts WHERE email = '$email'");
            if($result_email->num_rows > 0) {
                echo '<div id="msg_alert"><b>ATENÇÃO:</b> O Email digitado já está em uso, tente outro...</div>';
                $error = 1;
            }
            
            if($error == 0) {
                // Inserir os dados na tabela
                $insert_query = "INSERT INTO accounts (nome_completo, email, login, password) VALUES ('$nome_completo', '$email', '$login', '$senha_hash')";
                if($conn->query($insert_query) === TRUE) {
                    echo '<div id="msg_sucesso">Seus dados foram cadastrados com sucesso!</div>';
                } else {
                    echo '<div id="msg_alert">Erro ao realizar o registro, tente novamente...</div>';
                }
            }
        }
    }
} else {
?>
<div id="msg_alert">
Caso você já tenha uma conta e precisa confirmar <a class="text_alink" href="index.php?pag=confirmar_rg">Clique Aqui</a>!
</div>
<?php
}
?>