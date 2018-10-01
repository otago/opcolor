<span class="currentTitle" style="display:none">$CurrentTitle</span>
<select $AttributesHTML>
<% loop Options %>
	<option <% if $Up.CurrentTitle == $MyTitle %> selected="selected"<% end_if %> value="$Value.XML"<% if Disabled %> disabled="disabled"<% end_if %> data-rgb="$CSSRGB" data-cmyk="$CSSCMYK" data-hex="$CSSHex">$MyTitle</option>
<% end_loop %>
</select>
