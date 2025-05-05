<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
  <h2>Login</h2>

  <?php if (!empty($erro)): ?>
    <p class="erro"><?php echo htmlspecialchars($erro); ?></p>
  <?php endif; ?>

  <form action="/usuario/login" method="POST" class="formulario">
    <label for="usuario">Usuário:</label>
    <input type="text" name="usuario" id="usuario" required>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>

    <button type="submit">Entrar</button>
  </form>

  <p>Não tem uma conta? <a href="/usuario/cadastrar">Cadastre-se</a></p>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>


