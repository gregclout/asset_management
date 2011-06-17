function addField(name, value, auto) {
	var autoValue = '';
	if (auto) {
		autoValue = ' templated';
	}
    var optionCount = ($('#fields > div.input').size());
    var inputHtml = '<div class="input text' + autoValue + '"><span><label for="Field' + optionCount + 'Name">'
        + '</label><input id="Field' + optionCount + 'Name" type="text" name="data[Field][' + optionCount + '][name]" value="'+ name +'" /></span>'
		+ '<span><label for="Field' + optionCount + 'Value">'
        + '</label><input id="Field' + optionCount + 'Value" type="text" name="data[Field][' + optionCount + '][value]" value="'+ value +'" /></span></div>'
    event.preventDefault();
    $('#fields').append(inputHtml);
}