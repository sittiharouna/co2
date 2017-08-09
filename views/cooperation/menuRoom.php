<style>
	
	#coop-container, #menu-room, #coop-data-container{
		min-height:700px;
		
	}

	#coop-container{
		border-top: 1px solid #c6c4c4;
		border-bottom: 1px solid #c6c4c4;
	}

	#menu-room{
		padding-top:10px;
		border-left: 1px solid #c6c4c4;
		border-right: 1px solid #c6c4c4;
	}


	#menu-room .load-coop-data{
		/*border-left: 3px solid #3C545D;*/
		padding:8px;
		margin-top:5px;
		font-size: 15px;
		line-height: 17px;
	}

	#menu-room .load-coop-data small{
		font-weight: 300 !important;
	}

	#menu-room .menuCoop .title-section{
		padding: 6px 6px 6px 15px;
	}

	#menu-room .menuCoop .title-section a{
		padding-right: 8px;
		margin-top:-1px;
	}
	#menu-room .menuCoop .title-section a:hover{
		border-color:transparent!important;
		background-color: white;
		border-radius: 15px;

	}

	#menu-room a.btn-hide-data-room{
		width:30px;
		text-align: center;
		margin-right:5px;
	}

	#menu-room.min .submenucoop{
		width:100%;
	}

	#menu-room.min .hidden-min{
		display: none;
	}

	#coop-data-container{
		border-right: 1px solid #c6c4c4;
	}
</style>

<div class="col-lg-12 col-md-12 col-sm-12 no-padding margin-top-15 bg-white" id="coop-container">
	
	<div class="col-lg-12 col-md-12 col-sm-12 bg-white" id="menu-room">

		<?php //var_dump($room); ?>
		<?php if(@$room){ ?>
			<img src="">
			<h2><i class="fa fa-hashtag"></i> <?php echo @$room["name"]; ?></h2>
			<hr>
			<h4><?php echo Yii::t("cooperation", "Topic") ?> : <small><?php echo @$room["topic"]; ?></small></h4>
			<h5><small><?php echo @$room["description"]; ?></small></h5>
			<hr>
		<?php }else{ ?>
			<h2>
				<i class="fa fa-hashtag"></i> 
				<?php echo Yii::t("cooperation", @$post["type"])." - ".Yii::t("cooperation", @$post["status"]); ?>
			</h2>
		<?php } ?>

		<ul class="menuCoop margin-bottom-50 ">
			<?php //var_dump($proposalList); ?>
			<?php if(@$proposalList || @$room){ ?>
				<div class="title-section">
					<a href="javascript:" class="pull-left open elipsis btn-hide-data-room visible-sm visible-xs" 
						style="margin-left:-10px;" data-key="proposals">
				  		<i class="fa fa-caret-down"></i>
				  	</a>
					<i class="fa fa-inbox"></i> 
			  		<?php echo Yii::t("cooperation", "Proposals") ?>
			  		<a href="javascript:" class="letter-green pull-right btn-add">
				  		<i class="fa fa-plus-circle tooltips"  data-placement='top'  data-toogle='tooltips'
				  			data-original-title="<?php echo Yii::t("cooperation", "Add proposal") ?>"></i> 
				  		<span class="hidden-min"><?php echo Yii::t("cooperation", "Add proposal") ?></span>
				  	</a>
			  	</div>
				


				<?php if(@$proposalList)
						//for($i=0;$i<20;$i++)
						foreach($proposalList as $key => $proposal){ ?>
						<li class="submenucoop sub-proposals no-padding col-lg-4 col-md-6 col-sm-6">
							<a href="javascript:" class="load-coop-data" data-type="proposal" 
							   data-dataid="<?php echo (string)@$proposal["_id"]; ?>">
						  		<span class="elipsis">
						  			<i class="fa fa-hashtag"></i> <?php echo @$proposal["title"]; ?>
						  		</span>
							  	<br>
							  	<small class="letter-light">
							  		<i class="fa fa-pencil"></i> <?php echo Yii::t("cooperation", @$proposal["status"]); ?>
							  	</small>
						  	</a>
						</li>
				<?php } ?>

				<hr class="col-lg-12 col-md-12 col-sm-12 no-padding margin-bottom-25">

			<?php } ?>

			<?php //var_dump($proposalList); ?>
			<?php if(@$actionList || @$room){ ?>
				<div class="margin-top-25 title-section col-lg-12 col-md-12 col-sm-12">
					<a href="javascript:" class="open elipsis pull-left btn-hide-data-room visible-sm visible-xs" 
						style="margin-left:-10px;" data-key="actions">
				  		<i class="fa fa-caret-down"></i>
				  	</a>
					<i class="fa fa-inbox"></i> 
			  		<?php echo Yii::t("cooperation", "Actions") ?>
				  	<a href="javascript:" class="letter-green pull-right">
				  		<i class="fa fa-plus-circle"></i> 
				  		<span class="hidden-min"><?php echo Yii::t("cooperation", "Add action") ?></span>
				  	</a>
			  	</div>
				
				<?php   if(@$actionList)
						foreach($actionList as $key => $action){ ?>
							<li class="submenucoop sub-actions no-padding col-lg-4 col-md-6 col-sm-6">
								<a href="javascript:" class="load-coop-data" data-type="action" 
								   data-dataid="<?php echo (string)@$action["_id"]; ?>">
							  		<span class="elipsis">
							  			<i class="fa fa-hashtag"></i> <?php echo @$action["name"]; ?>
							  		</span>
								  	<br>
								  	<small class="letter-light">
								  		<i class="fa fa-pencil"></i> <?php echo Yii::t("cooperation", @$action["status"]); ?>
								  	</small>
							  	</a>
							</li>
				<?php } ?>

				<hr class="col-lg-12 col-md-12 col-sm-12 no-padding margin-bottom-25">

			<?php } ?>

			<?php //var_dump($proposalList); ?>
			<?php if(@$resolutionList || @$room){ ?>
				<div class="margin-top-25 title-section col-lg-12 col-md-12 col-sm-12">
					<i class="fa fa-inbox"></i> 
			  		<?php echo Yii::t("cooperation", "Resolutions") ?>
			  	</div>
				
				<?php  	if(@$resolutionList)
						foreach($resolutionList as $key => $resolution){ ?>
							<li class="submenucoop sub-resolutions no-padding col-lg-4 col-md-6 col-sm-6">
								<a href="javascript:" class="load-coop-data" data-type="resolution" 
								   data-dataid="<?php echo (string)@$resolution["_id"]; ?>">
							  		<span class="elipsis">
							  			<i class="fa fa-hashtag"></i> <?php echo @$resolution["title"]; ?>
							  		</span>
							  	</a>
							</li>
				<?php } ?>

				<hr class="col-md-12 no-padding margin-bottom-25">

			<?php } ?>
		</ul>

	</div>

	<div class="hidden" id="coop-data-container">
		
	</div>
</div>