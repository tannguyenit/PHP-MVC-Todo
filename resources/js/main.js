$(document).ready(function () {
  $('.fa-trash-o').on('click', function () {
    const result = confirm('Do you want delete this task ?');
    if (result) {
      const taskId = $(this).data('id');

      $.ajax({
        url: `/tasks/${taskId}`,
        type: 'DELETE',
        success: result => {
          if (result.status) {
            location.reload();
          }
        }
    });
    }
  })


  $('#addTask').submit(function (e) {
    e.preventDefault();
    const data = $(this).serializeArray().reduce((obj, value) => ({...obj, [value.name]: value.value }), {} )

    const request = $.ajax({
      url: `/tasks`,
      type: 'POST',
      data,
      dataType: 'JSON'
  });

  request.done(() => location.reload(true));

  request.fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
  });

  })

  $('.fa-pencil').on('click', function () {
    const id = $(this).data('id');
    const name = $(this).data('name')
    const startDate = $(this).data('start_date')
    const endDate = $(this).data('end_date')
    const status = $(this).data('status')

    $('#taskModal').find('.modal-title').text('Edit task ' + name);
    $('#taskModal').find("#id").val(id);
    $('#taskModal').find("#name").val(name);
    $('#taskModal').find("#status").val(status);
    $('#taskModal').find("#start_date").val(startDate);
    $('#taskModal').find("#end_date").val(endDate);

    openModal()
  })

  $(".btn-submit-task").on('click', function () {
    updateTask();
  });
});

function openModal() {
  $('#taskModal').modal('show');
}

function updateTask() {
    const id = $('#taskModal').find('#id').val();
    const name = $('#taskModal').find('#name').val();
    const status = $('#taskModal').find('#status').val();
    const start_date = $('#taskModal').find('#start_date').val();
    const end_date = $('#taskModal').find('#end_date').val();
    const request = $.ajax({
        url: `/tasks/${id}`,
        type: 'POST',
        data: { name : name, status: status, start_date: start_date, end_date: end_date },
        dataType: 'JSON'
    });

    request.done(() => location.reload(true));

    request.fail(function( jqXHR, textStatus ) {
        alert( "Request failed: " + textStatus );
        $('#taskModal').modal('hide');
    });
}