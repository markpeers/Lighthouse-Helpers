<?php //debug($data);?>
<div class="reference index">
	<?php foreach($data as $request) : ?>
	<div class="letterhead">
		<?php echo $this->Html->image('logo.png', array('alt' => 'Lighthouse Logo', 'class' => 'logo'));?>
		<h2>LIGHTHOUSE Great Missenden</h2>
		<h3>A Children’s Christian Holiday Week</h3>
	</div>
	<div class="letterbody">
		<p><?php echo __('%s %s %s',$request['Referee']['Title'],$request['Referee']['First_Name'][0],$request['Referee']['Last_Name'])?><br>
		<?php echo $request['Referee']['Address_1']?><br>
		<?php echo $request['Referee']['Address_2']?><br>
		<?php echo $request['Referee']['Town']?><br>
		<?php echo $request['Referee']['County']?><br>
		<?php echo $request['Referee']['Post_Code']?></p>
		<p><?php echo date("jS F Y");?></p>
		<p><?php echo __('Dear %s %s,',$request['Referee']['Title'],$request['Referee']['Last_Name'])?></p>
		<p><?php echo __('%s %s ',$request['Person']['Nickname'],$request['Person']['Last_Name'])?>has offered to help at Lighthouse this year and given your name as a referee.</p>
		<p>As I am sure you will understand, before we can accept anyone to help with children, we must be sure that they are suitable. This person has given us your name as a referee.</p>
		<p>We would be grateful if you would take a few moments to fill in the attached form, and return it to us as soon as possible, using the enclosed pre-paid envelope. If you do not know this person well enough to complete the form do not feel obliged, please let us know so that we can ask for another referee.</p>
		<p>Please note that helpers at Lighthouse have substantial access to children and young people. You are requested to give details if you have any concerns why this person should not be entrusted with the care of children/young people.</p>
		<p>Any information you give will, of course, be treated in strict confidence.</p>
		<p>Thank you for your help in this.</p>
		<p>Yours sincerely</p>
		<p>Mrs P Walker</p>
		<p>2 Lime Tree Close<br>
		Great Kingshill<br>
		High Wycombe<br>
		Bucks<br>
		HP15 6EX</p>
	</div>
	<div class="letterfooter">
		<p>Lighthouse 88 is a registered charity, No 1071892</p>
	</div>
	<div class="divider"></div>
	<div class="reference">
		<table>
			<tr>
				<td>Name of Volunteer:-</td>
				<td class="rightcol"><?php echo __('%s %s (Ref %s)',$request['Person']['Nickname'],$request['Person']['Last_Name'],$request['Person']['Person_ID'])?></td>
			</tr>
			<tr>
				<td>How long have you known this person?</td>
				<td class="rightcol"></td>
			</tr>
			<tr>
				<td>In what capacity do you know him/her?</td>
				<td class="rightcol"></td>
			</tr>
			<tr>
				<td>Please describe briefly any other work he/she has undertaken which involved young people?</td>
				<td class="rightcol"></td>
			</tr>
			<tr>
				<td>Please comment on his/her reliability.</td>
				<td class="rightcol"></td>
			</tr>
			<tr>
				<td>Do you have ANY concerns about him/her working with young children? If so, please give brief details (even if it is not a recent concern).</td>
				<td class="rightcol"></td>
			</tr>
			<tr>
				<td>Signed:-</td>
				<td class="rightcol"></td>
			</tr>
			<tr>
				<td>Date:-</td>
				<td class="rightcol"></td>
			</tr>
			<tr>
				<td>Please also print your name:-</td>
				<td class="rightcol"></td>
			</tr>
		</table>
		<p>I would be grateful if you would return this to me in the stamped addressed envelope provided as soon as possible.</p>
	</div>
	<div class="letterfooter">
		<p><?php echo __('Lighthouse %s',$this->Session->read('Filter.Year'))?></p>
	</div>
	<div class="divider noprint"></div>
	<div class="pagebreak"></div>
	<?php endforeach; ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Helper Summary'), array('controller' => 'applications','action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Helpers'), array('controller' => 'applications','action' => 'helperlist')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Print Requests'), '', array('class' => 'printMe')); ?></li>
		<li><?php echo $this->Html->link(__('Print Successful'), array('controller' => 'references', 'action' => 'printsuccess')); ?></li>
		<li><?php echo $this->Html->link(__('Cancel Print'), array('controller' => 'applications', 'action' => 'index')); ?></li>
		<li>&nbsp;</li>
		<li><?php echo $this->Html->link(__('Log Out'), array('controller' => 'users','action' => 'logout')); ?></li>
	</ul>
</div>
