<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap-select test page</title>

  <meta charset="utf-8">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('bootstrap-select.css')}}">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script src="{{asset('bootstrap-select.js')}}"></script>
</head>
<body>

<div class="container">
  <form class="form-inline" role="form">
    <div class="form-group">
      <label for="multipleSelect1" class="col-lg-2 control-label">multiple select1</label>

      <div class="col-lg-10">
        <select id="multipleSelect1" class="selectpicker show-menu-arrow form-control" multiple>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="multipleSelect2" class="col-lg-2 control-label">multiple select2</label>

      <div class="col-lg-10">
        <select id="multipleSelect2" class="selectpicker show-menu-arrow form-control" multiple>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
          <option>chicken</option>
          <option>turkey</option>
          <option>duck</option>
          <option>goose</option>
        </select>
      </div>
    </div>
  </form>
</div>

<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
</body>
</html>