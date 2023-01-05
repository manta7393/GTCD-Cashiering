<?php
include 'db_connect.php';
$etype = $_POST['etype'];
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM student where id = {$_GET['id']} ");
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
}
?>
		<?php if($etype == 1 || $etype == 3) : ?>
<div class="container-fluid">
	<form id="manage-fees">
		<div id="msg"></div>
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		 <div class="form-group">
            <label for="" class="control-label">Transaction No.</label>
            <input type="text" class="form-control" name="ef_no"  value="<?php echo isset($ef_no) ? $ef_no :'' ?>" required>
        </div>
		<div class="form-group">
			<label for="" class="control-label">Student</label>
			<select name="student_id" id="student_id" class="custom-select input-sm select2">
				<option value=""></option>
				<?php
					$student = $conn->query("SELECT * FROM student order by name asc ");
					while($row= $student->fetch_assoc()):
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($student_id) && $student_id == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['name']).' | '. $row['id_no'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Course</label>
			<select name="course_id" id="course_id" class="custom-select input-sm select2">
				<option value=""></option>
				<?php
					$student = $conn->query("SELECT *,concat(course,'-',level,' ',acadyear,' ',semester) as class FROM courses order by course asc ");
					while($row= $student->fetch_assoc()):
				?>
				<option value="<?php echo $row['id'] ?>" data-amount = "<?php echo $row['total_amount'] ?>" <?php echo isset($course_id) && $course_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['class'] ?></option>
				<?php endwhile; ?>
			</select>
		</div>
		 <div class="form-group">
            <label for="" class="control-label">Fee</label>
            <input type="text" class="form-control text-right" name="total_fee"  value="&#8369;<?php echo isset($total_fee) ? number_format($total_fee) :'' ?>" required readonly>
        </div>
	</form>
</div>
		

		

		<?php endif; ?>
		

		
			<?php if($etype == 2 || $etype == 4) : ?>
<div class="container-fluid">
    <form action="" id="manage-course">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
        <div class="col-lg-6 border-right">
            <h5><b><center>Program Details</center></b></h5>
            <hr>
            <div id="msg" class="form-group"></div>
            <div class="form-group">
            Program/Strand: <select name="course">
							 <option value="default">Select One</option>
                             <option value="BEED">BEED</option>
							 <option value="BSED(English)">BSED(English)</option>
                             <option value="BSED(Math)">BSED(Math)</option>
                             <option value="BSED(Soc.Stud)">BSED(Soc.Stud)</option>
							 <option value="BSHM">BSHM</option>
                             <option value="BSIT">BSIT</option>
							 <option value="TESDA">TESDA</option>
                             <option value="JHS">JHS</option>
                             <option value="SHS(HUMMSS)">SHS(HUMMSS)</option>
                             <option value="SHS(GAS)">SHS(GAS)</option>
                             <option value="SHS(TVL)">SHS(TVL)</option>
						</select>
            </div>
            <div class="form-group">    
                Year/Grade Level: <select name="level">
							<option value="default">Select One</option>
							<option value="1st Year">1st Year</option>
							 <option value="2nd Year">2nd Year</option>
							 <option value="3rd Year">3rd Year</option>
							 <option value="4th Year">4th Year</option>
                             <option value="Grade 7">Grade 7</option>
                             <option value="Grade 8">Grade 8</option>
                             <option value="Grade 9">Grade 9</option>
                             <option value="Grade 10">Grade 10</option>
                             <option value="Grade 11">Grade 11</option>
                             <option value="Grade 12">Grade 12</option>
						</select>
            </div>
            <div class="form-group">
                School Year: <select name="acadyear">
                <option value="default">Select One</option>
							<option value="S.Y. 2022-2023">S.Y. 2022-2023</option>
							 <option value="S.Y. 2023-2024">S.Y. 2023-2024</option>
                             <option value="S.Y. 2024-2025">S.Y. 2024-2025</option>
                             <option value="S.Y. 2025-2026">S.Y. 2025-2026</option>
                             <option value="S.Y. 2026-2027">S.Y. 2026-2027</option>
                             <option value="S.Y. 2026-2027">S.Y. 2026-2027</option>
                             <option value="S.Y. 2027-2028">S.Y. 2027-2028</option>
                             <option value="S.Y. 2028-2029">S.Y. 2028-2029</option>
                             <option value="S.Y. 2029-2030">S.Y. 2029-2030</option>
                             <option value="S.Y. 2030-2031">S.Y. 2030-2031</option>
                             <option value="S.Y. 2031-2032">S.Y. 2031-2032</option>
						</select>
        </div>
            <div class="form-group">
                Semester/Grading: <select name="semester">
							<option value="default">Select One</option>
							<option value="1st Sem">1st Semester</option>
							<option value="2nd Sem">2nd Semester</option>
                            <option value="Summer">Summer</option>
                            <option value="1st Grading">1st Grading</option>
                            <option value="2nd Grading">2nd Grading</option>
                            <option value="3rd Grading">3rd Grading</option>
                            <option value="4th Grading">4th Grading</option>
                            
						</select>
					</div>
                    <div class="form-group">
                <label for="" class="control-label">Units:</label>
                <input name="units" id="" cols="30" rows="4" class="form-control" required=""><?php echo isset($units) ? $units :'' ?></textarea>
            </div>
                    
            <div class="form-group">
                <label for="" class="control-label">Description</label>
                <input name="description" id="" cols="30" rows="4" class="form-control" required=""><?php echo isset($description) ? $description :'' ?></textarea>
            </div>
        </div>
        <div class="col-lg-6">
            <h5><b><center>Fee Details</center></b></h5>
            <hr>
            <div class="row">
                <div class="form-group">
                    <label for="ft" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fee Type&nbsp;</label>
                    <input type="text" id="ft" class="form-control-sm">
                </div>
                <div class="form-group">
                    <label for="" class="control-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount&nbsp;</label>
                    <input type="number" step="any" min="0" id="amount" class="form-control-sm text-right">
                </div>
                
                 <div class="form-group pt-1">
                    <label for="" class="control-label">&nbsp;</label>
                    <button class="btn btn-primary btn-sm" type="button" id="add_fee">Add to List</button>
                </div>
            </div>
            <hr>
            <table class="table table-condensed" id="fee-list">
                <thead>
                    <tr>
                        <th width="5%"></th>
                        <th width="50%">Type</th>
                        <th width="45%">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($id)):
                        $fees = $conn->query("SELECT * FROM fees where course_id = $id");
                        $total = 0;
                        while($row=$fees->fetch_assoc()): 
                            $total += $row['amount'];
                    ?>
                        <tr>
                            <td class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
                            <td>
                                <input type="hidden" name="fid[]" value="<?php echo $row['id'] ?>">
                                <input type="hidden" name="type[]" value="<?php echo $row['description'] ?>">
                                <p><small><b class="ftype"><?php echo $row['description'] ?></b></small></p>
                            </td>
                            <td>
                                <input type="hidden" name="amount[]" value="<?php echo $row['amount'] ?>">
                                <p class="text-right"><small><b class="famount">&#8369;<?php echo number_format($row['amount']) ?></b></small></p>
                            </td>
                        </tr>
                    <?php
                        endwhile; 
                        endif; 
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" class="text-center">Total</th>
                        <th class="text-right">
                            <input type="hidden" name="total_amount" value="<?php echo isset($total) ? $total : 0 ?>">
                            <span class="tamount">&#8369;<?php echo isset($total) ? number_format($total,2) : '0.00' ?></span>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
        </div>
    </form>
</div>
<div id="fee_clone" style="display: none">
     <table >
            <tr>
                <td class="text-center"><button class="btn-sm btn-outline-danger" type="button" onclick="rem_list($(this))" ><i class="fa fa-times"></i></button></td>
                <td>
                    <input type="hidden" name="fid[]">
                    <input type="hidden" name="type[]">
                    <p><small><b class="ftype"></b></small></p>
                </td>
                <td>
                    <input type="hidden" name="amount[]">
                    <p class="text-right"><small><b class="famount"></b></small></p>
                </td>
            </tr>
    </table>
</div>
		
<script>
	$('.select2').select2({
		placeholder:"Please Select Here",
		width : "100%"
	})

	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	})
</script>
