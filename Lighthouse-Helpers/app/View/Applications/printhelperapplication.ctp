<!-- File: /app/View/Applications/printhelperapplication.ctp -->
<?php //debug($applicationstoprint); ?>

<div id="applicationform" class="index">
<?php foreach($applicationstoprint as $applicationtoprint) : ?>
	<table id="heading">
		<tr>
			<td class="twothirds">
				<h3 class="centre"><?php echo __('LIGHTHOUSE %s HELPERS REGISTRATION FORM',$lhyear);?></h3>
				<h3 class="centre"><?php echo __('%s - %s',$lhmonday->format('l jS F'),$lhfriday->format('l jS F Y'))?></h3>
			</td>
			<td class="noborder onethird">
				<table id="officeuse" class="colapseborder">
					<tr>
						<td class="quarter border"><span class="rubric">Office use</span></td>
						<td class="quarter border"></td>
						<td class="quarter border"></td>
						<td class="quarter border"><span class="rubric">Badge no:</span><div class="indent"><?php echo $applicationtoprint['Person']['Person_ID']?></div></td>
					</tr>
				</table>
			</td>
		</tr>		
	</table>
	<table id="body" class="colapseborder border">
		<tr>
			<td colspan="2"><h3>Your details</h3></td>
		</tr>		
		<tr>
			<td class="half">
				<table id="detailleft">
					<tr>
						<td colspan="2" class="border">
							<span class="rubric">Full Name:</span>
							<div class="indent">
								<?php echo __('%s %s %s',$applicationtoprint['Person']['Title'],
														$applicationtoprint['Person']['First_Name'],
														$applicationtoprint['Person']['Last_Name']);?>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="border">
							<span class="rubric">Name known by:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Person']['Nickname'];?>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="border">
							<span class="rubric">Address:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Person']['Address_1'];?><br/>
								<?php if(strlen($applicationtoprint['Person']['Address_2'])>0) 
										echo $applicationtoprint['Person']['Address_2'].'<br/>';?>
								<?php echo $applicationtoprint['Person']['Town'];?><br/>
								<?php echo $applicationtoprint['Person']['County'];?><br/>
								<?php echo $applicationtoprint['Person']['Post_Code'];?> 
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="border">
							<span class="rubric">Email address:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Person']['email'];?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="border half">
							<span class="rubric">Telephone Home:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Person']['Telephone_1'];?>
							</div>
						</td>
						<td class="border half">
							<span class="rubric">Telephone Mobile:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Person']['Telephone_2'];?>
							</div>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="border">
							<span class="rubric">Date of Birth:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Person']['Date_of_birth'];?>
							</div>
						</td>
					</tr>
				</table>
			</td>
			<td class="half">
				<table id="detailright">
					<tr>
						<td class="border">
							<span class="rubric">Address during Lighthouse week if different:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Application'][0]['LH_Address_1'];?><br/>
								<?php if(isset($applicationtoprint['Application'][0]['LH_Address_2'])) 
										echo $applicationtoprint['Application'][0]['LH_Address_2'].'<br/>';?>
								<?php echo $applicationtoprint['Application'][0]['LH_Town'];?><br/>
								<?php echo $applicationtoprint['Application'][0]['LH_County'];?><br/>
								<?php echo $applicationtoprint['Application'][0]['LH_Post_Code'];?> 
							</div>
							<span class="rubric">Telephone:</span>
							<div class="indent"><?php echo $applicationtoprint['Application'][0]['LH_Telephone'];?></div>
						</td>
					</tr>
					<tr>
						<td class="border">
							<span class="rubric">Which church do you attend regularly, if any?</span>
							<div class="indent">
								<?php echo $applicationtoprint['Church']['Name'];?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="border">
							<span class="rubric">Please give the details of someone that we can contact in case of an emergency:</span>
							<table>
								<tr>
									<td>
										<span class="rubric">Name:</span>
									</td>
									<td>
										<?php echo $applicationtoprint['Application'][0]['Emergency_contact'];?>
									</td>
								</tr>
								<tr>
									<td>
										<span class="rubric">Telephone:</span>
									</td>
									<td>
										<?php echo $applicationtoprint['Application'][0]['Emergency_phone1'];?>
									</td>
								</tr>
								<tr>
									<td>
										<span class="rubric">Relationship to you:</span>
									</td>
									<td>
										<?php echo $applicationtoprint['Application'][0]['Emergency_relationship'];?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td class="border">
							<span class="rubric">Have you any health issues which we need to be aware of, including allergies?</span>
							<div class="indent">
								<?php echo $applicationtoprint['Application'][0]['Healthproblems_details'];?>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="border">
			<td colspan="2">
				<table id="reference">
					<tr>
						<td class="twothirds">
							<h3>Reference</h3>
							<table>
								<tr>
									<td colspan="2">
										Please provide the names and full addresses of two people over 18 who have known you
										for at least two years and who would be able to provide a personal reference (one of whom
										should ideally be a Church Minister, or a member of the Lighthouse Committee but not a
										member of your family).
									</td>
								</tr>
								<tr>
									<td class="half border">
										<span class="rubric">Name Address Telephone of Referee 1:</span>
										<div class="indent">
											<?php
												if(isset($applicationtoprint['RefereeTemp'][0])) {
													echo __('%s %s %s <br/>',$applicationtoprint['RefereeTemp'][0]['Title'],
																		$applicationtoprint['RefereeTemp'][0]['First_Name'],
																		$applicationtoprint['RefereeTemp'][0]['Last_Name']);
													echo $applicationtoprint['RefereeTemp'][0]['Address_1'].'<br/>';
													if(strlen($applicationtoprint['RefereeTemp'][0]['Address_2'])>0) {
														echo $applicationtoprint['RefereeTemp'][0]['Address_2'].'<br/>';
													}
													echo $applicationtoprint['RefereeTemp'][0]['Town'].'<br/>';
													echo $applicationtoprint['RefereeTemp'][0]['County'].'<br/>';
													echo $applicationtoprint['RefereeTemp'][0]['Post_Code'].'<br/><br/>'; 
													echo $applicationtoprint['RefereeTemp'][0]['Telephone'];
												} else {
													echo '&nbsp<br/>&nbsp<br/>&nbsp<br/>&nbsp<br/>&nbsp<br/>&nbsp<br/>&nbsp<br/>';
												}
											?>
										</div>
									</td>
									<td class="half border">
										<span class="rubric">Name Address Telephone of Referee 2:</span>
										<div class="indent">
											<?php
												if(isset($applicationtoprint['RefereeTemp'][1])) {
													echo __('%s %s %s <br/>',$applicationtoprint['RefereeTemp'][1]['Title'],
																		$applicationtoprint['RefereeTemp'][1]['First_Name'],
																		$applicationtoprint['RefereeTemp'][1]['Last_Name']);
													echo $applicationtoprint['RefereeTemp'][1]['Address_1'].'<br/>';
													if(strlen($applicationtoprint['RefereeTemp'][1]['Address_2'])>0) {
														echo $applicationtoprint['RefereeTemp'][1]['Address_2'].'<br/>';
													}
													echo $applicationtoprint['RefereeTemp'][1]['Town'].'<br/>';
													echo $applicationtoprint['RefereeTemp'][1]['County'].'<br/>';
													echo $applicationtoprint['RefereeTemp'][1]['Post_Code'].'<br/><br/>'; 
													echo $applicationtoprint['RefereeTemp'][1]['Telephone'];
												} else {
													echo '&nbsp<br/>&nbsp<br/>&nbsp<br/>&nbsp<br/>&nbsp<br/>&nbsp<br/>&nbsp<br/>';
												}
											?>
										</div>
									</td>
								</tr>
							</table>
						</td>
						<td class="onethird border">
							<div id="returnaddress">
								<p>Please register online at
								www.lighthousemissenden.org.uk
								or sign and returned this form
								with any amendments no later
								than 31st May <?php echo $lhyear;?>.</p>
								<p>Return Address:<br/>
								<span class="bold">Lighthouse Missenden <?php echo $lhyear;?><br/>
								PO BOX 619<br/>
								Helpers Registration<br/>
								Great Missenden<br/>
								Bucks<br/> HP16 0W</span>T</p>
								<div class="rubric">Lighthouse 88 is a registered charity, No 107189</div>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr class="border">
			<td colspan="2">
				<table id="helpoffered">
					<tr>
						<td colspan="2">
							<h3>Help Offered</h3>
						</td>
					</tr>
					<tr>
						<td class="half">
							Please indicate here in what way you would like to help out at
							Lighthouse this year.<br/>
							If you need help in deciding what to do then please return this form
							and somebody will get in touch with you.
						</td>
						<td class="half border">
								<span class="rubric">Role Offered:</span>
								<div class="indent">
									<?php echo $applicationtoprint['Application'][0]['AssignedRoleList'];?>
								</div>
						</td>
					</tr>
				</table>
			</tr>
		</tr>		
		<tr class="border">
			<td colspan="2">
				<table id="crb" style="<?php if($applicationtoprint['Person']['Over16'] == false) {echo 'display:none';}?>">
					<tr>
						<td colspan="2">
							<h3>CRB Disclosures</h3>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							All Lighthouse helpers 17 years of age and over are required to have an Enhanced CRB disclosure which is valid for Lighthouse and less than
							5 years old. We currently have the following CRB number for you. Please note that if the box is blank you will be required to complete a CRB
							form, someone will contact you.
						</td>
					</tr>
					<tr>
						<td class="twothirds border">
							<span class="rubric">CRB Number:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Application'][0]['CRB_number'];?>
							</div>
						</td>
						<td class="onethird border">
							<span class="rubric">Issue Date:</span>
							<div class="indent">
								<?php echo $applicationtoprint['Application'][0]['CRB_date'];?>
							</div>
						</td>
					</tr>
				</table>
			</tr>
		</tr>		
		<tr class="border">
			<td colspan="2">
				<table id="declaration" style="<?php if($applicationtoprint['Person']['Over16'] == false) {echo 'display:none';}?>">
					<tr>
						<td colspan="2">
							<h3>Declaration</h3>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							I declare that the information given on this form and any attached sheets is accurate and complete to the best of my knowledge. I hereby
							authorize you to carry out any checks that you may require confirming this.
						</td>
					</tr>
					<tr>
						<td class="twothirds border">
							<span class="rubric">Signed:</span>
							<div class="indent">&nbsp</div>
						</td>
						<td class="onethird border">
							<span class="rubric">Date:</span>
							<div class="indent">&nbsp</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>		
		<tr class="border">
			<td colspan="2">
				<table id="parentalconsent" style="<?php if($applicationtoprint['Person']['Over16'] == true) {echo 'display:none';}?>">
					<tr>
						<td colspan="2">
							<h3>Parental Consent</h3>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<p>This section is for applicants aged 16 and under.</p>
							<p>Parental consent is required for those wishing to help who are aged 16 and under.</p>
							<p>I am happy for my child to help at Lighthouse and I know of no reason why he/she should not be involved.</p>
						</td>
					</tr>
					<tr>
						<td class="twothirds border">
							<span class="rubric">Signed:</span>
							<div class="indent">&nbsp</div>
						</td>
						<td class="onethird border">
							<span class="rubric">Date:</span>
							<div class="indent">&nbsp</div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<span class="rubric">Parent or Guardian</span>
							<div class="indent"></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>		
	</table>
	<div class="divider noprint"></div>
	<div class="pagebreak"></div>
<?php endforeach;?>
</div>

<div class="actions">
	
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('action' => 'index')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Print Forms'), '', array('class' => 'printMe')); ?></li>
		<li><?php echo $this->Html->link(__('Cancel Print'), array('action' => 'helperlist')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>
