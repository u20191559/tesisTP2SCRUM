<!-- Fondo de imagen desenfocado y recortado -->
<div style="
    background-image: url('https://noticias.upc.edu.pe/wp-content/uploads/2018/06/ms_si-scaled.jpg');
    background-size: cover;
    background-position: top center; /* ahora solo muestra la parte de arriba */
    filter: blur(8px);
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: -1;">
</div>

<!-- Contenedor centrado -->
<div style="
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    position: relative;
    z-index: 1;
    font-family: 'Arial', sans-serif;
">

    <!-- Componente de login -->
    <div style="
        background: #ffffff;
        padding: 40px 30px 80px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
        width: 100%;
        max-width: 400px;
        position: relative;
    ">

        <div style="text-align: center; margin-bottom: 30px;">
            <!-- Logo más grande -->
            <img src="http://imgfz.com/i/TnrcksY.png" alt="SCRUM Universidad" style="width: 130px;">
            <p style="color: #555; font-size: 14px;">Aplicando SCRUM a la enseñanza y proyectos educativos</p>
        </div>

        <?= $this->hook->render('template:auth:login-form:before') ?>

        <?php if (isset($errors['login'])): ?>
            <div style="color: #e74c3c; background: #fdecea; padding: 10px; border-radius: 6px; margin-bottom: 20px; text-align: center;">
                <?= $this->text->e($errors['login']) ?>
            </div>
        <?php endif ?>

        <?php if (! HIDE_LOGIN_FORM): ?>
        <form method="post" action="<?= $this->url->href('AuthController', 'check') ?>">

            <?= $this->form->csrf() ?>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #0056b3;">Usuario</label>
                <input type="text" name="username" required autofocus autocomplete="username" style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 6px;
                    background-color: #f0f8ff;
                    font-size: 14px;
                    color: #333;
                ">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #0056b3;">Contraseña</label>
                <input type="password" name="password" required autocomplete="current-password" style="
                    width: 100%;
                    padding: 10px;
                    border: 1px solid #ccc;
                    border-radius: 6px;
                    background-color: #f0f8ff;
                    font-size: 14px;
                    color: #333;
                ">
            </div>

            <?php if (REMEMBER_ME_AUTH): ?>
                <div style="margin-bottom: 20px;">
                    <label style="font-size: 14px; color: #555;">
                        <input type="checkbox" name="remember_me" checked> Recordarme
                    </label>
                </div>
            <?php endif ?>

            <div style="margin-bottom: 20px;">
                <button type="submit" style="
                    background-color: #0056b3;
                    color: white;
                    border: none;
                    padding: 12px 0;
                    width: 100%;
                    border-radius: 6px;
                    font-size: 16px;
                    font-weight: bold;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                "
                onmouseover="this.style.backgroundColor='#003d80';"
                onmouseout="this.style.backgroundColor='#0056b3';">
                    Iniciar sesión
                </button>
            </div>

        </form>
        <?php endif ?>

        <?= $this->hook->render('template:auth:login-form:after') ?>

        <!-- Logo de la UPC en la esquina inferior derecha -->
        <div style="position: absolute; bottom: 15px; right: 15px;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fc/UPC_logo_transparente.png" alt="UPC" style="width: 50px; opacity: 0.8;">
        </div>

    </div>

</div>
