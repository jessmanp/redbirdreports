<!-- begin sub header area -->
<div id="policy-header">
	<div id="sub-menu">
		<div id="sub-buttons">
			<div id="addbtn" class="sub-button-disabled">
				<img id="add" src="/public/img/btn_add.png" class="sub-btn-icon" alt="Add New" />
				<div class="sub-btn-text">Add New</div>
			</div>
			<div class="sub-button">
				<img id="all" src="/public/img/btn_all.png" class="sub-btn-icon" alt="View All" />
				<div class="sub-btn-text">View All</div>
			</div>
			<div class="sub-button">
				<img id="auto" src="/public/img/btn_auto.png" class="sub-btn-icon" alt="Auto" />
				<div class="sub-btn-text">Auto</div>
			</div>
			<div class="sub-button">
				<img id="fire" src="/public/img/btn_fire.png" class="sub-btn-icon" alt="Fire" />
				<div class="sub-btn-text">Fire</div>
			</div>
			<div class="sub-button">
				<img id="life" src="/public/img/btn_life.png" class="sub-btn-icon" alt="Life" />
				<div class="sub-btn-text">Life</div>
			</div>
			<div class="sub-button">
				<img id="health" src="/public/img/btn_health.png" class="sub-btn-icon" alt="Health" />
				<div class="sub-btn-text">Health</div>
			</div>
			<div class="sub-button">
				<img id="deposit" src="/public/img/btn_deposit.png" class="sub-btn-icon" alt="Deposit" />
				<div class="sub-btn-text">Deposit</div>
			</div>
			<div class="sub-button">
				<img id="loan" src="/public/img/btn_loan.png" class="sub-btn-icon" alt="Loan" />
				<div class="sub-btn-text">Loan</div>
			</div>
			<div class="sub-button">
				<img id="fund" src="/public/img/btn_fund.png" class="sub-btn-icon" alt="Mutual Fund" />
				<div class="sub-btn-text">Mutual Fund</div>
			</div>
		</div>
		<div id="search-area">
			<button id="pre-dates">Predefined Dates&nbsp;&nbsp;<img src="/public/img/btn_dates.png" class="search-btn-icon" alt="" /></button>
			<form id="search_text_form" name="search_text_form">
			<input type="hidden" id="suid" name="suid" value="<?=$_SESSION['user_id'];?>" />
			<div id="pre-dates-container">
				<div class="filter-dates">
				<strong>Search Selected Date(s)</strong><br />
				<input type="checkbox" id="written" name="written" value="1"><label for="written"><span><span></span></span>Written</label>&nbsp;&nbsp;&nbsp;
				<input type="checkbox" id="issued" name="issued" value="1"><label for="issued"><span><span></span></span>Issued</label>&nbsp;&nbsp;&nbsp;
				<input type="checkbox" id="effective" name="effective" value="1"><label for="effective"><span><span></span></span>Effective</label>&nbsp;&nbsp;&nbsp;
				<input type="checkbox" id="canceled" name="canceled" value="1"><label for="canceled"><span><span></span></span>Canceled</label>
				</div>
				<button id="today" data-dates="<?php echo $today.".a"; ?>" class="pre-dates-btn">Today</button>
				<button id="this_week" data-dates="<?php echo $this_week.".a"; ?>" class="pre-dates-btn">This Week</button>
				<button id="last_week" data-dates="<?php echo $last_week.".a"; ?>" class="pre-dates-btn">Last Week</button>
				<button id="this_month" data-dates="<?php echo $this_month.".a"; ?>" class="pre-dates-btn">This Month</button>
				<button id="last_month" data-dates="<?php echo $last_month.".a"; ?>" class="pre-dates-btn">Last Month</button>
				<button id="this_quarter" data-dates="<?php echo $this_quarter.".a"; ?>" class="pre-dates-btn">This Quarter</button>
				<button id="first_quarter" data-dates="<?php echo $first_quarter.".a"; ?>" class="pre-dates-btn">1st Quarter</button>
				<button id="second_quarter" data-dates="<?php echo $second_quarter.".a"; ?>" class="pre-dates-btn">2nd Quarter</button>
				<button id="third_quarter" data-dates="<?php echo $third_quarter.".a"; ?>" class="pre-dates-btn">3rd Quarter</button>
				<button id="fourth_quarter" data-dates="<?php echo $fourth_quarter.".a"; ?>" class="pre-dates-btn">4th Quarter</button>
				<button id="last_six_months" data-dates="<?php echo $last_six_months.".a"; ?>" class="pre-dates-btn">Last 6 Months</button>
				<button id="this_year" data-dates="<?php echo $this_year.".a"; ?>" class="pre-dates-btn">This Year</button>
				<button id="last_year" data-dates="<?php echo $last_year.".a"; ?>" class="pre-dates-btn">Last Year</button>
				<button id="all_time" class="pre-dates-btn">All Records</button>
			</div>
				<div class="date-pickers">&nbsp;Date Range:</div>
				<input id="datepick1" name="datepick1" placeholder="" />
				<input id="datepick2" name="datepick2" placeholder="" />
				<input id="field" name="field" type="text" placeholder="Search" />
				<button id="dosubmit"><img src="/public/img/btn_search.png" class="search-btn-icon" alt="Search" /></button>
			<button id="advanced-search">Search Filters<img src="/public/img/btn_filter.png" class="search-btn-icon" alt="Advanced Search" /></button>
			<div id="filter-container">
			  <div class="filter-checkboxes">
				<strong>Search Selected Field(s)</strong><br />
				<div class="filter-checkboxes-left">
					<input type="checkbox" id="first" name="first" value="1"><label for="first"><span><span></span></span>First Name</label><br />
					<input type="checkbox" id="last" name="last" value="1"><label for="last"><span><span></span></span>Last Name</label><br />
				</div>
				<div class="filter-checkboxes-right">
					<input type="checkbox" id="description" name="description" value="1"><label for="description"><span><span></span></span>Description</label><br />
					<input type="checkbox" id="notes" name="notes" value="1"><label for="notes"><span><span></span></span>Notes</label><br />
				</div>
			  </div>
			</div>
			</form>
		</div>
		<div id="status-area">
			<div class="status-text">Policy Type: <span id="statuscat" class="status-item"></span> (<span id="rowcnt" class="status-item">0</span>)</div>
			<div class="status-text">Average DTI: <span id="avgdti" class="status-item">0</span></div>
			<div class="status-text">Average Premium: <span id="avgprem" class="status-item">$0</span></div>
			<div class="status-text-right">Total Premium: <span id="totprem" class="status-item">$0</span></div>
			<div style="clear:both;height:5px;"></div>
			<div class="status-text-sm"><a id="allwritten" class="status-link">Written</a>: <span id="totwritten" class="status-item">0</span></div>
			<div class="status-text-sm"><a id="isissued" class="status-link">Issued</a>: <span id="totissued" class="status-item">0</span></div>
			<div class="status-text-sm"><a id="notissued" class="status-link">Not Issued</a>: <span id="totnotissued" class="status-item">0</span></div>
			<div class="status-text-sm"><a id="allcanceled" class="status-link">Canceled</a>: <span id="totcanceled" class="status-item">0</span></div>
			<div class="status-text-sm-right"><a id="pendingrenewal" class="status-link">Pending Renewal</a>: <span id="totpending" class="status-item">0</span></div>
		</div>
	</div>


			<div class="heading">
				<div class="col" style="width:1%;"></div>
				<div class="col" style="width:4%;"><span class="sort-text">Edit</span></div>
				<div class="col" style="width:4%;"><a id="sortstatus" class="sort-link">Status</a></div>
				<div class="col" style="width:10%;"><a id="sortfirst" class="sort-link">First</a></div>
				<div class="col" style="width:10%;"><a id="sortlast" class="sort-link">Last</a></div>
				<div class="col" style="width:10%;"><a id="sortdesc" class="sort-link">Description</a></div>
				<div class="col" style="width:10%;"><a id="sortcat" class="sort-link">Category</a></div>
				<div class="col" style="width:9%;"><a id="sortprem" class="sort-link">Premium</a></div>
				<div class="col" style="width:6%;">&nbsp;<a id="sorttype" class="sort-link" href="#">Type</a></div>
				<div class="col" style="width:8%;"><a id="sortsold" class="sort-link" href="#">Sold By</a></div>
				<div class="col" style="width:6%;"><a id="sortsrc" class="sort-link" href="#">Source</a></div>
				<div class="col" style="width:7%;"><a id="sortlen" class="sort-link" href="#">Length</a></div>
				<div class="col" style="width:4%;"><span class="sort-text">&nbsp;Notes</span></div>
				<div class="col" style="width:5%;"><a id="sortwdate" class="sort-link" href="#">Written</a></div>
				<div class="col" style="width:5%;"><a id="sortedate" class="sort-link" href="#">Effective</a></div>
				<div class="col" style="width:1%;"></div>
			</div>
			

</div>
<div id="loading"></div>
<!-- end sub header area -->