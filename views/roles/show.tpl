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
                    <td>{$role.id}</td>
                </tr>
                <tr>
                    <th>Nombre:</th>
                    <td>{$role.nombre}</td>
                </tr>
                <tr>
                    <th>Fecha creación:</th>
                    <td>{$role.created_at}</td>
                </tr>
                <tr>
                    <th>Fecha de actualización:</th>
                    <td>{$role.updated_at}</td>
                </tr>
            </table>
            <p>
                <a href="{$_layoutParams.root}roles" class="btn btn-primary btn-sm">Volver</a>
            </p>
        </div>
    </div>
</div>