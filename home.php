<?php include 'db_connect.php' ?>

<style>
   span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}
.imgs{
		margin: .5em;
		max-width: calc(100%);
		max-height: calc(100%);
	}
	.imgs img{
		max-width: calc(100%);
		max-height: calc(100%);
		cursor: pointer;
	}
	#imagesCarousel,#imagesCarousel .carousel-inner,#imagesCarousel .carousel-item{
		height: 60vh !important;background: black;
	}
	#imagesCarousel .carousel-item.active{
		display: flex !important;
	}
	#imagesCarousel .carousel-item-next{
		display: flex !important;
	}
	#imagesCarousel .carousel-item img{
		margin: auto;
	}
	#imagesCarousel img{
		width: auto!important;
		height: auto!important;
		max-height: calc(100%)!important;
		max-width: calc(100%)!important;
	}
.row{
    margin: auto;
    width: 100%;
    display: justify;
    content: center;
}
.fa-users,
.fa-5x {
  color: white;
}
h4{
    color: white;
}
</style>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="css/custom.css" rel="stylesheet" />

</head>
<div class="container-fluid">
	<div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <center><h1><?php echo "Welcome back ". $_SESSION['login_name']."!"  ?></h1> </center>
                    <div class="cardContainer">
                    <center><h2><p><?php echo date('F') .' '.date('d').', '.date('Y'). ' ('.date('l)'); ?></p></h2> </center>
                </div>
		  
                    <div class="row justify-content-center">
                        <div class="card col-md-3 offset-md-1 alert alert-primary">
                        <div class="main-box mb-2 bg-primary">
                        <div class="card-body text-center">
                        <h4>Total Students</h4>
                        <i class="fa fa-users fa-5x"></i>
                        <a href="index.php?page=fees">
                        <h3><?php echo $conn->query("SELECT * FROM student")->num_rows; ?></h3>
                        </div>
                        </div>
                        </div>
                        
                        <div class="card col-md-3 offset-md-1 alert alert-primary">
                        <div class="main-box mb-2 bg-danger">
                        <div class="card-body text-center">
                        <h4>Total Programs</h4>
                        <i class="fa fa-th fa-5x"></i>
                        <a href="index.php?page=courses">
                        <h3><?php echo $conn->query("SELECT * FROM courses")->num_rows; ?></h3>
                        
                        </div>
                        </div>
                        </div>

                        <div class="card col-md-3 offset-md-1 alert alert-primary">
                        <div class="main-box mb-2 bg-success">
		                <div class="card-body text-center">
                        <h4>&nbsp;</h4>
                        <h4>Payments</h4>
                        <i class="fa fa-money-check fa-5x"></i>
                        <a href="index.php?page=payments">
                        <h4>&nbsp;</h4>
                        
                        
                        </div>
                        </div>
                        </div>
                    </div>
            </div> 
        </div>                    
    </div>               
</div>


<script>
	$('#manage-records').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_track',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                resp=JSON.parse(resp)
                if(resp.status==1){
                    alert_toast("Data successfully saved",'success')
                    setTimeout(function(){
                        location.reload()
                    },800)

                }
                
            }
        })
    })
    $('#tracking_id').on('keypress',function(e){
        if(e.which == 13){
            get_person()
        }
    })
    $('#check').on('click',function(e){
            get_person()
    })
    function get_person(){
            start_load()
        $.ajax({
                url:'ajax.php?action=get_pdetails',
                method:"POST",
                data:{tracking_id : $('#tracking_id').val()},
                success:function(resp){
                    if(resp){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()

                        }else if(resp.status == 2){
                            alert_toast("Unknow tracking id.",'danger');
                            end_load();
                        }
                    }
                }
            })
    }
</script>