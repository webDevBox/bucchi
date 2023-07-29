async function createBulkClients() {
    // $('#loader_wait').removeClass('d-none')
    var myModal = document.getElementById('myModal8');
    $(myModal).modal('hide');

    const fileInput = document.getElementById('filer');
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const data = e.target.result;
        const workbook = XLSX.read(data, { type: 'binary' });

        for (const sheetName of workbook.SheetNames) {
            const XL_row_object = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName]);
            addBulkClients(XL_row_object);
        }

    };

    reader.onerror = function (ex) {
        console.error(ex);
    };

    reader.readAsBinaryString(file);
}

async function addBulkClients(clients) {
    var bulkErrors = 0

    const response = await $.ajax({
        url: baseUrl + "/getFile",
        type: "GET",
    });

    var files = response.files

    clients.map((client) => {
        if (!files.includes(client['File#'].toString())
            && client['Client Name'] !== undefined && client['Client Name'] !== null
            && client['File#'] !== undefined && client['File#'] !== null &&
            client['Client Name'] !== '' && client['File#'] !== ''
        ) {
            createBulkCalls(
                client['Client Name'],
                client['Country'],
                client['File#'],
                client['Contact'],
                client['Email']
            )
        }
        else {
            bulkErrors++
        }
    })

}

function deleteClient(id, button) {
    let text = `Are you sure you want to delete client`;
    if (confirm(text) == true) {
        var url = baseUrl + "/deleteClient";
        $.ajax({
            url: url,
            type: "GET",
            data: {
                id: id
            },
            success: async function (response) {
                if (response.success) {
                    var table = $('#clients_directory').DataTable();
                    var row = table.row($(button).closest('tr'));
                    row.remove().draw();
                }
                else {
                    setTimeout(function () {
                        toastr['error'](
                            'Please try again',
                            'Some thing wrong!',
                            {
                                closeButton: true,
                                tapToDismiss: false
                            }
                        );
                    }, 2000);
                }
            },
            error: function (xhr, status, error) {
                // Handle the error response
            }
        });
    }

}

async function createBulkCalls(name, country, file, contact, email) {
    var url = baseUrl + "/createClient";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            name: name,
            file: file,
            contact: contact,
            email: email,
            country: country,
        },
        success: async function (response) {
            if (response.success) {
                generateRow(response)
            }
            else {
                setTimeout(function () {
                    toastr['error'](
                        'Please try again',
                        'Some thing wrong!',
                        {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
            }
        },
        error: function (xhr, status, error) {
            // Handle the error response
        }
    });
    return true
}

async function createClient() {
    const name = $('#client_name').val()
    const file = $('#client_file').val()
    const contact = $('#client_contact').val()
    const email = $('#client_email').val()
    const country = $('#client_country').val()

    const result = await checkValidation(name, file);
    if (result) {
        return
    }

    var url = baseUrl + "/createClient";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            name: name,
            file: file,
            contact: contact,
            email: email,
            country: country,
        },
        success: async function (response) {
            if (response.success) {
                setTimeout(function () {
                    toastr['success'](
                        '',
                        '👋 Client Created',
                        {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
                var myModal = document.getElementById('myModal8');
                $(myModal).modal('hide');

                generateRow(response)

            }
            else {
                setTimeout(function () {
                    toastr['error'](
                        'Please try again',
                        'Some thing wrong!',
                        {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
            }
        },
        error: function (xhr, status, error) {
            // Handle the error response
        }
    });

}

function checkValidation(name, file) {
    return new Promise(function (resolve, reject) {
        $('#client_name_error').addClass('d-none');
        $('#client_file_error').addClass('d-none');
        var url = baseUrl + "/checkFileNum";

        if (name === '') {
            $('#client_name_error').removeClass('d-none');
            resolve(true);
        } else if (file === '') {
            $('#client_file_error').removeClass('d-none');
            $('#client_file_error').text('Client File Number Required');
            resolve(true);
        } else {
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    file: file
                },
                success: function (response) {
                    if (response.success) {
                        $('#client_file_error').text('Client File Number Already Taken');
                        $('#client_file_error').removeClass('d-none');
                        resolve(true);
                    } else {
                        resolve(false);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error response
                    reject(error);
                }
            });
        }
    });
}

function showClientForm(shower) {
    if (shower === 'single') {
        $('#single_form').removeClass('d-none')
        $('#singular_form_submit').removeClass('d-none')
        $('#multiple_form').addClass('d-none')
        $('#multiple_form_submit').addClass('d-none')
    }
    else {
        $('#single_form').addClass('d-none')
        $('#singular_form_submit').addClass('d-none')
        $('#multiple_form').removeClass('d-none')
        $('#multiple_form_submit').removeClass('d-none')
    }
}


function generateRow(response) {
    var table = document.getElementById("clients_directory")
    var newRow = table.insertRow(1)

    newRow.innerHTML = `
        <tr>
            <td class="text-center">${response.client.name ? response.client.name : ''}</td>
            <td class="text-center">${response.client.contact ? response.client.contact : ''}</td>
            <td class="text-center">${response.client.email ? response.client.email : ''}</td>
            <td class="text-center">${response.client.country ? response.client.country : ''}</td>
            <td class="text-center">${response.client.file_num ? response.client.file_num : ''}</td>
            <td class="text-center">
                <div class="btn-group btn-group-xs">
                    <a href="/editClient/${response.client.id}" target="_blank"
                        class="btn btn-primary">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <a href="#" onclick="deleteClient(${response.client.id},this)"
                        class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </td>
        </tr>
    `
    
}