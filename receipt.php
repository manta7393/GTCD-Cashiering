<?php 
include 'db_connect.php';
$fees = $conn->query("SELECT ef.*,s.name as sname,s.id_no,acadyear,semester,units,concat(c.course,' - ',c.level) as `class` FROM student_ef_list ef inner join student s on s.id = ef.student_id inner join courses c on c.id = ef.course_id  where ef.id = {$_GET['ef_id']}");
foreach($fees->fetch_array() as $k => $v){
	$$k= $v;
}
$payments = $conn->query("SELECT * FROM payments where ef_id = $id ");
$pay_arr = array();
while($row=$payments->fetch_array()){
	$pay_arr[$row['id']] = $row;
}
?>

<style>
	.flex{
		display: inline-flex;
		width: 100%;
	}
	.w-50{
		width: 50%;
	}
	.text-center{
		text-align:center;
	}
	.text-right{
		text-align: right;
	}
	table.wborder{
		width: 100%;
		border-collapse: collapse;
		text-align: center;
	}
	table.wborder>tbody>tr, table.wborder>tbody>tr>td{
		border: none;
	}
	p{
		margin:unset;
	}
	.topright {
  	position: absolute;
  	top: 16px;
  	right: 16px;
	width: 20%;
  	font-size: 14px;
	}

</style>
<div class="container-fluid">
	<p class="text-center"><b><?php echo $_GET['pid'] == 0 ? "GTCD-QR-REG-FRM-09" : 'GTCD-QR-REG-FRM-09' ?></b></p>
	<hr>
	<div class="flex">
		<div class="w-50">
			<p>Student: <b><?php echo ucwords($sname) ?></b></p>
			<p>Program/Level: <b><?php echo $class ?></b></p>
			<p>School Year: <b><?php echo ($acadyear) ?></b></p>
			<p>Semester: <b><?php echo ($semester) ?></b></p>
			<p>Units: <b><?php echo ($units) ?></b></p>
			<br>
		</div>
		<br>
	</div>
	<table class="topright">
						<td width="50%">Fee Type</td>
						<td width="50%" class='text-right'>Amount</td>
					</tr>
					<?php 
				$cfees = $conn->query("SELECT * FROM fees where course_id = $course_id");
				$ftotal = 0;
				while ($row = $cfees->fetch_assoc()) {
					$ftotal += $row['amount'];
				?>
				<tr>
					<td><?php echo $row['description'] ?></td>
					<td class='text-right'><?php echo number_format($row['amount']) ?></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<th>Total</th>
					<th class='text-right'><b><?php echo number_format($ftotal) ?></b></th>
				</tr>
				</table>
			</td>
				
			<td width="50%">
				<table width="50%" class="wborder">
					
					<tr>
						<td width="15%">Date</td>
						<td width="15%" class='text-center'>Amount</td>
						<td width="15%" class='text-center'>OR#</td>
						<td width="15%" class='text-center'>Remarks</td>
						<td width="15%" class='text-center'>Balance</td>
					</tr>
					<?php 
						$ptotal = 0;
						foreach ($pay_arr as $row) {
							if($row["id"] <= $_GET['pid'] || $_GET['pid'] == 0){
							$ptotal += $row['amount'];
					?>
					<tr>
						<td><b><?php echo date("Y-m-d",strtotime($row['date_created'])) ?></b></td>
						<td class='text-center'><b><?php echo number_format($row['amount']) ?></b></td>
						<td class='text-center'><p><b><?php echo $row['or_num'] ?></b></p></td>
						<td><p><b><?php echo $row['remarks'] ?></b></p></td>
						<td class='text-center'><b><?php echo number_format($ftotal-$ptotal) ?></b></td>
					</tr>
					</tr>
					<?php
						}
						}
					?>
				</table>

			</td>			
		</tr>
	</table>
</div>