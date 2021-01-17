<?php require 'resources/views/layouts/top.php' ?>
    <div class="row m-1 p-3">
        <div class="col col-11 mx-auto">
            <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">
                <form class="form-inline" action="/tasks" method="POST" id="addTask">
                    <div class="form-group mb-2">
                        <input type="text" required name="name" class="form-control" placeholder="Add new work">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="date" required name="start_date" value="<? echo date('Y-m-d') ?>" class="form-control"  placeholder="Start Date">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <input type="date" required name="end_date" class="form-control"  placeholder="End Date">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <select class="form-control" name="status">
                            <option>PLANNING</option>
                            <option>DOING</option>
                            <option>COMPLETE</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Add</button>
                </form>
            </div>
        </div>
    </div>
    <div class="p-2 mx-4 border-black-25 border-bottom"></div>
    <div class="row mx-1 px-5 pb-3 w-80">
        <div class="col mx-auto">
            <?php foreach ($tasks as $task) : ?>
                <div class="row px-3 align-items-center todo-item rounded">
                <div class="col-auto m-1 p-0 d-flex align-items-center">
                    <h2 class="m-0 p-0">
                    <i class="fa fa-circle text-primary fa-sm" aria-hidden="true"></i>
                    </h2>
                </div>
                <div class="col px-1 m-1 d-flex align-items-center">
                    <input type="text" class="form-control form-control-lg border-0 edit-todo-input bg-transparent rounded px-3" readonly value="<?= $task->name?>" title="<?= $task->name?>" />
                    <input type="text" class="form-control form-control-lg border-0 edit-todo-input rounded px-3 d-none" value="<?= $task->name?>" />
                </div>
                <div class="col-auto m-1 p-0 px-3">
                    <div class="row">
                        <div class="col-auto d-flex align-items-center rounded bg-white border border-warning">
                        <h6 class="text my-2 pr-2"><?= $task->status ?></h6>                            
                        </div>
                    </div>
                </div>
                <div class="col-auto m-1 p-0 px-3">
                    <div class="row">
                        <div class="col-auto d-flex align-items-center rounded bg-white border border-warning">
                            <h6 class="text my-2 pr-2">
                                <?
                                    echo date_format(date_create($task->start_date),"d-m-Y");
                                    if ($task->end_date) {
                                        echo 'to ' . date_format(date_create($task->end_date),"d-m-Y");
                                    }
                                ?>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-auto m-1 p-0 todo-actions">
                    <div class="row d-flex align-items-center justify-content-end">
                        <h5 class="m-0 p-0 px-2">
                            <i class="fa fa-pencil text-info btn m-0 p-0" 
                                data-id="<?= $task->id ?>"
                                data-name="<?= $task->name ?>"
                                data-start_date="<?= $task->start_date ?>"
                                data-end_date="<?= $task->end_date ?>"
                                data-status="<?= $task->status ?>"
                                data-toggle="tooltip" 
                                data-placement="bottom"
                                title="Edit todo"
                            ></i>
                        </h5>
                        <h5 class="m-0 p-0 px-2">
                            <i class="fa fa-trash-o text-danger btn m-0 p-0" data-id="<?= $task->id ?>" data-toggle="tooltip" data-placement="bottom" title="Delete todo"></i>
                        </h5>
                    </div>
                    <div class="row todo-created-info">
                        <div class="col-auto d-flex align-items-center pr-2">
                            <i class="fa fa-info-circle my-2 px-2 text-black-50 btn" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Created date"></i>
                            <label class="date-label my-2 text-black-50"><?= $task->created_at?></label>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>  
        </div>
    </div>
<div id="taskModal" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Working Name: </label>
                    <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="status">Status: </label>
                    <select class="form-control" name="status" id="status">
                        <option value='PLANNING'>PLANNING</option>
                        <option value='DOING'>DOING</option>
                        <option value='COMPLETE'>COMPLETE</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date:
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </label>

                </div>
                <div class="form-group">
                    <label for="end_date">End Date:
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button"  class="btn btn-primary btn-submit-task">Submit</button>
            </div>
        </div>
    </div>
</div>
<hr/>
<div class="row m-1 p-4">
        <div class="col">
            <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                <i class="fa fa-calendar bg-primary text-white rounded p-2"></i>
                <u>Calendar</u>
            </div>
        </div>
    </div>
<div id="holder" class="row" ></div>

<script type="text/tmpl" id="tmpl">
  {{
  var date = date || new Date(),
      month = date.getMonth(),
      year = date.getFullYear(),
      first = new Date(year, month, 1),
      last = new Date(year, month + 1, 0),
      startingDay = first.getDay(),
      thedate = new Date(year, month, 1 - startingDay),
      dayclass = lastmonthcss,
      today = new Date(),
      i, j;
  if (mode === 'week') {
    thedate = new Date(date);
    thedate.setDate(date.getDate() - date.getDay());
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(last.getDate()+6);
  } else if (mode === 'day') {
    thedate = new Date(date);
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(thedate.getDate() + 1);
  }

  }}
  <table class="calendar-table table table-condensed table-tight">
    <thead>
      <tr>
        <td colspan="7" style="text-align: center">
          <table style="white-space: nowrap; width: 100%">
            <tr>
              <td style="text-align: left;">
                <span class="btn-group">
                  <button class="js-cal-prev btn btn-default"><</button>
                  <button class="js-cal-next btn btn-default">></button>
                </span>
                <button class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
              </td>
              <td>
                <span class="btn-group btn-group-lg">
                  {{ if (mode !== 'day') { }}
                    {{ if (mode === 'month') { }}<button class="js-cal-option btn btn-link" data-mode="year">{{: months[month] }}</button>{{ } }}
                    {{ if (mode ==='week') { }}
                      <button class="btn btn-link disabled">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</button>
                    {{ } }}
                    <button class="js-cal-years btn btn-link">{{: year}}</button>
                  {{ } else { }}
                    <button class="btn btn-link disabled">{{: date.toDateString() }}</button>
                  {{ } }}
                </span>
              </td>
              <td style="text-align: right">
                <span class="btn-group">
                  <button class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">Year</button>
                  <button class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">Month</button>
                  <button class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">Week</button>
                  <button class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day">Day</button>
                </span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </thead>
    {{ if (mode ==='year') {
      month = 0;
    }}
    <tbody>
      {{ for (j = 0; j < 3; j++) { }}
      <tr>
        {{ for (i = 0; i < 4; i++) { }}
        <td class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
          {{: months[month] }}
          {{ month++;}}
        </td>
        {{ } }}
      </tr>
      {{ } }}
    </tbody>
    {{ } }}
    {{ if (mode ==='month' || mode ==='week') { }}
    <thead>
      <tr class="c-weeks">
        {{ for (i = 0; i < 7; i++) { }}
          <th class="c-name">
            {{: days[i] }}
          </th>
        {{ } }}
      </tr>
    </thead>
    <tbody>
      {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
      <tr>
        {{ for (i = 0; i < 7; i++) { }}
        {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
        <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}">
          <div class="date">{{: thedate.getDate() }}</div>
          {{ thedate.setDate(thedate.getDate() + 1);}}
        </td>
        {{ } }}
      </tr>
      {{ } }}
    </tbody>
    {{ } }}
    {{ if (mode ==='day') { }}
    <tbody>
      <tr>
        <td colspan="7">
          <table class="table table-striped table-condensed table-tight-vert" >
            <thead>
              <tr>
                <th> </th>
                <th style="text-align: center; width: 100%">{{: days[date.getDay()] }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="timetitle" >All Day</th>
                <td class="{{: date.toDateCssClass() }}">  </td>
              </tr>
              <tr>
                <th class="timetitle" >Before 6 AM</th>
                <td class="time-0-0"> </td>
              </tr>
              {{for (i = 6; i < 22; i++) { }}
              <tr>
                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</th>
                <td class="time-{{: i}}-0"> </td>
              </tr>
              <tr>
                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }}:30 {{: i < 12 ? "AM" : "PM"}}</th>
                <td class="time-{{: i}}-30"> </td>
              </tr>
              {{ } }}
              <tr>
                <th class="timetitle" >After 10 PM</th>
                <td class="time-22-0"> </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
    {{ } }}
  </table>
</script>
<?php require 'resources/views/layouts/bottom.php' ?>
