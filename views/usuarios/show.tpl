<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto}
        </h1>
        {include file="../partials/_messages.tpl"}
        <div class="col-md-6">
            <table class="table table-hover">
                <tr>
                    <th>Id:</th>
                    <td>{$usuario.id}</td>
                </tr>
                <tr>
                    <th>RUN:</th>
                    <td>{$usuario.run}</td>
                </tr>
                <tr>
                    <th>Nombre:</th>
                    <td>{$usuario.nombre}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{$usuario.email}</td>
                </tr>
                <tr>
                    <th>Estado:</th>
                    <td>
                        {if $usuario.activo == 1}
                            Activo
                        {else}
                            Inactivo
                        {/if}
                    </td>
                </tr>
                <tr>
                    <th>Rol:</th>
                    <td>{$usuario.role.nombre}</td>
                </tr>
                <tr>
                    <th>Fecha creación:</th>
                    <td>{$usuario.created_at}</td>
                </tr>
                <tr>
                    <th>Fecha de actualización:</th>
                    <td>{$usuario.updated_at}</td>
                </tr>
            </table>
            <p>
                <a href="{$_layoutParams.root}usuarios" class="btn btn-primary btn-sm">Volver</a>
            </p>
        </div>
    </div>
</div>