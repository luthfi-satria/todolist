const btnAdd = document.getElementById('btnAdd');

btnAdd.addEventListener('click', addTask);

window.addEventListener('load', loadTask);

function loadTask(){
    document.getElementById('task_list').innerHTML = '';
    ApiRequest().done((result) => {
        const listContent = fetchList(result?.data);
        document.getElementById('task_list').innerHTML = listContent;
        document.getElementById('total_count').innerHTML = result?.stats?.total;
        document.getElementById('complete_count').innerHTML = result?.stats?.is_complete?.total;
    })
}

async function addTask(){
    const {value: formValues} = await mySweet({
        title: 'Add Task',
        text: 'please input the field',
        html: `
            <div class="field">
                <label>Task Name</label>
                <input id="inp_name" type="text" name="name" class="input" placeholder="task name..." autocomplete="off"/>
            </div>
            <div class="field">
                <label>Priority</label>
                <select id="inp_priority" class="input">
                    <option value="1">Normal</option>
                    <option value="2">Medium</option>
                    <option value="3">Critical</option>
                </select>
            </div>
        `,
        focusConfirm: false,
        preConfirm: () => {
            return [
                document.getElementById('inp_name').value,
                document.getElementById('inp_priority').value,
            ];
        }
    });

    if(formValues){
        ApiRequest({
            type: 'POST',
            data: JSON.stringify({
                name: formValues[0],
                priority: formValues[1],
            }),
        }).done((result) => {
            if(result.code == 400){
                mySweet({
                    title: result?.message || 'error',
                    text: result?.error
                });
            }
            else{
                loadTask();
            }
        });
    }
}

function updateTask(id){
    ApiRequest({
        type: "PUT",
        data: JSON.stringify({
            id: id,
        })
    }).then((result) => {
        if(result.code == 400){
            mySweet({
                title: result?.message || 'error',
                text: result?.error
            });
        }
        else{
            loadTask();
        }
    });
}

function deleteTask(id){
    ApiRequest({
        type: "DELETE",
        data: JSON.stringify({
            id: id,
        })
    }).then((result) => {
        if(result.code == 400){
            mySweet({
                title: result?.message || 'error',
                text: result?.error
            });
        }
        else{
            loadTask();
        }
    });
}

function ApiRequest(config, loaderId=null){
    const Loader = loaderId || '#task_loader';
    const RequestConfig = {
        type: 'GET',
        url: 'app.php',
        dataType: 'json',
        beforeSend: () => {
            $(Loader).removeClass('hidden');
        },
        headers: {
            'X-Requested-With' : 'XMLHttpRequest',
        },
        ...config
    };

    return $.ajax(RequestConfig)
        .fail((response) => {
            mySweet({
                title: response?.message || 'error',
                text: response?.error
            });
        })
        .always(() => {
            setTimeout(() => {
                $(Loader).addClass('hidden');
            }, 2000);
        });
}

function mySweet(config){
    const init = {
        title: 'title',
        text: 'message',
        showCloseButton: true,
        ...config
    };

    return Swal.fire(init);
}

function fetchList(data){
    let el = '';
    for(const items of data){
        el += '<li class="priority'+items?.priority+'">';
            el += '<div class="list-content">';
                el += '<div class="list-title">';
                    el += items?.name;
                el += '</div>';
                el += '<div class="list-action">';
                    if(items?.is_complete == 0){
                        el += '<a href="#" class="complete" onclick="updateTask('+items?.id+')">';
                            el += '<i class="fa fa-check"></i>';
                        el += '</a>';
                    }
                    el += '<a href="#" class="remove" onclick="deleteTask('+items?.id+')">';
                        el += '<i class="fa fa-trash"></i>';
                    el += '</a>';
                el += '</div>';
            el += '</div>';
        el += '</li>';
    }
    return el;
}