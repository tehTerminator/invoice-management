<form id="addLedgerEntries" class="ui form segment" data-action="php/addData.php?t=transaction_a" data-validation="true">
	
	<table class="ui center aligned celled table segment" data-type="dynamic" data-source="templateRows">
		
		<thead>
			<tr>
				<th>From</th>
				<th><i class="icon long right arrow"></i></th>
				<th>To</th>
				<th><i class="icon long right arrow"></i></th>
				<th>Amount</th>
				<th>Description</th>
			</tr>
		</thead>

		<tbody>
			
			<tr class="templateRow">
				<td>
					<div class="ui fluid search dropdown" data-source="logs.accounts">
						<input type="hidden" name="from_account[]">
						<div class="default text">Transfer From Account</div>
						<div class="menu">
							
						</div>
					</div>
				</td>
				<td><i class="icon long right arrow"></i></td>
				<td>
					<div class="ui fluid search dropdown" data-source="logs.accounts">
						<input type="hidden" name="to_account[]">
						<div class="default text">Transfer From Account</div>
						<div class="menu">
							
						</div>
					</div>
				</td>
				<td><i class="icon long right arrow"></i></td>
				<td>
					<div class="ui icon input"><i class="rupee icon"></i><input type="number" name="amount[]"></div>
				</td>
				<td>
					<div class="input"><input type="text" name="description[]"></div>
				</td>
			</tr>

		</tbody>
		<tfoot>
			<td colspan="2">
				<div class="ui two buttons rowController">
					<button class="ui red icon button"><i class="icon remove"></i></button>
					<button class="ui green icon button"><i class="icon add"></i></button>
				</div>
			</td>

			<td colspan="2">
				<button class="ui right fluid floated blue submit labeled icon button"><i class="icon save"></i>Submit</button>
			</td>

			<td style="text-align:right;">Balance</td>
			<td><div class="ui icon input"><input type="text" readonly><i class="icon rupee"></i></div></td>
		</tfoot>

	</table>

</form>