<?php 

	$auth = Authorisation::canEditItem(Yii::app()->session['userId'], $action["parentType"], $action["parentId"]);

?>


<div class="col-lg-7 col-md-6 col-sm-6 pull-left margin-top-15">
	<?php if(@$post["status"]) {
  		$parentRoom = Room::getById($action["idParentRoom"]);
  	?>
  	<h4 class="letter-turq">
  		<i class="fa fa-connectdevelop"></i> <?php echo @$parentRoom["name"]; ?>
	</h4>
	<br>
  	<?php  } ?>


<?php
	//if no assignee , no startDate no end Date
    $statusLbl = Yii::t("rooms", "Todo");
    $statusColor = "badge-info";
    //if startDate passed, or no startDate but has end Date
    if( (bool)strtotime(@$action["startDate"]) == FALSE && (bool)strtotime(@$action["endDate"]) == FALSE ){
    	$action["status"] = "nodate";	
    } 
    else if( strtotime(@$action["startDate"]) > time() )
      	$action["status"] = "startingsoon";
    else if( ( isset($action["startDate"]) && strtotime($action["startDate"]) <= time() )  || 
    		   ( !@$action["startDate"] && @$action["endDate"] ) )
    {
      $action["status"] = "progress";
      if( strtotime(@$action["endDate"]) < time()  )
        $action["status"] = "late";
      
    } 
?>			

	<label class=""><i class="fa fa-bell"></i> Status : 
		<small class="letter-<?php echo Cooperation::getColorCoop($action["status"]); ?>">
			<?php echo Yii::t("cooperation", $action["status"]); ?>
		</small>
	</label>

	<h4 class="text-purple no-margin">
		<i class="fa fa-pencil"></i> Action ouverte 
<?php
if( @$action["startDate"] && (bool)strtotime(@$action["startDate"]) != FALSE ){
?> 
		du <small class="text-purple"><?php echo date('d/m/Y', strtotime($action["startDate"])); ?>
<?php
}

if( @$action["endDate"] && (bool)strtotime(@$action["endDate"]) != FALSE ){
?> 
		au <?php echo date('d/m/Y', strtotime($action["endDate"])); ?></small>
			<!-- <br><i class="fa fa-angle-right"></i> Fin <?php echo Translate::pastTime($action["endDate"], "date"); ?> -->
<?php } ?>		
	</h4>
</div>

<div class="col-lg-5 col-md-6 col-sm-6">
	<button class="btn btn-default pull-right margin-left-5 margin-top-10 tooltips" 
				data-original-title="Fermer cette fenêtre" data-placement="bottom"
				id="btn-close-action">
		<i class="fa fa-times"></i>
	</button>
	<?php if($auth && @$action["creator"] == Yii::app()->session['userId']){ ?>
		 <div class="pull-right dropdown">
		  <button class="btn btn-default margin-left-5 margin-top-10" data-toggle="dropdown">
			<i class="fa fa-cog"></i> options
		  </button>
		  <ul class="dropdown-menu">
		    <li><a href="javascript:" id="btn-edit-action" 
		    		data-id-action="<?php echo $action["_id"]; ?>"
		    		data-status="archived">
		    	<i class="fa fa-pencil"></i> Modifier l'action
		    	</a>
		    </li>
		    <li><a href="javascript:" class="btn-option-status-action" 
		    		data-id-action="<?php echo $action["_id"]; ?>"
		    		data-status="archived">
		    	<i class="fa fa-trash"></i> Archiver l'action
		    	</a>
		    </li>
		    <!-- <li><hr class="margin-5"></li> -->
		    <li><a href="javascript:" class="btn-option-status-action" 
		    		data-id-action="<?php echo $action["_id"]; ?>"
		    		data-status="done">
		    		<i class="fa fa-times"></i> Fermer l'action
		    	</a>
		    </li>
		  </ul>
		</div> 
	<?php } ?>
	<button class="btn btn-default pull-right margin-left-5 margin-top-10 tooltips" 
				data-original-title="Actualiser les données" data-placement="bottom"
				data-id-action="<?php echo $action["_id"]; ?>"
				id="btn-refresh-action"><i class="fa fa-refresh"></i></button>

	<button class="btn btn-default pull-right margin-left-5 margin-top-10 btn-extend-action tooltips" 
				data-original-title="Agrandir l'espace de lecture" data-placement="bottom">
		<i class="fa fa-long-arrow-left"></i>
	</button>
	<button class="btn btn-default pull-right margin-left-5 margin-top-10 hidden btn-minimize-action tooltips" 
				data-original-title="Réduire l'espace de lecture" data-placement="bottom">
		<i class="fa fa-long-arrow-right"></i>
	</button>
</div>


<div class="col-lg-12 col-md-12 col-sm-12 margin-top-25">
	
	<div class="padding-15 bg-lightblue radius-5" id="container-text-action" 
		 style="padding-top:5px !important; color:#2C3E50 !important">
			
			<?php if(@$action["name"]){ ?>
				<h3><i class="fa fa-hashtag"></i> <?php echo @$action["name"]; ?></h3>
			<?php } ?>
		
			<?php echo nl2br(@$action["description"]); ?>
	</div>
</div>

<div class="col-md-12 " >
	<?php if( @$action["links"]["contributors"] ) {	
			$this->renderPartial('../pod/usersList', array(  
								"project"=> $action,
								"users" => $contributors,
								"countStrongLinks" => $countStrongLinks, 
								"userCategory" => Yii::t("rooms","Doers"), 
								"contentType" => ActionRoom::COLLECTION_ACTIONS,
								"admin" => true	)); 
		}
	
	if( Authorisation::canParticipate(Yii::app()->session['userId'],$action["parentType"],$action["parentId"]) && 
		  !@$action["links"]["contributors"][Yii::app()->session['userId']]  )
	{	?>
	<a href="javascript:;" class="pull-right text-large btn btn-dark-blue " 
	   onclick="assignMe('<?php echo (string)$action["_id"]?>');" >
		<i class="fa fa-link"></i> 
		<?php echo Yii::t("rooms","I'll Do it") ?>
   	</a>
	<?php }	?>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 margin-top-50 padding-bottom-5">
	<h4 class="text-center">
		<i class="fa fa-comments fa-2x margin-bottom-10"></i><br>Discussion<br>
		<i class="fa fa-angle-down"></i>
	</h4>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 margin-top-10 margin-bottom-50" id="comments-container"><hr></div>


<script type="text/javascript">
	var parentTypeElement = "<?php echo $action['parentType']; ?>";
	var parentIdElement = "<?php echo $action['parentId']; ?>";
	var idAction = "<?php echo $action['_id']; ?>";
	var idParentRoom = "<?php echo $action['idParentRoom']; ?>";
	var msgController = "<?php echo @$msgController ? $msgController : ''; ?>";
	jQuery(document).ready(function() { 
		$("#comments-container").html("<i class='fa fa-spin fa-refresh'></i> Chargement des commentaires");
		getAjax("#comments-container",baseUrl+"/"+moduleId+"/comment/index/type/actions/id/"+idAction,
			function(){  //$(".commentCount").html( $(".nbComments").html() ); 
		},"html");


		$("#btn-close-action").click(function(){
			uiCoop.minimizeMenuRoom(false);
		});
		$(".btn-extend-action").click(function(){
			uiCoop.maximizeReader(true);
			$(".btn-minimize-action").removeClass("hidden");
			$(".btn-extend-action").addClass("hidden");
		});
		$(".btn-minimize-action").click(function(){
			uiCoop.maximizeReader(false);
			$(".btn-minimize-action").addClass("hidden");
			$(".btn-extend-action").removeClass("hidden");
		});

		$(".btn-option-status-action").click(function(){
			var idAction = $(this).data("id-action");
			var status = $(this).data("status");
			console.log("update status actions", idAction, status, parentTypeElement, parentIdElement);
			uiCoop.changeStatus("actions", idAction, status, parentTypeElement, parentIdElement);
		});

		$("#btn-edit-action").click(function(){
			var idaction = $(this).data("id-action");
			console.log("edit idAction", idAction);
			dyFObj.editElement('actions', idAction);
		});

		location.hash = "#page.type." + parentTypeElement + ".id." + parentIdElement + 
							  ".view.coop.room." + idParentRoom + ".action." + idAction;
	});

	function assignMe(id)
	{
	    bootbox.confirm("<strong>Êtes-vous sûr de vouloir participer à cette action ?</strong>" +
	    				"Vous serez inscrit dans la liste des participants.",

	        function(result) {
	            if (result) {
	              params = { "id" : id };
	              ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/rooms/assignme")?>',params,function(data){
	                if(data.result)
	                  alert("Tango a l'aide comment je reload stp action.php > function assignMe > l.181");
	                else 
	                  toastr.error(data.msg);
	              });
	        } 
	    });
	 }
</script>