/*Sorting pins*/
jQuery(document).ready( function($) {
//input search filter 
  $('#box').keyup(function () {
  	var value = $(this).val();
  	    var exp = new RegExp('^' + value, 'i');
  	
  	    $('#sortable .ui-state-default ').each(function() {
  	        var isMatch = exp.test($('.btn_pin_title', this).text());
  	        $(this).toggle(isMatch);
  	    });
  });
// date filter 
function sortUsingNestedText(parent, childSelector, keySelector) {
    var items = parent.children(childSelector).sort(function(a, b) {
        var vA = $(keySelector, a).text();
        var vB = $(keySelector, b).text();
        return (vA < vB) ? -1 : (vA > vB) ? 1 : 0;
    });
    parent.append(items);
}

/* setup sort attributes */
$('#sPrice').data("sortKey", "div.pin_modified");

/* sort on button click */
$("button.btnSort").click(function() {
  console.log("click");
   sortUsingNestedText($('#sortable'), "ul", $(this).data("sortKey"));
});

// post types filter
// map the classes for each item into a new array
var classes = $(".ui-state-default").map(function(){
  
    return $(this).attr('data-type');//.split(' ');
});
 
// create list of distinct items only
var classList = distinctList(classes);
 
// generate the list of filter links
var tagList = '<ul id="tag-list"></ul>';
tagItem = '<li><a href="#" class="active">all</a></li>';
 
// loop through the list of classes & add link
$.each(classList, function(index,value){
    var value = value.replace("-", " ");
    tagItem += '<li><a href="#">'+value+'</a></li>';
    var x = document.getElementById("item-filter-select");
        var option = document.createElement('option');
        option.setAttribute("value", value);
        option.setAttribute("id", value);
        option.text = value;
        x.add(option); 
  });
});

// Function to create a distinct list from array
function distinctList(inputArray){
    var i;
    var length = inputArray.length;
    var outputArray = [];
    var temp = {};
    for (i = 0; i < length; i++) {
        temp[inputArray[i]] = 0;
    }
    for (i in temp) {
        outputArray.push(i);
    }
    return outputArray;
}
//END of file