<x-layout>
    <x-slot:btn>
        <a href="{{route('tasks.create')}}" class="btn btn-primary">
            Criar tarefa
        </a>
        <a href="{{route('logout')}}" class="btn btn-primary">
            Sair
        </a>
    </x-slot:btn>
        <section class="graph">
            <div class="graph-header">
                <h2>Progresso do Dia</h2>
                <div class="graph-header-line"></div>
                <div class="graph-header-date">
                    <a href="{{route('home', ['date' => $date_prev_button])}}">
                        <img src="/assets/images/icon-prev.png" alt="Anterior">
                    </a>
                    {{$date_as_string}}
                    <a href="{{route('home', ['date' => $date_next_button])}}">
                        <img src="/assets/images/icon-next.png" alt="Proximo">
                    </a>
                </div>
                
            </div>
            <div class="graph-header-subtitle"> 
                Tarefa: <b>{{$task_count - $undone_tasks_count}}/{{$task_count}}</b>
            </div>

            <x-bladewind::progress-circle
                shade="dark"
                color="indigo"
                size="350"
                circle_width="40"
                align="100"
                valign="50"
                text_size="50"
                percentage="{{round(($done_tasks_count / ($task_count !== 0 ? $task_count : 1)) * 100)}}"
                show_label="true"
                show_percent="true"
                animate="false" 
            />

            <div class="tasks-left-footer">
            <img src="/assets/images/icon-info.png" alt="Infos">
            Restam {{$undone_tasks_count}} tarefas para serem realizadas
            </div>
        </section>
        <section class="list">
            <div class="list-header ">
                <select class="list-header-select" onChange="changeTaskStatusFilter(this)">
                    <option value="all_tasks">Todas as tarefas</option>
                    <option value="task_pending">Tarefas Pendentes</option>
                    <option value="task_done">Tarefas Realizadas</option>
                </select>
            </div>
            <div class="task-list">
                @foreach ($tasks as $task)
                    <x-task :data=$task />
                @endforeach
            </div>
        </section>
    <script>
        function changeTaskStatusFilter(e) {
            showAllTasks()

            if(e.value == 'task_pending') {
                document.querySelectorAll('.task_done').forEach(function(element) {
                    element.style.display = 'none';
                })
            } else if(e.value == 'task_done') {
                document.querySelectorAll('.task_pending').forEach(function(element) {
                    element.style.display = 'none';
                })
            }
        }

        function showAllTasks() {
            document.querySelectorAll('.task').forEach(function(element) {
                element.style.display = 'flex';
            })
        }
    </script>
    <script>
        async function taskUpdate(element) {
            let status = element.checked;
            let taskId = element.dataset.id;
            let url = '{{route('tasks.update')}}'
            let rawResult = await fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-type': 'application/json',
                    'accept': 'application/json'
                },

                //Envia para o backend e valida o token
                body: JSON.stringify({status, taskId, _token: '{{ csrf_token() }}'})
            })

            result = await rawResult.json();
            
            if(result.success) {
                location.reload()
            } else {
                element.checked = !status
            }
            
        }
    </script>

</x-layout>