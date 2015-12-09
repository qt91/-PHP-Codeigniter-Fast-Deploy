<?php $this->load->view('header'); ?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?php $this->load->view('sidebar'); ?>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box green ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i> <?php echo $view['title']; ?>
							</div>
						</div>
						<div class="portlet-body form">
							<form class="form-horizontal" role="form" action="" method="POST">
								<div class="form-body">
								<?php foreach($data as $key=>$value):
									$ex = explode('(', $value['Type']);
					                $ex1 = $ex[0];
					                if(count($ex) == 2)
					                    $ex2 = str_replace(')', '', $ex[1]);
								?>
								<?php if($ex1 == 'varchar'): ?>
								<div class="form-group">
									<label class="col-md-3 control-label"><?php echo $value['Field']; ?></label>
									<div class="col-md-9">
										<input name="<?php echo $value['Field']; ?>" type="text" class="form-control">
									</div>
								</div>
								<?php endif; ?>
									
								
								<?php endforeach; ?>

								<?php if(false): ?>
									<div class="form-group">
									<label class="col-md-3 control-label">Inline Help</label>
									<div class="col-md-9">
										<input type="text" class="form-control input-inline input-medium" placeholder="Enter text">
										<span class="help-inline">
										Inline help. </span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Input Group</label>
									<div class="col-md-9">
										<div class="input-inline input-medium">
											<div class="input-group">
												<span class="input-group-addon">
												<i class="fa fa-user"></i>
												</span>
												<input type="email" class="form-control" placeholder="Email Address">
											</div>
										</div>
										<span class="help-inline">
										Inline help. </span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Email Address</label>
									<div class="col-md-9">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
											</span>
											<input type="email" class="form-control" placeholder="Email Address">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Dropdown</label>
									<div class="col-md-9">
										<select class="form-control">
											<option>Option 1</option>
											<option>Option 2</option>
											<option>Option 3</option>
											<option>Option 4</option>
											<option>Option 5</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Textarea</label>
									<div class="col-md-9">
										<textarea class="form-control" rows="3"></textarea>
									</div>
								</div>
								<?php endif; ?>
								</div>
								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn green">Thêm</button>
											<button type="button" class="btn default">Hủy</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php $this->load->view('footer'); ?>