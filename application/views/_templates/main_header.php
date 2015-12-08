<div id="modal"></div>
<div id="popupmessage">
	<div id="message"></div>
	<button class="plain-btn">OK</button>
	<br /><br />
</div>
<!-- begin header area -->
<div id="main-header">
	<div id="menu">
		<div id="logo"><img src="/public/img/redbird_logo.png" class="home-logo" alt="Red Bird Reports" /></div>
		<div id="agency-name"><?php echo $header_data[0]->agency_name; ?></div>
		<div id="user-name"><?php echo $header_data[0]->user_first_name; ?> <?php echo $header_data[0]->user_last_name; ?></div>
		<div id="main-buttons">
			<div class="main-button">
				<img id="dashboard" src="/public/img/btn_dashboard.png" class="main-btn-icon" alt="Dashboard" />
				<div class="main-btn-text">Dashboard</div>
			</div>
			<div class="main-button">
				<img id="policies" src="/public/img/btn_policies.png" class="main-btn-icon" alt="Policies" />
				<div class="main-btn-text">&nbsp;Policies</div>
			</div>
			<div class="main-button">
				<img id="commissions" src="/public/img/btn_payroll.png" class="main-btn-icon" alt="Commissions" />
				<div class="main-btn-text">Commissions</div>
			</div>
			<div class="main-button">
				<img id="myagency" src="/public/img/btn_agency.png" class="main-btn-icon" alt="My Agency" />
				<div class="main-btn-text">My Agency</div>
			</div>
			<div class="main-button">
				<img id="support" src="/public/img/btn_support.png" class="main-btn-icon" alt="Support" />
				<div class="main-btn-text">Support</div>
			</div>
			<div class="main-button">
				<img id="settings" src="/public/img/btn_profile.png" class="main-btn-icon" alt="My Profile" />
				<div class="main-btn-text">My Profile</div>
			</div>
			<div id="logout" class="main-button">
				<img src="/public/img/btn_logout.png" class="main-btn-icon" alt="Logout" />
				<div class="main-btn-text">Logout</div>
			</div>
		</div>
	</div>
</div>
<!-- end header area -->