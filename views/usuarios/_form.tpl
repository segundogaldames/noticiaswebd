<form action="{$_layoutParams.root}{$process}" method="post">
    <div class="mb-3">
        <label for="run" class="form-label">RUN </label>
        <input type="text" name="run" value="{$usuario.run|default:""}" class="form-control" id="run" aria-describedby="run">
        <div id="run" class="form-text text-danger">Ingrese el RUN del usuario</div>
    </div>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" value="{$usuario.nombre|default:""}" class="form-control" id="nombre" aria-describedby="nombre">
        <div id="nombre" class="form-text text-danger">Ingrese el nombre del usuario</div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" value="{$usuario.email|default:""}" class="form-control" id="email" aria-describedby="email">
        <div id="email" class="form-text text-danger">Ingrese el email del usuario</div>
    </div>
    <div class="mb-3">
        <label for="rol" class="form-label">Rol</label>
        <select name="rol" class="form-control">
            {if $action == 'edit'}
                <option value="{$usuario.role_id}">{$usuario.role.nombre}</option>
            {/if}
            <option value="">Seleccione un rol</option>
            {foreach from=$roles item=role}
                <option value="{$role.id}">{$role.nombre}</option>
            {/foreach}
        </select>
        <div id="rol" class="form-text text-danger">Seleccione el rol del usuario</div>
    </div>
    {if $action == 'edit'}
        <div class="mb-3">
            <label for="activo" class="form-label">Estado</label>
            <select name="activo" class="form-control">
                {if $usuario.activo == 1}
                    <option value="1">Activo</option>
                    <option value="2">Desactivar</option>
                {else}
                    <option value="2">Inactivo</option>
                    <option value="1">Activar</option>
                {/if}
            </select>
            <div id="rol" class="form-text text-danger">Seleccione el estado del usuario</div>
        </div>
    {/if}
    {if $action == 'create'}
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" aria-describedby="password">
            <div id="password" class="form-text text-danger">Ingrese el password del usuario</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Confirmar password</label>
            <input type="password" name="repassword" class="form-control" id="repassword" aria-describedby="repassword">
            <div id="repassword" class="form-text text-danger">Confirme el password del usuario</div>
        </div>
    {/if}
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="send" value="{$send}">
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{$_layoutParams.root}roles" class="btn btn-link">Volver</a>
</form>