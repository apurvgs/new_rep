<?php

global $n_rows;
global $m_columns;

class timeTable{

public $n;
public $m;

public $subject=array(array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),);
public $teacher=array(array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"),array("empty","empty","empty","empty","empty","empty"));

public function prt_pdf()
{
	require('fpdf\fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

$pdf->Cell(50,20,"TIMETABLE",0,1);

$pdf->Cell(10,10,"",1,0);



for($j=1;$j<=$this->m;$j++)
{
	$pdf->Cell(20,10,"SUBJECT $j",1,0);	
	$pdf->Cell(20,10,"TEACHER $j",1,0);
	if($j==$this->m)
$pdf->Cell(2,10," ",1,1);
else
$pdf->Cell(2,10," ",1,0);
}
for($i=1;$i<=$this->n;$i++){

$pdf->Cell(10,10,"DAY $i",1,0);

for($j=1;$j<=$this->m;$j++)
{
//$pdf->Cell(20,10,"Name:",1,0);

$pdf->Cell(20,10,$this->subject[$i][$j],1,0);

$pdf->Cell(20,10,$this->subject[$i][$j],1,0);
if($j==$this->m)
$pdf->Cell(2,10," ",1,1);
else
$pdf->Cell(2,10," ",1,0);
}

}
$pdf->Output();	
}


public function checksub()
{
for($i=1;$i<=$this->n;$i++)
	{
		
		for($j=1;$j<=$this->m;$j++)
		{
			$ctr=0;
			for($k=1;$k<=$this->m;$k++)
			{
				if($this->subject[$i][$j]==$this->subject[$i][$k])
					$ctr++;
			}
			if($ctr>2)
				return 1;
		}
	}

	return 0;
}
public function checkteacher()
{
for($i=1;$i<=$this->n;$i++)
	{
		
		for($j=1;$j<=$this->m;$j++)
		{
			$ctr=0;
			for($k=1;$k<=$this->m;$k++)
			{
				if($this->teacher[$i][$j]==$this->teacher[$i][$k])
					$ctr++;
			}
			if($ctr>2)
				return 1;
		}
	}

	return 0;
}
public function checkf()
{
for($i=1;$i<=$this->n;$i++)
	{
		
		for($j=1;$j<=$this->m;$j++)
		{
			$ctr=0;
			for($k=1;$k<=$this->n;$k++)
			{
				for($l=1;$l<=$this->m;$l++)
				if($this->teacher[$i][$j]==$this->teacher[$k][$l])
					$ctr++;
			}
			if($ctr>4&&$ctr<=3)
				return 1;
		}
	}

	return 0;
}

}

$tObject=new timeTable();
if(isset($_POST["no_work"]))
{
$tObject->n=$_POST["no_work"];
$tObject->m=$_POST["no_class"];
$n_rows=$_POST["no_work"];
$m_columns=$_POST["no_class"];

$ll=0;


}
$p=0;
$k=0;
for($i=1;$i<=$n_rows;$i++)
{
	for($j=1;$j<=$m_columns;$j++)
	{
		$k++;
		if(isset($_POST["subject_$k"]))
		{	$p=1;
			$tObject->subject[$i][$j]=$_POST["subject_$k"];
			$tObject->teacher[$i][$j]=$_POST["teacher_$k"];
		}	
	}
}
if($p)
{
	
	if($tObject->checksub()=="1")
		echo "error there are two classes for a subject in a day";
	else
	if($tObject->checkteacher()=="1")
		echo "error a single teacher should teach maximum of two classes a day";
	else
	if($tObject->checkf()=="1")
	echo "there should be maximum 4 and minimum 3 classes for a subject in a week";
	else
	$tObject->prt_pdf();
}



?>

<html>
<head>
  <title>Time Table Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div>
<form action="formmodule.php" method="POST">
<table class="table table-bordered">
Number of working days:<input type="text" name="no_work" value="<?php echo $n_rows;?>">    Number of classes:<input type="text" name="no_class" value="<?php echo $m_columns;?>"><hr><br><br><br>
<tbody>
<?php
$k=0;
$r=0;

echo "<tr>";
	for($j=1;$j<=$m_columns;$j++)
	{
		echo "<th>CLASS $j</th>";
	}
	echo "</tr>";

for($i=1;$i<=$n_rows;$i++)
{
	echo "<tr>";
	for($j=1;$j<=$m_columns;$j++)
	{
		$k++;$r++;
		echo "<th><input type='text' name='subject_$k'   >";
		echo "<input type='text' name='teacher_$r'> </th>";
	}
	echo "</tr>";
	
}

?>
<tbody>

</table>
<pre>        <input type="Submit"> </pre>
</form>

</div>
</body>

</html>

