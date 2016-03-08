<div class="row">
	<div class="yellow">Marksheet File</div>
	<div id="addNewUserInquiryPopup" class="maskloader"><i class="fa fa-refresh fa-spin"></i></div>
		<div class="leave-history-form collapse" id="collapseExample">
		<?php 
			echo $this->Form->create('Search');
		?>
				<div class="form-group">
					<div class="col-xs-4 col-md-3">
						<label for="">First Name:</label>
						<input name="name" class="form-control uppercase validate[custom[onlyVehicleRegNo1]]" type="text" id="name">
						
					</div>
					<?php 
					if(is_array($arrExams) && (count($arrExams)>0))
					{?>
					<div class="col-xs-4 col-md-3">
						<label for="">Exam:</label>
						
					<select name="exam" class="form-control uppercase">
					<option value="">--Choose One--</option>
					<?php
						foreach($arrExams as $arrExam)
						{
							?>
								<option value="<?php echo $arrExam['Exams']['exam_id'];?>"><?php echo $arrExam['Exams']['exam_name'];?></option>
							<?php
						}
					
					?>
						</select>
						</div>
					<?php }?>
					<?php
					if(is_array($arrClasses) && (count($arrClasses)>0))
			{?>
						<div class="col-xs-4 col-md-3">
						<label for="">Class:</label>
					<select name="classes" class="form-control uppercase">
						<option value="">--Choose One--</option>
						<?php
							foreach($arrClasses as $arrClass)
							{
								?>
									<option value="<?php echo $arrClass['Classes']['class_name'];?>"><?php echo $arrClass['Classes']['class_name'];?></option>
								<?php
							}
						
						?>
						</select>
						</div>
					<?php }?>
				<?php
				if(is_array($arrDiv) && (count($arrDiv)>0))
							{?>				
						<div class="col-xs-4 col-md-3">
						<label for="">Section:</label>
				
					<select name="division" class="form-control uppercase">
						<option value="">--Choose One--</option>
						<?php
							foreach($arrDiv as $arrDi)
							{
								?>
									<option value="<?php echo $arrDi['Divisions']['division_name'];?>"><?php echo $arrDi['Divisions']['division_name'];?></option>
								<?php
							}
						
						?>
						</select>
						</div>
					<?php 
					}?>
					
				</div>
				<div class="col-md-12 search-button">
					<button type="submit" class="btn btn-primary">Search</button>
				</div>
			</form>		
		</div>
				<div class="leave-history-form collapse" id="collapseExample2">
									<form name="exportform" method="post" action="">
										<div class="form-group">
											<div class="col-xs-4 col-md-3">
												<label for="">Export In:</label>
												<select name="export_type" id="export_type" class="form-control" style="padding: 0.4em;margin-top:4%">
							<!--<option value="0">--Choose One--</option>-->
							<option value="pdf">Pdf</option>
							<option value="excel">Excel</option>
						</select>
											</div>
											<div class="col-md-1 search-button">
												<button type="button" value="Export" onclick="fnExportLeaveListing()"  class="btn btn-primary">Export</button>
											</div>
										</div>
									</form>		
								</div>
			<form method="post" name="deleteform">
			<?php
			$strAddUrl = Router::url(array('controller'=>'results','action'=>'import'),true);
		?>
				<button type="submit" class="btn btn-primary" onclick="return fnSubmitListing();" value="Delete" name="delete">Delete</button>
				 <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Search</a>
				 
			<table id="product_list" class="table attendance-table tablesorter">
				<thead>
					<tr>
						<th class="bs-checkbox color2" style="text-align: center; vertical-align: middle; width: 36px; " data-field="" tabindex="0"><input name="" type="checkbox" class="head_checkbox"><div class="fht-cell"></div></th>
						<th class="color2">First Name</th>
						<th class="color2">Last Name</th>
						<th class="color2">Class</th>
						<th class="color2">Section</th>
						<th class="color2">Exam</th>
						<th class="color2">Subject</th>	
						<th class="color2">Mark</th>	
							
						<th class="color2">Action</th>
					</tr>
				</thead>
				<tbody>
				
				<?php 
				if(is_array($arrProcInq) && (count($arrProcInq) > 0))
				{
					//print("<pre>");
					//print_r($arrProcInq);
					//exit;
					
					$srno = 1;
					foreach($arrProcInq as $val)
					{
						?>
							<tr class="tr" id="student_<?php echo $val['exam_student_performance']['exam_student_performance_id'];?>">
							
								<td class="color1"><input style="float: none; width: 40%;" class="checkbox" type="checkbox" name="vehicle[]" value="<?php echo $val['exam_student_performance']['exam_student_performance_id']; ?>"/></td>
								<!--<td class="td srno" style="width:10%;"><?php echo $srno++; ?></td>-->
								<td class="color3"><?php echo $val['Student']['student_fname']; ?></td>
								<td class="color5"><?php echo $val['Student']['student_lname']; ?></td>
								<td class="color7"><?php echo $val['Student']['class']; ?></td>
								<td class="color9"><?php echo $val['Student']['section']; ?></td>
								<td class="color6"><?php echo $val['Exam']['exam_name']; ?></td>
								<td class="color1"><?php echo $val['Subjects']['subject_name']; ?></td>
								<td class="color3"><?php echo $val['exam_student_performance']['student_mark']; ?></td>
								<td class="color5">
									<?php
										$strStudentEditUrl = Router::url(array('controller'=>'students','action'=>'edit',$val['Students']['student_id']),true);
										
										$strStudentViewUrl = Router::url(array('controller'=>'students','action'=>'detail',$val['Students']['student_id']),true);
										
										
									?>
									<a title="Delete" href="javascript:void(0);" onclick="fnDeleteStudent('<?php echo $val['exam_student_performance']['exam_student_performance_id'] ;?>');"><i class="fa fa-trash-o fa-1x"></i></a></span><?php
										if($val['Students']['parent_user'] == "0")
										{
											?>
												<span id="create_user_action_<?php echo $val['Students']['student_id'];?>"><span class="separator"></span><a title="Create User" href="javascript:void(0);" onclick="fnCreateParentUser('<?php echo $val['Students']['student_id'] ;?>');"><i class="fa fa-user fa-1x"></i></a>
											<?php
										}
									?>
									</span>
								</td>
							</tr>
						<?php
					}
				}
				else
				{
					?>
						<tr class="tr">
							<td class="td td_stock">There are no imported marks for student</td>
						</tr>
					<?php
				}
				?>
					
				</tbody>
			</table>
			</form>
	<div class="pagination pagination-large">
     <ul class="pagination">
       <?php
        echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
        echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
        echo $this->Paginator->next(__('next'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
       ?>
      </ul>
     </div>
</div>
<?php /*
<div id="manage-popupmask"></div>
<div id="addNewUserInquiryPopup" class="maskloader"><i class="fa fa-refresh fa-spin"></i></div>
<?php $moveTrashAction = Router::url('/', true).$this->params['controller']."/fnMoveTrashPreProcInquiry/"; ?>
<?php $makehotdealAction = Router::url('/', true).$this->params['controller']."/fnMakeHotDeal/"; ?>
<div class="salestock_main">
	<div class="add_inq">
		<?php //echo $this->Html->link($this->Html->image('admin_img/addnew_enquiry.png', array('title' => 'Add new', 'border' => '0')),array('controller'=>'PreProcInqs','action'=>'add'),array('escape' => false)); ?>
	</div>
  <h2>Marksheets</h2>
	<br clear="all"/>
	<div class="cms-bgloader-mask"></div>
	<div class="cms-bgloader"></div>
	<?php		
		$strStyle = "";		
		$strMessg = "";		
		if($arrUpdateStudent['message'])		
		{			
			$strStyle = "style='display:block;color:#35AC19'";			
			$strMessg = $arrUpdateStudent['message'];		
		}	
	  ?>  
	<div id="notificationmssg" <?php echo $strStyle;?>><?php echo $strMessg;?></div>
	<div class="search">
	<?php 
		
			echo $this->Form->create('Search',array('id'=>'SearchShowForm'));
			//echo $this->Form->input('keywords',array('div'=>false,'label'=>array('text'=>'Keywords','class'=>'search-label'),'class'=>'form-input validate[required]'));
			//echo '<b>Search By</b>';
			//echo '<br clear="all"/>';
			echo '<div class="search_cont">';
				echo '<div class="search-label">First Name:</div>';
				?>
					<input name="name" class="form-input uppercase validate[custom[onlyVehicleRegNo1]]" type="text" id="name">
				<?php
			echo '</div>';
			if(is_array($arrExams) && (count($arrExams)>0))
			{
				echo '<div class="search_cont">';
					echo '<div class="search-label">Exam:</div>';
					?>
					<select name="exam" class="form-input uppercase">
					<option value="">--Choose One--</option>
					<?php
						foreach($arrExams as $arrExam)
						{
							?>
								<option value="<?php echo $arrExam['Exams']['exam_id'];?>"><?php echo $arrExam['Exams']['exam_name'];?></option>
							<?php
						}
					
					?>
						</select>
					<?php
				echo '</div>';
			}
			
			if(is_array($arrClasses) && (count($arrClasses)>0))
			{
				echo '<div class="search_cont">';
					echo '<div class="search-label">Class:</div>';
					?>
						<select name="classes" class="form-input uppercase">
						<option value="">--Choose One--</option>
						<?php
							foreach($arrClasses as $arrClass)
							{
								?>
									<option value="<?php echo $arrClass['Classes']['class_name'];?>"><?php echo $arrClass['Classes']['class_name'];?></option>
								<?php
							}
						
						?>
						</select>
					<?php
				echo '</div>';
			}
			
			if(is_array($arrDiv) && (count($arrDiv)>0))
			{
				echo '<div class="search_cont">';
					echo '<div class="search-label">Section:</div>';
					?>
						<select name="division" class="form-input uppercase">
						<option value="">--Choose One--</option>
						<?php
							foreach($arrDiv as $arrDi)
							{
								?>
									<option value="<?php echo $arrDi['Divisions']['division_name'];?>"><?php echo $arrDi['Divisions']['division_name'];?></option>
								<?php
							}
						
						?>
						</select>
					<?php
				echo '</div>';
			}
			
			/*if(is_array($arrSubjects) && (count($arrSubjects)>0))
			{
				echo '<div class="search_cont">';
					echo '<div class="search-label">Subject:</div>';
					?>
						<select name="subjects" class="form-input uppercase">
						<option value="">--Choose One--</option>
						<?php
							foreach($arrSubjects as $arrSubject)
							{
								?>
									<option value="<?php echo $arrSubject['Subjects']['subject_id'];?>"><?php echo $arrSubject['Subjects']['subject_name'];?></option>
								<?php
							}
						
						?>
						</select>
					<?php
				echo '</div>';
			}*/
			
				
			echo '<div class="search_cont">';
				echo '<br clear="all"/>';
				echo '<br clear="all"/>';
				echo $this->Form->submit('Search', array('div' => false,'class' => 'searchbutton'));
			echo '</div>';
			//echo $this->Form->input('search_keywords',array('div'=>false,'label'=>false,'placeholder'=>'Search Car','class'=>'form-input validate[required]'));
			//echo $this->Form->button('Reset', array('type'=>'reset','class' => 'searchbutton'));
			//echo $this->Form->button('Reset', array('type'=>'reset','onClick="window.location.reload()"));
	?>
	</div>
	<form method="post" name="deleteform">
	<div id="action_block" style="float:left;width:100%;">
		<div style="float:left;width:10%;"><input type="Submit" class="btn log_botton" name="delete" onclick="return fnSubmitListing();" value="Delete"/></div>&nbsp;
		<!--<div style="float:left;width:10%;"><input type="button" class="btn log_botton" value="Filter" onclick="fnToggleFilterBlock()"/></div>-->
	</div>
	
	<table id="product_list" class="table-div table-striped tablesorter">
		<thead>
			<tr class="tr headingrow">
				<th class="th" style="width:5%;"><input style="float:none;" type="checkbox" class="head_checkbox" name="select_all" /></th>
				<!--<th class="th srno" style="width:10%;"> Sr.No </th>-->
				<th class="th th_stock" style="width:12%;">First Name</th>
				<th class="th th_stock" style="width:12%;">Last Name</th>
				<th class="th th_stock" style="width:10%;">Class</th>
				<th class="th th_stock" style="width:10%;">Section</th>
				<th class="th th_stock" style="width:10%;">Exam</th>
				<th class="th th_stock" style="width:10%;">Subject</th>
				<th class="th th_stock" style="width:10%;">Mark</th>
				<th class="th th_stock" style="width:20%;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if(is_array($arrProcInq) && (count($arrProcInq) > 0))
				{
					//print("<pre>");
					//print_r($arrProcInq);
					//exit;
					
					$srno = 1;
					foreach($arrProcInq as $val)
					{
						?>
							<tr class="tr" id="student_<?php echo $val['exam_student_performance']['exam_student_performance_id'];?>">
								<td class="td" style="width:5%;"><input style="float: none; width: 40%;" class="checkbox" type="checkbox" name="vehicle[]" value="<?php echo $val['exam_student_performance']['exam_student_performance_id']; ?>"/></td>
								<!--<td class="td srno" style="width:10%;"><?php echo $srno++; ?></td>-->
								<td class="td td_stock" style="width:12%;"><?php echo $val['Student']['student_fname']; ?></td>
								<td class="td td_stock" style="width:12%;"><?php echo $val['Student']['student_lname']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['Student']['class']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['Student']['section']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['Exam']['exam_name']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['Subjects']['subject_name']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['exam_student_performance']['student_mark']; ?></td>
								<td class="td td_stock" style="width:20%;">
									<?php
										$strStudentEditUrl = Router::url(array('controller'=>'students','action'=>'edit',$val['Students']['student_id']),true);
										
										$strStudentViewUrl = Router::url(array('controller'=>'students','action'=>'detail',$val['Students']['student_id']),true);
										
										
									?>
									<a title="Delete" href="javascript:void(0);" onclick="fnDeleteStudent('<?php echo $val['exam_student_performance']['exam_student_performance_id'] ;?>');"><i class="fa fa-trash-o fa-1x"></i></a></span><?php
										if($val['Students']['parent_user'] == "0")
										{
											?>
												<span id="create_user_action_<?php echo $val['Students']['student_id'];?>"><span class="separator"></span><a title="Create User" href="javascript:void(0);" onclick="fnCreateParentUser('<?php echo $val['Students']['student_id'] ;?>');"><i class="fa fa-user fa-1x"></i></a>
											<?php
										}
									?>
									</span>
								</td>
							</tr>
						<?php
					}
				}
				else
				{
					?>
						<tr class="tr">
							<td class="td td_stock">There are no imported marks for student</td>
						</tr>
					<?php
				}
				?>
		</tbody>
	</table>
	
	</form>
	<div class="pagination pagination-large">	
	<?php 
	if ($this->Paginator->hasPage(2)) {		
		echo $this->Paginator->prev();
		echo (" | ");
	} ?> 
	<?php echo $this->Paginator->numbers(); ?> 
	<?php 
	if ($this->Paginator->hasPage(2)) { 
		echo (" | ");
		echo $this->Paginator->next();
	} ?>
</div>
<script type="text/javascript">
	$(document).ready(function()
		{
			
			$("#product_list").tablesorter({
				// pass the headers argument and assing a object
				headers: {
					// assign the secound column (we start counting zero)
					0: {
						// disable it by setting the property sorter to false
						sorter: false
					},
					// assign the third column (we start counting zero)
					8: {
						// disable it by setting the property sorter to false
						sorter: false
					}
					
				}
			});
		}
	);
</script>
<?php /*

<div id="manage-popupmask"></div>
<div id="addNewUserInquiryPopup" class="maskloader"><i class="fa fa-refresh fa-spin"></i></div>
<?php $moveTrashAction = Router::url('/', true).$this->params['controller']."/fnMoveTrashPreProcInquiry/"; ?>
<?php $makehotdealAction = Router::url('/', true).$this->params['controller']."/fnMakeHotDeal/"; ?>
<div class="salestock_main">
	<div class="add_inq">
		<?php //echo $this->Html->link($this->Html->image('admin_img/addnew_enquiry.png', array('title' => 'Add new', 'border' => '0')),array('controller'=>'PreProcInqs','action'=>'add'),array('escape' => false)); ?>
	</div>
  <h2>Marksheets</h2>
	<div class="back_link">
		<a title="Back" class="right-align" onclick="goBack()">BACK</a>       
	</div>
	<?php		
		$strStyle = "";		
		$strMessg = "";		
		if($arrUpdateStudent['message'])		
		{			
			$strStyle = "style='display:block;color:#35AC19'";			
			$strMessg = $arrUpdateStudent['message'];		
		}	
	  ?>  
	<div id="notificationmssg" <?php echo $strStyle;?>><?php echo $strMessg;?></div>
	<?php		
		$strStyle = "";		
		$strMessg = "";		
		if($arrUpdateStudent['message'])		
		{			
			$strStyle = "style='display:block;color:#35AC19'";			
			$strMessg = $arrUpdateStudent['message'];		
		}	
	  ?>  
	<div id="notificationmssg" <?php echo $strStyle;?>><?php echo $strMessg;?></div>
	<div class="search">
	<?php 
		
			echo $this->Form->create('Search',array('id'=>'SearchShowForm'));
			//echo $this->Form->input('keywords',array('div'=>false,'label'=>array('text'=>'Keywords','class'=>'search-label'),'class'=>'form-input validate[required]'));
			//echo '<b>Search By</b>';
			//echo '<br clear="all"/>';
			echo '<div class="search_cont">';
				echo '<div class="search-label">First Name:</div>';
				?>
					<input name="name" class="form-input uppercase validate[custom[onlyVehicleRegNo1]]" type="text" id="name">
				<?php
			echo '</div>';
			if(is_array($arrExams) && (count($arrExams)>0))
			{
				echo '<div class="search_cont">';
					echo '<div class="search-label">Exam:</div>';
					?>
					<select name="exam" class="form-input uppercase">
					<option value="">--Choose One--</option>
					<?php
						foreach($arrExams as $arrExam)
						{
							?>
								<option value="<?php echo $arrExam['Exams']['exam_id'];?>"><?php echo $arrExam['Exams']['exam_name'];?></option>
							<?php
						}
					
					?>
						</select>
					<?php
				echo '</div>';
			}
			
			if(is_array($arrClasses) && (count($arrClasses)>0))
			{
				echo '<div class="search_cont">';
					echo '<div class="search-label">Class:</div>';
					?>
						<select name="classes" class="form-input uppercase">
						<option value="">--Choose One--</option>
						<?php
							foreach($arrClasses as $arrClass)
							{
								?>
									<option value="<?php echo $arrClass['Classes']['class_name'];?>"><?php echo $arrClass['Classes']['class_name'];?></option>
								<?php
							}
						
						?>
						</select>
					<?php
				echo '</div>';
			}
			
			if(is_array($arrDiv) && (count($arrDiv)>0))
			{
				echo '<div class="search_cont">';
					echo '<div class="search-label">Section:</div>';
					?>
						<select name="division" class="form-input uppercase">
						<option value="">--Choose One--</option>
						<?php
							foreach($arrDiv as $arrDi)
							{
								?>
									<option value="<?php echo $arrDi['Divisions']['division_name'];?>"><?php echo $arrDi['Divisions']['division_name'];?></option>
								<?php
							}
						
						?>
						</select>
					<?php
				echo '</div>';
			}
				
			echo '<div class="search_cont">';
				echo '<br clear="all"/>';
				echo '<br clear="all"/>';
				echo $this->Form->submit('Search', array('div' => false,'class' => 'searchbutton'));
			echo '</div>';
			//echo $this->Form->input('search_keywords',array('div'=>false,'label'=>false,'placeholder'=>'Search Car','class'=>'form-input validate[required]'));
			//echo $this->Form->button('Reset', array('type'=>'reset','class' => 'searchbutton'));
			//echo $this->Form->button('Reset', array('type'=>'reset','onClick="window.location.reload()"));
	?>
	</div>
	<form method="post" name="deleteform">
	<div id="action_block" style="float:left;width:100%;">
		<div style="float:left;width:10%;"><input type="Submit" class="btn log_botton" name="delete" onclick="return fnSubmitListing();" value="Delete"/></div>&nbsp;
		<!--<div style="float:left;width:10%;"><input type="button" class="btn log_botton" value="Filter" onclick="fnToggleFilterBlock()"/></div>-->
	</div>
	
	<table id="product_list" class="table-div table-striped tablesorter">
		<thead>
			<tr class="tr headingrow">
				<th class="th" style="width:5%;"><input style="float:none;" type="checkbox" class="head_checkbox" name="select_all" /></th>
				<!--<th class="th srno" style="width:10%;"> Sr.No </th>-->
				<th class="th th_stock" style="width:12%;">First Name</th>
				<th class="th th_stock" style="width:12%;">Last Name</th>
				<th class="th th_stock" style="width:10%;">Class</th>
				<th class="th th_stock" style="width:10%;">Section</th>
				<th class="th th_stock" style="width:10%;">Exam</th>
				<th class="th th_stock" style="width:10%;">Subject</th>
				<th class="th th_stock" style="width:10%;">Mark</th>
				<th class="th th_stock" style="width:20%;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if(is_array($arrProcInq) && (count($arrProcInq) > 0))
				{
					//print("<pre>");
					//print_r($arrProcInq);
					//exit;
					
					$srno = 1;
					foreach($arrProcInq as $val)
					{
						?>
							<tr class="tr" id="student_<?php echo $val['exam_student_performance']['exam_student_performance_id'];?>">
								<td class="td" style="width:5%;"><input style="float: none; width: 40%;" class="checkbox" type="checkbox" name="vehicle[]" value="<?php echo $val['exam_student_performance']['exam_student_performance_id']; ?>"/></td>
								<!--<td class="td srno" style="width:10%;"><?php echo $srno++; ?></td>-->
								<td class="td td_stock" style="width:12%;"><?php echo $val['Student']['student_fname']; ?></td>
								<td class="td td_stock" style="width:12%;"><?php echo $val['Student']['student_lname']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['Student']['class']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['Student']['section']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['Exam']['exam_name']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['Subjects']['subject_name']; ?></td>
								<td class="td td_stock" style="width:10%;"><?php echo $val['exam_student_performance']['student_mark']; ?></td>
								<td class="td td_stock" style="width:20%;">
									<?php
										$strStudentEditUrl = Router::url(array('controller'=>'students','action'=>'edit',$val['Students']['student_id']),true);
										
										$strStudentViewUrl = Router::url(array('controller'=>'students','action'=>'detail',$val['Students']['student_id']),true);
										
										
									?>
									<a title="Delete" href="javascript:void(0);" onclick="fnDeleteStudent('<?php echo $val['exam_student_performance']['exam_student_performance_id'] ;?>');"><i class="fa fa-trash-o fa-1x"></i></a></span><?php
										if($val['Students']['parent_user'] == "0")
										{
											?>
												<span id="create_user_action_<?php echo $val['Students']['student_id'];?>"><span class="separator"></span><a title="Create User" href="javascript:void(0);" onclick="fnCreateParentUser('<?php echo $val['Students']['student_id'] ;?>');"><i class="fa fa-user fa-1x"></i></a>
											<?php
										}
									?>
									</span>
								</td>
							</tr>
						<?php
					}
				}
				else
				{
					?>
						<tr class="tr">
							<td class="Success_message">There is nothing matching to the provided search criteria</td>
						</tr>
					<?php
				}
				?>
		</tbody>
	</table>
	
	</form>
	<div class="pagination pagination-large">	
	<?php 
	if ($this->Paginator->hasPage(2)) {		
		echo $this->Paginator->prev();
		echo (" | ");
	} ?> 
	<?php echo $this->Paginator->numbers(); ?> 
	<?php 
	if ($this->Paginator->hasPage(2)) { 
		echo (" | ");
		echo $this->Paginator->next();
	} ?>
</div> <?php */?>
<script type="text/javascript">
	$(document).ready(function()
		{
			var intExam = '<?php echo $arrConditions["exam"];?>';
			
			if(intExam != 0 && intExam != "")
			{
				$('#exam').val(intExam);
			}
			
			$("#product_list").tablesorter({
				// pass the headers argument and assing a object
				headers: {
					// assign the secound column (we start counting zero)
					0: {
						// disable it by setting the property sorter to false
						sorter: false
					},
					// assign the third column (we start counting zero)
					8: {
						// disable it by setting the property sorter to false
						sorter: false
					}
					
				}
			});
		}
	);
	function goBack() {
		window.history.back()
	}
</script>  