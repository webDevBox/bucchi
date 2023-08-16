document.addEventListener("DOMContentLoaded", showAssignColumn);
function showAssignColumn()
{
        for (let index = 1; index <= 12; index++) {
            var columnValues = 0
            $(`.order_week_${index}`).each(function(){
                columnValues += Number($(this).val())
            })
            $(`#assign_week_${index}`).text(columnValues)
        }
}
function createSchedule(event,id,remaining)
{
    event.preventDefault()
    const scheduling = []
    var total = 0
    for (let index = 1; index <= 12; index++) {
        var value = $(`#week_${index}_${id}`).val()
        if(value != null && value != '' && value >= 0)
        {
            total += Number(value)
            scheduling.push({
                week: index,
                hours: value
            },)
        }
    }

    const validate = checkValidation(total,remaining)
    if(validate)
    {
        return
    }

    var url = baseUrl + "/admin/scheduling/create";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            order: id,
            scheduling: scheduling

        },
        success: async function (response) {
            if (response.success) {
                $(`#assign_${id}`).text(total)
                setTimeout(function () {
                    toastr['success'](
                        '',
                        '👋 Schedule Created',
                        {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
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

function checkValidation(total,remaining)
{
    if(total > remaining)
    {
        setTimeout(function () {
            toastr['error'](
                'Please try again with correct data',
                `Remaing Hours Are Less Then Assigning Hours`,
                {
                    closeButton: true,
                    tapToDismiss: false
                }
            );
        }, 2000);
        
        return true
    }

    if(total == 0)
    {
        setTimeout(function () {
            toastr['error'](
                'Please try again with correct data',
                `Assigning Hours Should Have Value In Any Week`,
                {
                    closeButton: true,
                    tapToDismiss: false
                }
            );
        }, 2000);

        return true
    }

    return false
}

function createAvailableHour(event)
{
    event.preventDefault()
    const availability = []
    var total = 0
    for (let index = 1; index <= 12; index++) {
        var value = $(`#available_week_${index}`).val()
        if(value != null && value != '' && value >= 0)
        {
            total += Number(value)
            availability.push({
                week: index,
                hours: value
            },)
        }
    }

    var url = baseUrl + "/admin/scheduling/availability";
    $.ajax({
        url: url,
        type: "GET",
        data: {
            availability: availability

        },
        success: async function (response) {
            if (response.success) {
                $(`#availability_total`).text(total)
                setTimeout(function () {
                    toastr['success'](
                        '',
                        '👋 Availability Schedule Created',
                        {
                            closeButton: true,
                            tapToDismiss: false
                        }
                    );
                }, 2000);
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

function checkAvailability(column,order)
{
    $(`#week_${column}_${order}`).css('color', 'black');
    var columnValues = 0
    var otherColumns = 0
    $(`.order_week_${column}`).each(function(){
        columnValues += Number($(this).val())
        if($(this).attr('id') != `week_${column}_${order}`)
        {
            otherColumns += Number($(this).val())
        }
    })
    
    const availability = $(`#available_week_${column}`).val()

    if(columnValues > availability)
    {
        var newValue = parseInt(availability) - parseInt(otherColumns)
        $(`#week_${column}_${order}`).css('color', 'red')
        $(`#week_${column}_${order}`).val(newValue)
    }
}

$('#printer').click(function(){
    var doc = new jsPDF();
        doc.fromHTML(document.getElementById('scheduling_table').innerHTML, 10, 10);
        doc.save('scheduling_table.pdf');
})