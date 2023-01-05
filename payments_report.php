<?php
    include 'db_connect.php';
    $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="card">
            <div class="card_body">
            <div class="row justify-content-center pt-4">

                <label for="" class="mt-2">Date</label>
                <div class="col-sm-3">
                    <input type="date" name="date" id="date" value="<?php echo $date?>" class="form-control">
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <table class="table table-bordered" id='report-list'>
                    <thead>
                        <tr>
                            <th class="text-center" rowspan="2">#</th>
                            <th class="" rowspan="2">DATE</th>
                            <th class="" rowspan="2">NAME</th>
                            <th class="" rowspan="2">OR NO.</th>
                            <th class="" rowspan="2">AMOUNT PAID</th>
                            <th class="" rowspan="2">PAYMENT TYPE</th>
                            <th class="" rowspan="2">REMARKS</th>
                        </tr>
                    </thead>
                    <tbody>
			          <?php
                      $i = 1;
                      $total = 0;
                      $payments = $conn->query("SELECT p.*,s.name as sname, ef.ef_no,s.id_no FROM payments p inner join student_ef_list ef on ef.id = p.ef_id inner join student s on s.id = ef.student_id where date_format(p.date_created,'%Y-%m-%d') = '$date' order by unix_timestamp(p.date_created) asc");
                      if($payments->num_rows > 0):
			          while($row = $payments->fetch_array()):
                        $total += $row['amount'];
 
                      ?>
			          <tr>
                        <td class="text-center"><?php echo $i++ ?></td>
                        <td>
                            <p><?php echo date("M. d, Y H:i A",strtotime($row['date_created'])) ?></p>
                        </td>
                        <td>
                            <p><?php echo ucwords($row['sname']) ?></p>
                        </td>
                        <td>
                            <p><?php echo $row['or_num'] ?></p>
                        </td>    
                        <td class="text-right">
                            <p>&#8369;<?php echo number_format($row['amount'],2) ?></p>
                        </td>
                        <td class="text-center">
                            <p><?php echo $row['feetype'] ?></p>
                        </td> 
                        <td class="text-right">
                            <p><?php echo $row['remarks'] ?></p>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                        else:
                    ?>
                    <tr>
                            <th class="text-center" colspan="7">No Data.</th>
                    </tr>
                    <?php 
                        endif;
                    ?>
			        </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total:</th>
                            <th class="text-right">&#8369;<?php echo number_format($total,2) ?></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
                <hr>
                <div class="col-md-12 mb-4">
                    <center>
                        <button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                    </center>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<noscript>
	<style>
		table#report-list{
			width:100%;
			border-collapse:collapse
		}
		table#report-list td,table#report-list th{
			border:1px solid
		}
        p{
            margin:unset;
        }
		.text-center{
			text-align:center
		}
        .text-right{
            text-align:right
        }
	</style>
</noscript>
<script>
$('#date').change(function(){
    location.replace('index.php?page=payments_report&date='+$(this).val())
})
$('#print').click(function(){
		var _c = $('#report-list').clone();
		var ns = $('noscript').clone();
            ns.append(_c)
		var nw = window.open('','_blank','width=900,height=600')
		nw.document.write('<p class="text-center"><b>Daily Cash Collection Report as of <?php echo date("F d, Y",strtotime($date)) ?></b></p>')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})
</script>