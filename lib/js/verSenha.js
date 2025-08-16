document.addEventListener('DOMContentLoaded', function () {
  const senhaInput = document.getElementById('senha');
  const toggle = document.getElementById('toggleSenha');

  toggle.addEventListener('click', function () {
    const tipo = senhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
    senhaInput.setAttribute('type', tipo);

    // Alterna o ícone (se estiver usando Font Awesome)
    toggle.innerHTML = tipo === 'password' ? '👁️' : '🙈';
  });
});