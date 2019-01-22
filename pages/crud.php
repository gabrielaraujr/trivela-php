<?php
include_once("pages/server.php"); //conexao com o banco

//pega a mensagem que tiver na SESSION no momento e exibe
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
}
?>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Hotel</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>Quartos</th>
            <th>Valor (R$)</th>
            <th colspan="2">Ação</th>
        </tr>
    </thead>
    <tbody>
        <!-- percorre o banco e pega as linhas/valores. -->
        <?php while ($linha = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $linha['id']; ?></td>
                <td><?php echo $linha['hotel']; ?></td>
                <td><?php echo $linha['endereco']; ?></td>
                <td><?php echo $linha['telefone']; ?></td>
                <td><?php echo $linha['quartos']; ?></td>
                <td><?php echo $linha['valor']; ?></td>
                <td>
                    <a class="editar-btn" href="principal.php?edit=<?php echo $linha['id']; ?>">Editar</a>
                </td>
                <td>
                    <a class="deletar-btn" href="principal.php?del=<?php echo $linha ['id']; ?>">Deletar</a>
                </td>
            </tr>
        <?php 
    } ?>
    </tbody>
</table>
<div class="linha contato col12 div-form">
    <form method="POST" action="">
        <h2>Cadastrar hotel e quartos para reserva &raquo;</h2>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <p><input type="text" name="hotel" value="<?php echo $hotel; ?>" placeholder="Nome do hotel"></p>
        <p><input type="text" name="endereco" value="<?php echo $endereco; ?>" placeholder="Endereço"></p>
        <p><input type="text" name="telefone" value="<?php echo $telefone; ?>" placeholder="Telefone"></p>
        <p><input type="text" name="quartos" value="<?php echo $quartos; ?>" placeholder="Número de quartos"></p>
        <p><input type="text" name="valor" value="<?php echo $valor; ?>" placeholder="Valor por quarto"></p>
        <?php if ($editar == false) : ?> <!-- se caso editar == true, ele troca o botão para EDITAR. -->
        <p><button type="submit" name="salvar" class="button">Salvar</button></p>
        <?php else : ?> <!-- se nÃÂ£o, botÃÂ£o fica SALVAR. -->
        <p><button type="submit" name="editar" class="button">Editar</button></p>
        <?php endif ?>
    </form>
</div>