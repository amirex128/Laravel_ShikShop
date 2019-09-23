// Change to select2 type
$('select.select2.categories').select2();

// Create a change evnt on first select input
$('select.select2.categories').change(function () {
    
    var title = $(this).find('option[value="' + $(this).val() + '"]').html();
    get_sub_groups($(this).val(), title,  $(this).parent().parent());
});

// This function , get all the groups that is belong to a cerain group and
// put it , under an other select2
function get_sub_groups (parentValue, parentTitle, parentObj) {
    
    var select = [];
    select[0] = '<div class="form-group"><div class="input-group">';
    select[0] += '<select name="parent" class="form-control select2 categories">';
    select[0] += '<option value="' + parentValue + '">خود گروه "' + parentTitle + '"</option>';
    select[1] = '</select><div class="input-group-addon"><i class="ti-layout-grid2-alt">';
    select[1] += '</i></div></div></div>';
                
    $.get('/panel/group/sub/' + parentValue, function(data, status){
        if(status == 'success') {
            data = JSON.parse(data);
            
            var options = '', i = 0;
            for (value in data) {
                options += '<option value="' + data[value]['id'] + '">' + parentTitle + ' > ' + data[value]['title'] + '</option>'; 
                ++i;
            }
            
            parentObj.nextAll().remove();

            if (i > 0) {
                parentObj.parent().append(select[0] + options + select[1]);
                parentObj.next().find('select.select2:last-of-type').select2();
                parentObj.next().hide();
                parentObj.next().slideDown();

                parentObj.next().find('select.select2').change(function () {
                    
                    var title = $(this).find('option[value="' + $(this).val() + '"]').html();
                    get_sub_groups($(this).val(), title,  $(this).parent().parent());
                });
            }
        }
    });
}