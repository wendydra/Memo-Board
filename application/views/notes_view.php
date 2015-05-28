<!-- CSS for this project was placed inline for the purpose of demoing on one large screen. -->
<html>
	<head>
		<title>NOTES WITH AJAX</title>
		<!-- Bootstrap begins --> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="stylesheet" href="assets/css/bootstrap-theme.css">
		<!-- Bootstrap ends -->
		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	    <script type="text/javascript">
	    $(document).on('submit', 'form.create', function(){
	    	$.post(
	    			$(this).attr('action'), //1st param: same as harcoding note/create
	    			$(this).serialize(), //2nd param: taking key and values into a string 
	    			function(return_data){
	    				console.log(return_data);
	    				$('#main_loop').append("<div class='chunk'>"+
							"<form class='top' action='edit_title' method='post' id='new_title'>"+
									"<input type='hidden' name='id' value='"+return_data.row.id+"'>"+
									"<h4 id='h4_n'>"+return_data.row.title+"</h4>"+
							"</form>"+
							"<form class='delete' action='delete' method='post' id='destroy'>"+
									"<button class='b_delete'>Delete</button>"+
									"<input type='hidden' name='id' value='"+return_data.row.id+"'>"+
							"</form>"+
							"<form name='descriptor' action='append' method='post' id='insert_desc'>"+
									"<input type='hidden' name='id' value='"+return_data.row.id+"'>"+
									"<p id='noteP' name='description' row='5'></p>"+
							"</form>"+
							"<hr>"+"</div>");
	    			},
	    			"json"
	    		)
	    	return false;
	    });

	    $(document).on('submit','form#insert_desc', function(){
	    	$.post(
	    		$(this).attr('action'),
	    		$(this).serialize(),
	    		function(return_data){
	    			console.log(return_data);
	    		},"json"	
	    	)
	    	return false;
	    });

	    $(document).on('submit', 'form#destroy', function(){
	    	var that = $(this).parent();
	    	$.post(
	    		$(this).attr('action'),
	    		$(this).serialize(),
	    		function(return_data){
	    			console.log('in here');
	    			console.log(return_data);
	    			that.remove();
	    		},"json"	
	    	)
	    	return false;
	    });	

	   	$(document).on('submit', 'form#new_title', function(){
	    	$.post(
	    		$(this).attr('action'),
	    		$(this).serialize(),
	    		function(return_data){
	    			console.log(return_data);
	    		},"json"	
	    	)
	    	return false;
	    });

	    $(document).on('click', '#noteP', function(){
	    		$(this).replaceWith("<textarea id='textP' name='noteAppend'>" + $(this).text() + "</textarea>");
	    		$('#textP').focus();
	    });
	    $(document).on('blur', '#textP', function(){
	    	$(this).parent().submit();
	    	$(this).replaceWith("<p id='noteP'>" + $(this).val() + "</p>")
	    });

	   	$(document).on('click', '#h4_n', function(){
	    	$(this).replaceWith("<textarea id='h4_t' name='titleAppend'>" + $(this).text() + "</textarea>");
	    	$('#h4_t').focus();
	    });
	    $(document).on('blur', '#h4_t', function(){
	    	$(this).parent().submit();
	    	$(this).replaceWith("<h4 id='h4_n'>" + $(this).val() + "</p>")
	    });

	    </script>
		<!-- CSS Styling -->
	    <style>
	    .col-m-6{
	    	background-color:#eee;
	    }
	    #noteP{
			width:220px;
			height:140px;
			padding:10px;
	    	outline:1px solid silver;
	    	background: -webkit-linear-gradient(top, #fffefb 0%,#fcf4d2 100%); 
/*	    	overflow: scroll;*/
	    }
	    #textP{
	    	width:220px;
	    	height:140px;
	    	padding:10px;
	    }
	    button{
	    	margin-top:8px;
	    }
	    #h4_t{
	    	margin-top:-3px;
	    	min-width: 100px;
	    	height:30px;
	    	border: 1px dashed silver;
	    	font-size:18px;
	    	resize:none;
	    	display:inline-block;
	    }
		.b_delete{
			border:0px;
			margin-left:121px;
			background:none;
			color:#2AABD2;
			padding:0px;
			display:inline-block;
		}
		#h4_n{
			display:inline-block;
		}
		.b_delete{
			display:inline-block;
		}
		.top{
			display:inline-block;
		}
		.delete{
			display:inline-block;
		}
	    </style>
	</head>
	<body>

		<div class='container'>
			<div class='row'>
				<div class='col-sm-4'>
				</div>
				<div id="main_loop" class='col-sm-4'>
					<h3>Notes</h3> <!-- central column populated-->
					<hr>
<?php
		foreach ($notes as $note) {		
?>				<div class="chunk">
					<form class="top" action='edit_title' method='post' id='new_title'>
						<input type="hidden" name="id" value="<?=$note['id']?>">
						<h4 id="h4_n"><?=$note['title']?></h4>
					</form>
					<form class="delete" action="delete" method="post" id='destroy'>
						<button class="b_delete">Delete</button>
						<input type="hidden" name="id" value="<?=$note['id']?>">
					</form>
						<form name="descriptor" action="append" method="post" id="insert_desc">
							<input type="hidden" name="id" value="<?=$note['id']?>">
							<p id="noteP" name="description" row="5"><?=$note['description']?></p>
						</form>
						<hr>
				</div>
<?php }?>
				</div>
				<div class='col-sm-4'>
				</div>
			</div><!-- row -->
			<div class="row"> <!-- button row -->
				<div class="col-sm-8 pull-right">
				<form action="create" method="post" class="create">
						<input type="text" name="noteTitle" class="insert" placeholder="Insert note title here..."><br>	
						<button class="btn btn-info btn-xs">Add Note</button>
					</form>
				</div>
				<div>
		</div><!-- container -->
	</body>
</html> 
