<p><span><b>&raquo; CONFIRMAR CADASTRO</b><br>
  <br>
  Você recebeu um email para confirmar seu registro...<br>
  -No email possui o código de segurança.<br>
  -Insira o código de segurança no campo abaixo:
  </span></p><br />

<form name="form1" method="post" action="">
  <table width="406" border="0">
    <tr>
      <td width="236"><span>Email:</span></td>
      <td width="197"><input type="text" name="email_c" id="form_text" /></td>
    </tr>
    <tr>
      <td><span>Código de Segurança:</span></td>
      <td><input type="text" name="codigo" id="form_text" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="confir" id="submit_cadastro2" value="Confirmar" /></td>
    </tr>
  </table>
</form>
<p>&nbsp; </p>
<?php
if(isset($_POST['confir'])) {
    if(!empty($_POST['codigo']) && !empty($_POST['email_c'])) {
        include('config/connect.php');
        include('func/func_protect.php');
        
        $email_digitado = anti_inject_text($_POST['email_c'], $conn);
        $codigo_digitado = anti_inject_text($_POST['codigo'], $conn);
        
        $buscar_email_codi = $conn->query("SELECT * FROM confirmar_accounts WHERE email = '$email_digitado' and codigo_seguranca = '$codigo_digitado'");
        
        if($buscar_email_codi->num_rows >= 1) {
            $exibir_dados = $buscar_email_codi->fetch_assoc();
            
            $nome_com = $exibir_dados['nome_completo'];
            $email_b = $exibir_dados['email'];
            $login_b = $exibir_dados['login'];
            $senha_b = $exibir_dados['senha'];
            
            $update_accounts = $conn->query("INSERT INTO accounts(login, password, email, nome_completo) VALUES('$login_b', '$senha_b', '$email_b', '$nome_com')");
            
            if($update_accounts) {
                echo '<div id="msg_sucesso">Seu cadastro foi ativado com sucesso. Bom Jogo!</div>';
                $assunto_new = "Ativação realizada com sucesso.";
                $msg_new = "Olá $nome_com;\nObrigado por ativar a sua conta no $nome_server, a staff deseja a você um bom jogo e siga as regras para evitar problemas futuros, você encontra as Regras e outras informações em nosso site, visite: $link_site\n\nAtenciosamente,\n$nome_server Staff.";
                $enviar_new_email = mail($email_b, $assunto_new, $msg_new, $email_remetente);
                $deletar_dados = $conn->query("DELETE FROM confirmar_accounts WHERE email = '$email_b'");
            } else {
                echo '<div id="msg_alert">Erro ao confirmar o registro; Tente novamente...</div>';
            }
        } else {
            echo '<div id="msg_alert">Você digitou o código errado ou a conta já foi confirmada.</div>';
        }
    }
}
?>
<div id="termo_bt"><a class="text_alink1" href="index.php?pag=cadastro">Você ainda não possui um cadastro?</a></div>
