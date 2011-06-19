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

function addFile() {
	var optionCount = ($('#files > div.input').size());
	var inputHtml = '<div class="input text">'
		+ '<input type="file" name="data[Relatedfile][' + optionCount + '][file_url]" id="RelatedfileFileUrl" />'
		+ '<label for="Relatedfile' + optionCount + 'Description"></label>'
		+ '<input name="data[Relatedfile][' + optionCount + '][description]" type="text" maxlength="512" id="RelatedfileDescription" />'
		+ '</div>';
	event.preventDefault();
    $('#files').append(inputHtml);
}
