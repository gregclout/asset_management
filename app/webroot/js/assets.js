function addFields(evt) {
	var selectedTemplate = $('#ItemTemplate').val();
	$('#fields > div.templated').remove();
	
	for(var i = 0, j = templateFields[selectedTemplate].length; i < j; i++){
		var fieldData = templateFields[selectedTemplate][i];
		addField(fieldData[0], fieldData[1], true);
	}

	evt.preventDefault();
}

function addFieldEventHandler(evt) {
	evt.preventDefault();
	addField(evt.data.name, evt.data.value, evt.data.auto);
}

function addField(name, value, auto) {
	var autoValue = '';
	if (auto) {
		autoValue = ' templated';
	}
    var optionCount = ($('#fields > div.input').size());
    var inputHtml = '<div class="input text' + autoValue + '"><span><label for="Field' + optionCount + 'Name">'
        + '</label><input id="Field' + optionCount + 'Name" type="text" name="data[Field][' + optionCount + '][name]" value="'+ name +'" /></span>'
		+ '<span><label for="Field' + optionCount + 'Value">'
        + '</label><input id="Field' + optionCount + 'Value" type="text" name="data[Field][' + optionCount + '][value]" value="'+ value +'" /></span>'
		+ '<button type="submit" class="removefield">&mdash;</button>'
		+ '</div>';
    $('#fields').append(inputHtml);
	$('.removefield').bind('click', removeField);
}

function addFile(evt) {
	evt.preventDefault();
	var optionCount = ($('#files > div.input').size());
	var inputHtml = '<div class="input text">'
		+ '<input type="file" name="data[Relatedfile][' + optionCount + '][file_url]" id="RelatedfileFileUrl" />'
		+ '<label for="Relatedfile' + optionCount + 'Description"></label>'
		+ '<input name="data[Relatedfile][' + optionCount + '][description]" type="text" maxlength="512" id="RelatedfileDescription" />'
		+ '</div>';
    $('#files').append(inputHtml);
}

function removeFile(evt) {
	evt.preventDefault();
	var id = $(evt.target).attr('fileid');
	var container = $(evt.target).parent().parent();
	container.remove();
	var optionCount = ($('#removefiles > input').size());
	var inputHtml = '<input type="hidden" name="data[removeFile][' + optionCount + '][id]" value="' + id + '" />';
	$('#removefiles').append(inputHtml);
}

function removeField(evt) {
	evt.preventDefault();
	var id = $(evt.target).attr('fieldid');
	var container = $(evt.target).parent();
	container.remove();
	var optionCount = ($('#removefields > input').size());
	var inputHtml = '<input type="hidden" name="data[removeField][' + optionCount + '][id]" value="' + id + '" />';
	$('#removefields').append(inputHtml);
}

$(document).ready(function() {
	$('#importfields').bind('click', addFields);
	$('#addfield').bind('click', {name:'', value:'', auto:false}, addFieldEventHandler);
	$('#addfile').bind('click', addFile);
	$('#removefile').bind('click', removeFile);
	$('.removefield').bind('click', removeField);
	
});