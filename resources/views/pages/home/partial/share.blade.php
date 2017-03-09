		<div class="well">
			<form action="" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<label style="width:auto; padding-right:10px;">Your</label>
				<select name="description" id="description">
					<option value="">time</option>
					<optgroup label="morning">
						<option value="7am">7am</option>
						<option value="8am">8am</option>
						<option value="9am">9am</option>
						<option value="10am">10am</option>
						<option value="11am">11am</option>
					</optgroup>
					<optgroup label="afternoon">
						<option value="noon">noon</option>
						<option value="1pm">1pm</option>
						<option value="2pm">2pm</option>
						<option value="3pm">3pm</option>
						<option value="4pm">4pm</option>
					  </optgroup>
					  <optgroup label="evening">
						<option value="5pm">5pm</option>
						<option value="6pm">6pm</option>
						<option value="7pm">7pm</option>
						<option value="8pm">8pm</option>
					  </optgroup>
					  <optgroup label="bonus">
						<option value="9pm">9pm</option>
						<option value="10pm">10pm</option>
						<option value="11pm">11pm</option>
						<option value="midnight">midnight</option>
						<option value="1am">1am</option>
						<option value="2am">2am</option>
						<option value="3am">3am</option>
						<option value="4am">4am</option>
						<option value="5am">5am</option>
						<option value="6am">6am</option>
					  </optgroup>
					  <optgroup label="special">
						<option value="">Sounding Board</option>
						<option value="">Text Club</option>
						<option value="">Trivia</option>
					  </optgroup>
					</select> tip is: <input name="tip" id="tip" maxlength="15" size="10">
					<input type="hidden" name="redeem" value="">
					<button type="submit" class="ui-button ui-widget ui-corner-all ui-button-text-only ui-state-hover ui-state-active">Share</button>
				</form>
			</div>
		</div>
