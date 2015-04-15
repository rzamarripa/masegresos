<?php $this->beginContent('//layouts/main'); ?>

	<div class="container page-header">
	    <div class="span7">
	        	<?php if($this->pageCaption !== '') : ?>
					<div>
						<h1><?php echo CHtml::encode($this->pageCaption); ?> <small><?php echo CHtml::encode($this->pageDescription)?></small></h1>
					</div>
				<?php endif; ?>
	    </div>
		<div class="span4">
			<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			    'links'=>$this->breadcrumbs,
							'separator'=>' / ',
			)); ?>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<?php	if(isset($this->menu))
	        	{
		            $this->beginWidget('zii.widgets.CPortlet', array(
		                'title'=>'',
		            ));
	            }
	            $this->widget('bootstrap.widgets.TbMenu', array(
	                'items'=>$this->menu,
	                'htmlOptions'=>array('class'=>'nav nav-tabs '),
	            ));
	            $this->endWidget();
	        ?>
		</div>
	</div>
	<div id="content">
	    <?php echo $content; ?>
	</div><!-- content -->
<?php $this->endContent(); ?>