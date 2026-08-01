<?php
$senha = '0808';
$hash = password_hash($senha, PASSWORD_DEFAULT);

echo "Senha original: " . $senha . "<br>";
echo "Hash gerado: " . $hash . "<br><br>";
echo "SQL para atualizar no banco:<br>";
echo "UPDATE `usuario` SET `senha` = '" . $hash . "' WHERE `usuario` = 'Isaias';";
?>
