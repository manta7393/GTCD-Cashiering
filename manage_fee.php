<?php include 'db_connect.php' ?>
<?php
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM student_ef_list where id = {$_GET['id']} ");
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-modal col-md-12">
			<form action="" id="manage-student">
				<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
				<input type="hidden" name="school_year" value="<?php echo $sy ?>">
				<div class="form-group col-md-4">
					<label for="type" class="control-label">Student Type</label>
					<select name="type" id="type" class="custom-select browser-default">
						<option value="" disabled="" selected="">Select here</option>
						<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected' : '' ?>>Regular Student</option>
						<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected' : '' ?>>Irregular Student</option>
					
					</select>
				</div>
			<div id="data-field" class="row"></div>
			</form>
		</div>
	</div>
		
</div>
<script>

	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	})
	if('<?php echo isset($_GET['id']) ?>' == 1){
		$.ajax({
			url:'enroll_form_include.php',
			method:"POST",
			data:{etype : $('#type').val(),sy:'<?php echo $sy ?>',id:'<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>'},
			success:function(resp){
				if(resp){
					$('#data-field').html(resp)
				}
					end_load();

			}
		})
	}
	$('#type').change(function(){
		start_load();
		$.ajax({
			url:'enroll_form_include.php',
			method:"POST",
			data:{etype : $(this).val(),sy:'<?php echo $sy ?>'},
			success:function(resp){
				if(resp){
					$('#data-field').html(resp)
					end_load();
				}
			}
		})
	})
	$('#manage-student').submit(function(e){
		e.preventDefault();

		start_load()
		$.ajax({
			url:'ajax.php?action=save_student',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			},
			success:function(resp){
				if(resp == 1){
					$('.modal').modal('hide')
					end_load()
					alert_toast('Data successfully saved','success');
					load_tbl()

				}else{
					end_load()
					alert_toast('An error occured','danger');

				}
			}
		})

	})
</script>