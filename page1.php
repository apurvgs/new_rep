<!DOCTYPE html>
<html lang="en">
<head>
  <title>Time Table generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br>
<br>
<br>
<br>
<div class="form-control">
<div class="container">
  <h2>Enter the details below to continue</h2>
  <form action="formmodule.php" method="POST">
    <div class="form-group">
      <label for="no_work">Working Days:</label>
      <input type="number" class="form-control" id="no_work" placeholder="Number of working days/week" name="no_work">
    </div>
    <div class="form-group">
      <label for="no_class">Number of classes:</label>
      <input type="number" class="form-control" id="no_class" placeholder="Number of classes/day" name="no_class">
 

    </div>
    <div class="form-group">
      <label for="dur_class">Class Duration:</label>
      <input type="number" class="form-control" id="dur_class" placeholder="Class Duration" name="dur_class">
 

    </div>
	
    <input type="submit">
  </form>
</div>
</div>
</body>
</html>