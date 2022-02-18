<form method="POST" action="{{ route('setor.destroy', $department->id) }}">
    @method('DELETE')
    @csrf
    <div class="modal fade" id="modalDeletar{{$department->id}}" tabindex="-1"
        aria-labelledby="modalDeletarLabel{{$department->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeletarLabel{{$department->id}}">Deletar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Certeza que deseja exluir?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>
