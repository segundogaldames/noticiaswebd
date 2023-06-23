<div class="card">
    <div class="card-body">
        <h1 class="card-title">
            {$asunto}
        </h1>
        <div class="col-md-6">
            {include file="../partials/_messages.tpl"}
            <form action="{$_layoutParams.root}{$process}" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email"
                        aria-describedby="email">
                    <div id="email" class="form-text text-danger">Ingrese su email</div>
                </div>
            
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" aria-describedby="password">
                    <div id="password" class="form-text text-danger">Ingrese su password</div>
                </div>
            
                <input type="hidden" name="send" value="{$send}">
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>
    </div>
</div>