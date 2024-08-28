<div class="task {{$data['is_done'] ? 'task_done' : 'task_pending'}}">
    <div class="title">
        <input type="checkbox" onchange="taskUpdate(this)" data-id="{{$data['id']}}"
            @if ($data && $data['is_done'])
                checked
            @endif
        />

        <div class="task-title">{{$data['title'] ?? ''}}</div>
    </div>
    <div class="priority">
        <div class="sphere"></div>
        <div style="color:{{$data['category']->color ?? '#FFFF'}}">{{$data['category']->title ?? ''}}</div>
    </div>
    <div class="actions">
        <a href="{{route('tasks.edit', [ 'id' => $data['id'] ])}}">
            <img src="/assets/images/icon-edit.png" alt="Icone de edição" />
        </a>
        
        <a href="{{route('tasks.delete', [ 'id' => $data['id'] ])}}">
            <img src="/assets/images/icon-delete.png" alt="Icone para deletar" />
        </a>
        
    </div>
</div>
