<style type="text/css">
	.carousel-media > ol > li.active{
	   margin:1px;
	   border-top: 5px solid #EF5B34 !important;
	}
	.carousel-media > ol > li{
		    width: 60px !important;
    background-color: inherit;
    border: inherit !important;
    height: 65px !important;
    border-radius: inherit;
    border-top: 5px solid lightgray !important;
    text-indent: inherit;
	}
	
	.carousel-media > ol > li > img{
	   float:left;
	   width:60px;
	   height:60px;
	}
	.carousel-media > ol > li > span{
		position: relative;
		float:left;
		top: -60px;
		line-height: 60px;
		width:60px;
	}
	.carousel-media > ol > li > span > i{
		vertical-align: middle;
	}
	.carousel-media > ol{
		bottom: -85px
	}
	.carousel-media .carousel-indicators{
		left:30%;
		width: 100%;
	}
	.carousel-media{
		margin-bottom: 100px;
	}
	.carousel-media .carousel-inner{
		max-height: 550px;
	}

	.carousel-media .carousel-inner .item > img{
		width: 100%;
	}
</style>
<div id="myCarousel" class="col-md-12 no-padding carousel carousel-media slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php 
			$i=0;
			if(!empty($medias)){
			foreach ($medias as $data){ ?>
				 <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo "active"; ?>"><img src="<?php echo $data["content"]["image"] ?>" alt=""><span class="text-white text-center"><i class="fa fa-2x fa-play-circle-o"></i></span></li>
	   
		<?php $i++;
		 } } ?>
		 <?php 
		 	if(!empty($images)){
			foreach ($images as $data){ ?>
				 <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="<?php if($i==0) echo "active"; ?>"><img src="<?php echo $data["imageThumbPath"] ?>" alt=""></li>
	   
		<?php $i++;
		 } } ?>
	    <!--<li data-target="#myCarousel" data-slide-to="0" class="active"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion4.jpg" alt="Reunion 1"></li>
	    <li data-target="#myCarousel" data-slide-to="1"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion5.jpg" alt="Reunion 1"></li>-->
	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php 
			$i=0;
			if(!empty($medias)){
			foreach ($medias as $data){ ?>
				 <div class="item <?php if($i==0) echo "active"; ?>">
			      <iframe width="100%" height="400" src="<?php echo $data["content"]["videoLink"] ?>" frameborder="0" allowfullscreen></iframe>
			    </div>
		<?php $i++;
		 } } ?>
		 <?php 
		 	if(!empty($images)){
			foreach ($images as $data){ ?>
				<div class="item <?php if($i==0) echo "active"; ?>">
	    		  <img src="<?php echo $data["imagePath"] ?>" alt="Reunion 1">
	    		</div>
		<?php $i++;
		 } } ?>
	    <!--<div class="item active">
	      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion4.jpg" alt="Reunion 1">
	      <div class="carousel-caption">
	        <h3>Bienvenu chez l'habitant</h3>
	        <p>L’objectif de ce projet est de promouvoir la culture réunionnaise en passant par des habitant, ou des prestataire à taille humaine, qui ont une légitimité pour la représenter. Des acteurs qui vont garantir la véracité et l’authenticité de notre culture et favoriser son développement. 
			</p>
	      </div>
	    </div>

	    <div class="item">
	      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/reunion/reunion5.jpg" alt="Reunion 1">
	      <div class="carousel-caption">
	        <h3>Bienvenu chez l'habitant</h3>
	        <p>L’objectif de ce projet est de promouvoir la culture réunionnaise en passant par des habitant, ou des prestataire à taille humaine, qui ont une légitimité pour la représenter. Des acteurs qui vont garantir la véracité et l’authenticité de notre culture et favoriser son développement. 
			</p>
	      </div>
	    </div>-->

	</div>
</div>
