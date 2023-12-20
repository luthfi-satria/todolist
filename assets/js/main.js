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