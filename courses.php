<?php include('db_connect.php');?>

<style>
  select.form-control{
    display: inline;
    width: 190px;
    margin-left: 25px;
  }
</style>

<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.3); /* IE */
  -moz-transform: scale(1.3); /* FF */
  -webkit-transform: scale(1.3); /* Safari and Chrome */
  -o-transform: scale(1.3); /* Opera */
  transform: scale(1.3);
  padding: 10px;
  cursor:pointer;
}
</style>
<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row mb-4 mt-4">
			<div class="col-md-12">
				
			</div>
		</div>
		<div class="row">
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-12">

				<div class="card">
					<div class="card-header">
						<b>List of Programs and Fees</b>
						<span class="float:right"><a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_course">
					<i class="fa fa-plus"></i> New Entry
				</a></span>

					</div>

		<select id="categoryFilter" class="form-control">
        <option value="">All Programs</option>
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

					<div class="card-body">
						<table class="table" id='filterTable'>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Program/Level</th>
									<th class="text-center">School Year</th>
									<th class="text-center">Semester/Grading</th>
									<th class="text-center">Units</th>
									<th class="text-center">Total Fee</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$course = $conn->query("SELECT * FROM courses  order by course asc ");
								while($row=$course->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td>
										<p> <b><?php echo $row['course'] . " - " . $row['level'] ?></b></p>
									</td>
									<td class="text-center">
										 <p><small><i><b><?php echo $row['acadyear'] ?></i></small></p>
									</td>
									<td class="text-center">
										 <p><small><i><b><?php echo $row['semester'] ?></i></small></p>
									</td>
									<td class="text-center">
										 <p><small><i><b><?php echo $row['units'] ?></i></small></p>
									</td>
									<td class="text-right">
										<p> <b>&#8369;<?php echo number_format($row['total_amount'],2) ?></b></p>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-outline-primary edit_course" type="button" data-id="<?php echo $row['id'] ?>" ><i class="fa fa-edit"></i></button>
										<button class="btn btn-sm btn-outline-danger delete_course" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>

 
<script>
    $("document").ready(function () {
      $("#filterTable").dataTable({
        "searching": true
      });
     
      var table = $('#filterTable').DataTable();
     
      $("#filterTable_filter.dataTables_filter").append($("#categoryFilter"));
      
      
      var categoryIndex = 0;
      $("#filterTable th").each(function (i) {
        if ($($(this)).html() == "Program/Course") {
          categoryIndex = i; return false;
        }
      });
    
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          var selectedItem = $('#categoryFilter').val()
          var category = data[categoryIndex];
          if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
          }
          return false;
        }
      );
  
      $("#categoryFilter").change(function (e) {
        table.draw();
      });
      table.draw();
    });
  </script>

<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_course').click(function(){
		uni_modal("New Program and Fees Entry","manage_course.php",'large')
		
	})

	$('.edit_course').click(function(){
		uni_modal("Manage Program and Fees Entry","manage_course.php?id="+$(this).attr('data-id'),'large')
		
	})
	$('.delete_course').click(function(){
		_conf("Are you sure to delete this program?","delete_course",[$(this).attr('data-id')])
	})
	
	function delete_course($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_course',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>