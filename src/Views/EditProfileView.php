<?php
include(TEMPLATE_DIR . "head.inc.php");
include(TEMPLATE_DIR . "nav.inc.php");

$user = $data; // En EditProfileView, el usuario es pasado directamente como $data o $data['user']? 
// Revisando ProfileController: $this->view('EditProfileView', $user);
// Así que $data es el user array directamente.
?>

<main class="profile-page">
    <section class="landing" style="height: auto; min-height: 100vh; padding-top: 100px;">
        <div class="bg-gradient"></div>

        <div class="profile-container"
            style="max-width: 800px; margin: 0 auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); position: relative; z-index: 2;">
            <h1 style="margin-bottom: 30px; border-bottom: 2px solid #f0f0f0; padding-bottom: 15px;">Editar Perfil</h1>

            <form action="/actualizar-perfil" method="POST">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" value="<?php echo $user['nombre'] ?>" class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" value="<?php echo $user['apellidos'] ?>"
                            class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>

                    <div class="form-group">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" name="fechaNacimiento" value="<?php echo $user['fechaNacimiento'] ?>"
                            class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="tel" name="telefono" value="<?php echo $user['telefono'] ?>" class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label>Dirección</label>
                        <input type="text" name="direccion" value="<?php echo $user['direccion'] ?>"
                            class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>

                    <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" name="ciudad" value="<?php echo $user['ciudad'] ?>" class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label>Código Postal</label>
                        <input type="text" name="codigoPostal" value="<?php echo $user['codigoPostal'] ?>"
                            class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>

                    <div class="form-group">
                        <label>País</label>
                        <input type="text" name="pais" value="<?php echo $user['pais'] ?>" class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label>Nacionalidad</label>
                        <input type="text" name="nacionalidad" value="<?php echo $user['nacionalidad'] ?>"
                            class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>

                    <div class="form-group" style="grid-column: span 2;">
                        <label>Número de Pasaporte / DNI</label>
                        <input type="text" name="pasaporte" value="<?php echo $user['pasaporte'] ?>"
                            class="form-control"
                            style="width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                </div>

                <div style="margin-top: 30px; display: flex; justify-content: flex-end; gap: 15px;">
                    <a href="/account"
                        style="padding: 12px 25px; background: #e74c3c; color: white; text-decoration: none; border-radius: 5px;">Cancelar</a>
                    <button type="submit"
                        style="padding: 12px 25px; background: #27ae60; color: white; border: none; border-radius: 5px; cursor: pointer;">Guardar
                        Cambios</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php include(TEMPLATE_DIR . "footer.inc.php") ?>