<div class="card mb-4 mt-4">
    <div class="card-header">Idioma</div>
    <div class="card-body">
        <form method="GET">
            <select name="locale" onchange="window.location.href='{{ url('language') }}/' + this.value;" class="form-control w-25">
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
            </select>
        </form>
    </div>
</div>

<div class="card mb-4 mt-4">
    <div class="card-header text-danger font-weight-bold">Eliminar Cuenta</div>
    <div class="card-body">
        <p class="text-muted">Esta acción es irreversible. Si eliminas tu cuenta, toda tu información será permanentemente eliminada y no podrá ser recuperada.</p>
        <form action="#" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es irreversible.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar mi cuenta</button>
        </form>
    </div>
</div>