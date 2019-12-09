function asyncGetFieldsForTemplate(template, sort_by = 0){
  $.getJSON({
      url: "./?ax=list.fields&template_id="+template+"&callback=?"
    })
    .done(function( data ) {
      $('#inputSortField option').remove();
      $('#inputSortField').append($('<option>', { value : 0 }).text("date_added"));
      $.each( data, function( i, item ) {
        elem = $('<option>', { value : item._id }).text(item.name + " ("+item.f_name+")");
        if(sort_by == item._id){
          elem.attr('selected', 'selected');
        }
        $('#inputSortField').append(elem);
      });
    });
}

function sortableFields() {
	$("#activeFields").sortable();
	$("#activeFields").disableSelection();

	$("li").draggable({
		containment : "#container",
		helper : 'clone',
		// revert : 'invalid'
	});

	$("#activeFields, #inactiveFields").droppable({
		hoverClass : 'ui-state-highlight',
    accept: ":not(.ui-sortable-helper)",
		drop : function(ev, ui) {
			cloned = $(ui.draggable).clone();
      $(cloned).find('input').attr('name', 'data[_field][]');
      cloned.prepend('<span class="btn btn-sm btn-danger" onclick="remove($(this));"><i class="fa fa-times" aria-hidden="true"></i></span>').appendTo(this);
			$(ui.draggable).remove();
		}
	});

};

function remove(elem){
  parent = elem.parent();
  parent.find('input').attr('name', '');
  elem.remove();
  $('#inactiveFields').append(parent);
  sortableFields();
  // elem.parent().remove();

}
