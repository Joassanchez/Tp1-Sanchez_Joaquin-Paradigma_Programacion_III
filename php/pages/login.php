<div class="login-container">
        <h2>Iniciar sesión</h2>
        
        <!-- Mostrar mensaje de error si existe -->
        <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 'password_incorrect') {
                echo '<p style="color: red;">La contraseña es incorrecta. Por favor, inténtalo de nuevo.</p>';
            } elseif ($error == 'user_not_found') {
                echo '<p style="color: red;">El usuario no existe o la cuenta está desactivada.</p>';
            } elseif ($error == 'fields_missing') {
                echo '<p style="color: red;">Por favor, completa todos los campos.</p>';
            }
        }
        ?>

        <form action="./php/auth/procesar_login.php" method="POST">
            <div>
                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>
    </div>